<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class FundSummary extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->load->model('FundSummary_model');
        $this->isLoggedIn();
    }

    public function index() {
        $filters = [
            'fund_type' => $this->input->get('fund_type'),
            'financial_year' => $this->input->get('financial_year'),
            'from_date' => $this->input->get('from_date'),
            'to_date' => $this->input->get('to_date'),
            'work_status' => $this->input->get('work_status'),
            'registration_no' => $this->input->get('registration_no')
        ];

        // Get current financial year (April to March)
        $current_month = date('n');
        $current_year = date('Y');
        if ($current_month < 4) {
            $current_fy = ($current_year - 1) . '-' . $current_year;
        } else {
            $current_fy = $current_year . '-' . ($current_year + 1);
        }

        // If no financial year selected, use current financial year
        if (empty($filters['financial_year'])) {
            $filters['financial_year'] = $current_fy;
        }

        $data['funds_data'] = $this->FundSummary_model->get_funds_data($filters);
        
        // Get totals for the selected filters
        $data['used_totals'] = $this->FundSummary_model->get_fund_totals($filters);
        
        // Fund allocations per financial year
        $data['fund_limits'] = [
            'MLA FUND' => 25000000,           // 2.5 Cr
            'MLA Sweechanudan' => 7500000,    // 75 Lakh
            'CLP Sweechanudan' => 10000000,   // 1 Cr
            'Jansampark Fund' => 200000       // 2 Lakh
        ];

        $data['filters'] = $filters;
        $data['current_fy'] = $current_fy;
        $this->global['pageTitle'] = 'Jan Umang : Approved Fund Summary';
        
        $this->loadViews("fund_summary/index", $this->global, $data, NULL);
    }
}
