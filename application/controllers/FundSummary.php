<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class FundSummary extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->load->model('FundSummary_model');
        $this->load->model('Fund_budget_model');
        $this->load->helper(['financial_year', 'fund_budget']);
        $this->isLoggedIn();
    }

    public function index() {
        // First visit with no query string: default to current FY so cards/table match (YYYY-YYYY like dropdown)
        if (empty($_GET)) {
            $m = (int) date('n');
            $y = (int) date('Y');
            $start = $m < 4 ? $y - 1 : $y;
            $default_fy = $start . '-' . ($start + 1);
            redirect('fundSummary?financial_year=' . rawurlencode($default_fy));
            return;
        }

        $filters = [
            'fund_type' => trim((string) $this->input->get('fund_type')),
            'financial_year' => trim((string) $this->input->get('financial_year')),
            'from_date' => trim((string) $this->input->get('from_date')),
            'to_date' => trim((string) $this->input->get('to_date')),
            'work_status' => trim((string) $this->input->get('work_status')),
            'registration_no' => trim((string) $this->input->get('registration_no')),
            'approx_cost_range' => trim((string) $this->input->get('approx_cost_range')),
        ];

        // Get current financial year (April to March) — full year end for display (YYYY-YYYY)
        $current_month = date('n');
        $current_year = (int) date('Y');
        if ($current_month < 4) {
            $current_fy = ($current_year - 1) . '-' . $current_year;
        } else {
            $current_fy = $current_year . '-' . ($current_year + 1);
        }

        // Table rows load via AJAX (fundSummary/data); keep optional full data for exports if needed
        $data['funds_data'] = [];

        // Get totals for the selected filters (summary cards) — same FY + fund_type as table
        $data['used_totals'] = $this->FundSummary_model->get_fund_totals($filters);
        
        if (!empty($filters['financial_year'])) {
            $fy_canonical = canonicalize_financial_year_for_budget($filters['financial_year']);
            $db_limits = $this->Fund_budget_model->get_limits_map_for_fy($fy_canonical);
            $defaults = [
                'MLA FUND' => 25000000,
                'MLA Sweechanudan' => 7500000,
                'CLP Sweechanudan' => 10000000,
                'Jansampark Fund' => 200000,
            ];
            $data['fund_limits'] = [];
            foreach ($defaults as $k => $def) {
                $data['fund_limits'][$k] = isset($db_limits[$k]) ? $db_limits[$k] : $def;
            }
            $data['card_mode_all_fy'] = false;
        } else {
            $data['fund_limits'] = null;
            $data['card_mode_all_fy'] = true;
        }

        $data['filters'] = $filters;
        $data['current_fy'] = $current_fy;
        $data['display_fy_title'] = !empty($filters['financial_year']) ? $filters['financial_year'] : 'All FY';
        $data['card_subtitle'] = !empty($filters['financial_year'])
            ? 'Cards and table use the same filters'
            : 'Used amounts are across all years; select a financial year to compare with budget';
        $this->global['pageTitle'] = 'Jan Umang : Approved Fund Summary';
        
        $this->loadViews("fund_summary/index", $this->global, $data, NULL);
    }

    public function data()
    {
        $request = $_REQUEST;
        $filters = [
            'fund_type' => isset($request['filter_fund_type']) ? trim((string) $request['filter_fund_type']) : '',
            'financial_year' => isset($request['filter_financial_year']) ? trim((string) $request['filter_financial_year']) : '',
            'from_date' => isset($request['filter_from_date']) ? trim((string) $request['filter_from_date']) : '',
            'to_date' => isset($request['filter_to_date']) ? trim((string) $request['filter_to_date']) : '',
            'work_status' => isset($request['filter_work_status']) ? trim((string) $request['filter_work_status']) : '',
            'registration_no' => isset($request['filter_registration_no']) ? trim((string) $request['filter_registration_no']) : '',
            'approx_cost_range' => isset($request['filter_approx_cost']) ? trim((string) $request['filter_approx_cost']) : '',
        ];

        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $start = isset($request['start']) ? (int) $request['start'] : 0;
        $length = isset($request['length']) ? (int) $request['length'] : 20;

        $orderCol = 21;
        $orderDir = 'desc';
        if (!empty($request['order'][0])) {
            $orderCol = (int) $request['order'][0]['column'];
            $orderDir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'desc';
        }
        if ($orderCol === 0) {
            $orderCol = 21;
        }

        $recordsTotal = $this->FundSummary_model->count_fund_summary_total();
        $recordsFiltered = $this->FundSummary_model->count_fund_summary_filtered($filters, $search);
        $sumFiltered = $this->FundSummary_model->sum_fund_summary_filtered($filters, $search);

        $pageLen = $length > 0 ? $length : 1000000;
        $rows = $this->FundSummary_model->get_fund_summary_page($filters, $search, $start, $pageLen, $orderCol, $orderDir);

        $out = [];
        $i = $start + 1;
        foreach ($rows as $row) {
            $display_year = $row['year'] ?? '';
            if (strlen((string) $display_year) === 4 && is_numeric($display_year)) {
                $next_year = (int) $display_year + 1;
                $display_year = $display_year . '-' . substr((string) $next_year, -2);
            }

            $ws = (string) ($row['work_status'] ?? '');
            if ($ws === 'Reject') {
                $statusHtml = '<span class="label label-default" style="background-color:#d73925;color:white;">' . htmlspecialchars($ws) . '</span>';
            } else {
                $status_class = 'label-default';
                if ($ws === 'Complete') {
                    $status_class = 'label-success';
                } elseif ($ws === 'In progress') {
                    $status_class = 'label-warning';
                } elseif ($ws === 'Incomplete') {
                    $status_class = 'label-danger';
                }
                $statusHtml = '<span class="label ' . $status_class . '">' . htmlspecialchars($ws) . '</span>';
            }

            $src = $row['source'] ?? '';
            $srcClass = ($src === 'Jansunwai') ? 'label-info' : 'label-warning';
            $sourceHtml = '<span class="label ' . $srcClass . '">' . htmlspecialchars((string) $src) . '</span>';

            $dateStr = '';
            if (!empty($row['date'])) {
                $dateStr = date('d-m-Y', strtotime($row['date']));
            }

            $cost = isset($row['approximate_cost']) ? (float) $row['approximate_cost'] : 0;
            $cost_in_words = $this->numberToHindiWords($cost);

            $out[] = [
                $i++,
                htmlspecialchars((string) ($row['registration_no'] ?? '')),
                htmlspecialchars((string) $display_year),
                htmlspecialchars((string) ($row['uname'] ?? '')),
                htmlspecialchars((string) ($row['mobile'] ?? '')),
                $sourceHtml,
                htmlspecialchars((string) (($row['district_name'] ?? '') !== '' ? $row['district_name'] : '-')),
                htmlspecialchars((string) (($row['block_name'] ?? '') !== '' ? $row['block_name'] : '-')),
                htmlspecialchars((string) (($row['booth_no'] ?? '') !== '' ? $row['booth_no'] : '-')),
                htmlspecialchars((string) (($row['booth_name'] ?? '') !== '' ? $row['booth_name'] : '-')),
                htmlspecialchars((string) (($row['vidhan_sabha_name'] ?? '') !== '' ? $row['vidhan_sabha_name'] : '-')),
                htmlspecialchars((string) (($row['panchayat_name'] ?? '') !== '' ? $row['panchayat_name'] : '-')),
                htmlspecialchars((string) (($row['village_name'] ?? '') !== '' ? $row['village_name'] : '-')),
                htmlspecialchars((string) (($row['majra_faliya'] ?? '') !== '' ? $row['majra_faliya'] : '-')),
                htmlspecialchars((string) (($row['department_name'] ?? '') !== '' ? $row['department_name'] : '-')),
                htmlspecialchars((string) (($row['work_problem'] ?? '') !== '' ? $row['work_problem'] : '-')),
                $statusHtml,
                htmlspecialchars((string) ($row['approved_fund'] ?? '')),
                '₹' . number_format($cost, 2),
                $cost_in_words,
                htmlspecialchars((string) (($row['work_agency'] ?? '') !== '' ? $row['work_agency'] : '-')),
                htmlspecialchars((string) (($row['remark'] ?? '') !== '' ? $row['remark'] : '-')),
                $dateStr,
            ];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode([
            'draw' => (int) ($request['draw'] ?? 0),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $out,
            'sumFiltered' => $sumFiltered,
        ]));
    }

    private function numberToHindiWords($number) {
        $no = (int) floor($number);
        if ($no == 0) return 'शून्य';
        
        $words = array(
            '0' => '', '1' => 'एक', '2' => 'दो', '3' => 'तीन', '4' => 'चार', '5' => 'पाँच',
            '6' => 'छह', '7' => 'सात', '8' => 'आठ', '9' => 'नौ', '10' => 'दस',
            '11' => 'ग्यारह', '12' => 'बारह', '13' => 'तेरह', '14' => 'चौदह', '15' => 'पंद्रह',
            '16' => 'सोलह', '17' => 'सत्रह', '18' => 'अठारह', '19' => 'उन्नीस', '20' => 'बीस',
            '21' => 'इक्कीस', '22' => 'बाइस', '23' => 'तेईस', '24' => 'चौबीस', '25' => 'पच्चीस',
            '26' => 'छब्बीस', '27' => 'सत्ताईस', '28' => 'अट्ठाईस', '29' => 'उनतीस', '30' => 'तीस',
            '31' => 'इकतीस', '32' => 'बत्तीस', '33' => 'तैंतीस', '34' => 'चौंतीस', '35' => 'पैंतीस',
            '36' => 'छत्तीस', '37' => 'सैंतीस', '38' => 'अड़तीस', '39' => 'उनतालीस', '40' => 'चालीस',
            '41' => 'इकतालीस', '42' => 'बयालीस', '43' => 'तैंतालीस', '44' => 'चवालीस', '45' => 'पैंतालीस',
            '46' => 'छियालीस', '47' => 'सैंतालीस', '48' => 'अड़तालीस', '49' => 'उनचास', '50' => 'पचास',
            '51' => 'इक्यावन', '52' => 'बावन', '53' => 'तिरपन', '54' => 'चउवन', '55' => 'पचपन',
            '56' => 'छप्पन', '57' => 'सत्तावन', '58' => 'अट्ठावन', '59' => 'उनसठ', '60' => 'साठ',
            '61' => 'इकसठ', '62' => 'बासठ', '63' => 'तिरसठ', '64' => 'चौंसठ', '65' => 'पैंसठ',
            '66' => 'छियासठ', '67' => 'सरसठ', '68' => 'अड़सठ', '69' => 'उनहत्तर', '70' => 'सत्तर',
            '71' => 'इकहत्तर', '72' => 'बहत्तर', '73' => 'तिहत्तर', '74' => 'चौहत्तर', '75' => 'पचहत्तर',
            '76' => 'छिहत्तर', '77' => 'सतहत्तर', '78' => 'अठहत्तर', '79' => 'उन्नासी', '80' => 'अस्सी',
            '81' => 'इक्यासी', '82' => 'बयासी', '83' => 'तिरासी', '84' => 'चौरासी', '85' => 'पचासी',
            '86' => 'छियासी', '87' => 'सत्तासी', '88' => 'अठासी', '89' => 'नवासी', '90' => 'नब्बे',
            '91' => 'इक्यानवे', '92' => 'बानवे', '93' => 'तिरानवे', '94' => 'चौरानवे', '95' => 'पचानवे',
            '96' => 'छियानवे', '97' => 'सत्तानवे', '98' => 'अट्ठानवे', '99' => 'निन्यानवे'
        );
        
        $crores = floor($no / 10000000);
        $no -= $crores * 10000000;
        $lakhs = floor($no / 100000);
        $no -= $lakhs * 100000;
        $thousands = floor($no / 1000);
        $no -= $thousands * 1000;
        $hundreds = floor($no / 100);
        $no -= $hundreds * 100;
        $tens_ones = $no;
        
        $res = '';
        if ($crores > 0) {
            $res .= $words[$crores] . ' करोड़ ';
        }
        if ($lakhs > 0) {
            $res .= $words[$lakhs] . ' लाख ';
        }
        if ($thousands > 0) {
            $res .= $words[$thousands] . ' हजार ';
        }
        if ($hundreds > 0) {
            $res .= $words[$hundreds] . ' सौ ';
        }
        if ($tens_ones > 0) {
            $res .= $words[$tens_ones] . ' ';
        }
        
        return trim($res);
    }
}
