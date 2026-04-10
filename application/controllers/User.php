<?php if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}
require APPPATH . "/libraries/BaseController.php";
#[AllowDynamicProperties]
class User extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("Comman_model");
        $this->load->model("Log_model");
        $this->isLoggedIn();
        $this->load->library("form_validation");
        $this->module = "Users";
        date_default_timezone_set('Asia/Kolkata');

    }

    /**
     * Returns all Member List coding types (same as in ServayListing / member add form).
     * Each: col = SQL column suffix, label = table header, like = LIKE pattern, code_param = value for filter link.
     */
    private function get_member_coding_types() {
        return [
            ['col' => 'SC_Count', 'label' => 'SC Count', 'like' => '%SC%', 'code_param' => 'SC'],
            ['col' => 'YC_Count', 'label' => 'YC Count', 'like' => '%YC%', 'code_param' => 'YC'],
            ['col' => 'WC_Count', 'label' => 'WC Count', 'like' => '%WC%', 'code_param' => 'WC'],
            ['col' => 'PA_Count', 'label' => 'PA Count', 'like' => '%PA%', 'code_param' => 'PA'],
            ['col' => 'SM_Count', 'label' => 'SM Count', 'like' => '%SM%', 'code_param' => 'SM'],
            ['col' => 'EO_Count', 'label' => 'EO Count', 'like' => '%EO%', 'code_param' => 'EO'],
            ['col' => 'GS_Count', 'label' => 'GS Count', 'like' => '%GS%', 'code_param' => 'GS'],
            ['col' => 'DCC_Count', 'label' => 'DCC Count', 'like' => '%DCC%', 'code_param' => 'DCC'],
            ['col' => 'PW_Count', 'label' => 'PW Count', 'like' => '%PW%', 'code_param' => 'PW'],
            ['col' => 'NL_Count', 'label' => 'NL Count', 'like' => '%NL%', 'code_param' => 'NL'],
            ['col' => 'FR_Count', 'label' => 'FR Count', 'like' => '%FR%', 'code_param' => 'FR'],
            ['col' => 'SO_Count', 'label' => 'SO Count', 'like' => '%SO%', 'code_param' => 'SO'],
            ['col' => 'ST_Count', 'label' => 'ST Count', 'like' => '%ST%', 'code_param' => 'ST'],
            ['col' => 'REF_Count', 'label' => 'REF Count', 'like' => '%REF%', 'code_param' => 'REF'],
            ['col' => 'US_Count', 'label' => 'US Count', 'like' => '%US%', 'code_param' => 'US'],
            ['col' => 'SMW_Count', 'label' => 'SMW Count', 'like' => '%SMW%', 'code_param' => 'SMW'],
            ['col' => 'DYC_Count', 'label' => 'DYC Count', 'like' => '%DYC%', 'code_param' => 'DYC'],
            ['col' => 'OBC_Count', 'label' => 'OBC Count', 'like' => '%OBC%', 'code_param' => 'OBC'],
            ['col' => 'DT_Count', 'label' => 'DT Count', 'like' => '%DT%', 'code_param' => 'DT'],
            ['col' => 'DP_Count', 'label' => 'DP Count', 'like' => '%DP%', 'code_param' => 'DP'],
            ['col' => 'MLA_Count', 'label' => 'MLA Count', 'like' => '%MLA%', 'code_param' => 'MLA'],
            ['col' => 'AVP_Count', 'label' => 'AVP Count', 'like' => '%AVP%', 'code_param' => 'AVP'],
            ['col' => 'MEET_Count', 'label' => 'MEET Count', 'like' => '%MEET%', 'code_param' => 'MEET'],
            ['col' => 'MEDIA_Count', 'label' => 'MEDIA Count', 'like' => '%MEDIA%', 'code_param' => 'MEDIA'],
            ['col' => 'XMLA_Count', 'label' => 'X MLA Count', 'like' => '%X MLA%', 'code_param' => 'X MLA'],
            ['col' => 'BC_Count', 'label' => 'BC Count', 'like' => '%BC (बूथ कमेटी)%', 'code_param' => 'BC (बूथ कमेटी)'],
            ['col' => 'PP_Count', 'label' => 'PP Count', 'like' => '%PP (पेज प्रभारी)%', 'code_param' => 'PP (पेज प्रभारी)'],
            ['col' => 'IP_Count', 'label' => 'IP Count', 'like' => '%IP (प्रभावशाली व्यक्ति)%', 'code_param' => 'IP (प्रभावशाली व्यक्ति)'],
            ['col' => 'FH_Count', 'label' => 'FH Count', 'like' => '%FH (परिवार का मुखिया)%', 'code_param' => 'FH (परिवार का मुखिया)'],
            ['col' => 'SMM_Count', 'label' => 'SMM Count', 'like' => '%SMM%', 'code_param' => 'SMM (सोशल मीडिया मित्र)'],
            ['col' => 'MS_Count', 'label' => 'MS Count', 'like' => '%MS (महिला समिति)%', 'code_param' => 'MS (महिला समिति)'],
            ['col' => 'FP_Count', 'label' => 'FP Count', 'like' => '%FP (फलिया प्रभारी)%', 'code_param' => 'FP (फलिया प्रभारी)'],
            ['col' => 'ER_Count', 'label' => 'ER Count', 'like' => '%ER (चुनाव प्रभारी)%', 'code_param' => 'ER (चुनाव प्रभारी)'],
            ['col' => 'वरिष्ठ_Count', 'label' => 'वरिष्ठ Count', 'like' => '%वरिष्ठ%', 'code_param' => 'वरिष्ठ'],
            ['col' => 'युवा_Count', 'label' => 'युवा Count', 'like' => '%युवा%', 'code_param' => 'युवा'],
            ['col' => 'वोटर_प्रभारी_Count', 'label' => 'वोटर प्रभारी Count', 'like' => 'voter', 'code_param' => 'वोटर प्रभारी (10 घर)'],
            ['col' => 'BLA_Count', 'label' => 'BLA Count', 'like' => '%BLA (बूथ लेवल एजेंट)%', 'code_param' => 'BLA (बूथ लेवल एजेंट)'],
            ['col' => 'FM_Count', 'label' => 'FM Count', 'like' => '%FM (दानदाता)%', 'code_param' => 'FM (दानदाता)'],
            ['col' => 'AK_Count', 'label' => 'AK Count', 'like' => '%AK (नवीन सदस्‍य को सक्रिय करना)%', 'code_param' => 'AK (नवीन सदस्‍य को सक्रिय करना)'],
        ];
    }

    public function index() {
        $this->load->model('Disctrictproblem');


        $this->global["pageTitle"] = "Jan Umang : Dashboard";
        $data["dashboarddata1"] = $this->user_model->getJansunwaiStatusCountByBlock(1);
        $data["dashboarddata2"] = $this->user_model->getJansunwaiStatusCountByBlock(2);
        $data["dashboarddata3"] = $this->user_model->getJansunwaiStatusCountByBlock(3);
        $data["dashboarddata4"] = $this->user_model->getJansunwaiStatusCountByBlock(4);
        
        // Add Public Problems Department Summary
        $data["public_problems_dept_summary"] = $this->Disctrictproblem->getPublicProblemsDepartmentSummary();
        
        // Add Public Problems Summary Report
        $data["public_problems_summary"] = $this->Disctrictproblem->getPublicProblemsSummaryByDate();
        $sql = "
        SELECT 
        b.id as block_id, 
        b.name as block_name, 
        COUNT(j.id) as total_records,
        SUM(CASE WHEN j.current_stage = 1 AND j.work_status = 'Incomplete' THEN 1 ELSE 0 END) as stage_1_incomplete,
        SUM(CASE WHEN j.current_stage = 1 AND j.work_status = 'Complete' THEN 1 ELSE 0 END) as stage_1_complete,
        SUM(CASE WHEN j.current_stage = 1 AND j.work_status = 'In progress' THEN 1 ELSE 0 END) as stage_1_in_progress,
        SUM(CASE WHEN j.current_stage = 2 AND j.work_status = 'Incomplete' THEN 1 ELSE 0 END) as stage_2_incomplete,
        SUM(CASE WHEN j.current_stage = 2 AND j.work_status = 'Complete' THEN 1 ELSE 0 END) as stage_2_complete,
        SUM(CASE WHEN j.current_stage = 2 AND j.work_status = 'In progress' THEN 1 ELSE 0 END) as stage_2_in_progress,
        SUM(CASE WHEN j.current_stage = 3 AND j.work_status = 'Incomplete' THEN 1 ELSE 0 END) as stage_3_incomplete,
        SUM(CASE WHEN j.current_stage = 3 AND j.work_status = 'Complete' THEN 1 ELSE 0 END) as stage_3_complete,
        SUM(CASE WHEN j.current_stage = 3 AND j.work_status = 'In progress' THEN 1 ELSE 0 END) as stage_3_in_progress,
        COUNT(j.id) as total_count,
        SUM(CASE WHEN DATE(j.createdAt) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM jansunwai j 
        LEFT JOIN block b ON b.id = j.block
        GROUP BY b.id, b.name
    
        UNION ALL
    
        SELECT 
        NULL as block_id,
        'All Blocks' as block_name, 
        COUNT(j.id) as total_records,
        SUM(CASE WHEN j.current_stage = 1 AND j.work_status = 'Incomplete' THEN 1 ELSE 0 END) as stage_1_incomplete,
        SUM(CASE WHEN j.current_stage = 1 AND j.work_status = 'Complete' THEN 1 ELSE 0 END) as stage_1_complete,
        SUM(CASE WHEN j.current_stage = 1 AND j.work_status = 'In progress' THEN 1 ELSE 0 END) as stage_1_in_progress,
        SUM(CASE WHEN j.current_stage = 2 AND j.work_status = 'Incomplete' THEN 1 ELSE 0 END) as stage_2_incomplete,
        SUM(CASE WHEN j.current_stage = 2 AND j.work_status = 'Complete' THEN 1 ELSE 0 END) as stage_2_complete,
        SUM(CASE WHEN j.current_stage = 2 AND j.work_status = 'In progress' THEN 1 ELSE 0 END) as stage_2_in_progress,
        SUM(CASE WHEN j.current_stage = 3 AND j.work_status = 'Incomplete' THEN 1 ELSE 0 END) as stage_3_incomplete,
        SUM(CASE WHEN j.current_stage = 3 AND j.work_status = 'Complete' THEN 1 ELSE 0 END) as stage_3_complete,
        SUM(CASE WHEN j.current_stage = 3 AND j.work_status = 'In progress' THEN 1 ELSE 0 END) as stage_3_in_progress,
        COUNT(j.id) as total_count,
        SUM(CASE WHEN DATE(j.createdAt) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM jansunwai j
    
        ORDER BY 
        CASE 
            WHEN block_name = 'All Blocks' THEN 0 
            ELSE 1 
        END,
        block_name";
        $query = $this->db->query($sql);
        $data["records"] = $query->result();
        
        $coding_types = $this->get_member_coding_types();
        $sum_parts = [];
        foreach ($coding_types as $ct) {
            if ($ct['col'] === 'वोटर_प्रभारी_Count') {
                $sum_parts[] = "SUM(CASE WHEN (j.code LIKE '%वोटर प्रभारी%' OR j.code LIKE '%वोटरप्रभारी%') THEN 1 ELSE 0 END) AS वोटर_प्रभारी_Count";
            } else {
                $sum_parts[] = "SUM(CASE WHEN j.code LIKE " . $this->db->escape($ct['like']) . " THEN 1 ELSE 0 END) AS " . $ct['col'];
            }
        }
        $sum_sql = implode(",\n            ", $sum_parts);
        $query = $this->db->query("
        SELECT *
        FROM (
            SELECT 
            CASE
                WHEN b.name IS NULL THEN 'All Blocks'
                ELSE b.name
            END AS BlockName,
            b.id AS block_id, 
            " . $sum_sql . ",
            COUNT(j.id) AS Total_Count,
            SUM(CASE WHEN DATE(j.create_date) = CURDATE() THEN 1 ELSE 0 END) AS Today_Count
        FROM block b
        LEFT JOIN servayapp j ON b.id = j.block_name_number
        WHERE b.id != 6
        GROUP BY b.name, b.id WITH ROLLUP
        ) AS subquery
        WHERE (block_id IS NOT NULL OR BlockName = 'All Blocks')
        ORDER BY 
        CASE 
            WHEN BlockName = 'All Blocks' THEN 0 
            ELSE 1 
        END, 
        BlockName");
        $data["blocks"] = $query->result();
        $data["coding_types"] = $coding_types;
        
        
        $sum_parts_dist = [];
        foreach ($coding_types as $ct) {
            if ($ct['col'] === 'वोटर_प्रभारी_Count') {
                $sum_parts_dist[] = "SUM(CASE WHEN (j.code LIKE '%वोटर प्रभारी%' OR j.code LIKE '%वोटरप्रभारी%') THEN 1 ELSE 0 END) AS वोटर_प्रभारी_Count";
            } else {
                $sum_parts_dist[] = "SUM(CASE WHEN j.code LIKE " . $this->db->escape($ct['like']) . " THEN 1 ELSE 0 END) AS " . $ct['col'];
            }
        }
        $sum_sql_dist = implode(",\n    ", $sum_parts_dist);
        $query = $this->db->query("SELECT *
FROM (
    SELECT 
    CASE
        WHEN d.name IS NULL THEN 'All Districts'
        ELSE d.name
    END AS DistrictName,
    d.id AS district_id, 
    " . $sum_sql_dist . ",
    COUNT(j.id) AS Total_Count,
    SUM(CASE WHEN DATE(j.create_date) = CURDATE() THEN 1 ELSE 0 END) AS Today_Count
    FROM district d
    LEFT JOIN servayapp j ON d.id = j.district
     GROUP BY d.name, d.id WITH ROLLUP
) AS subquery
WHERE (district_id IS NOT NULL OR DistrictName = 'All Districts')
ORDER BY CASE WHEN DistrictName = 'All Districts' THEN 0 ELSE 1 END, district_id ASC");
        $data["districts"] = $query->result(); 
        
        $data["status_count_by_block"] = $this->user_model->getStatusCountByBlock();
        $data["status_count"] = $this->user_model->getStatusCount();
        
     $this->db->select('d.id AS department_id, 
                   d.name AS department_name, 
                   j.work_status as work_statuses,
                   SUM(CASE WHEN j.work_status = "Complete" THEN 1 ELSE 0 END) AS complete_count,
                   SUM(CASE WHEN j.work_status = "Incomplete" THEN 1 ELSE 0 END) AS incomplete_count,
                   SUM(CASE WHEN j.work_status = "In progress" THEN 1 ELSE 0 END) AS inprogress_count,
                   COUNT(j.id) AS total_count');
$this->db->from("department d");
$this->db->join("jansunwai j", "j.department = d.id", "left");

$blockname = $this->input->post("blockname");
if (!empty($blockname)) {
    $this->db->where("j.block >=", $blockname);
}

$start_date = $this->input->post("start_date");
$end_date = $this->input->post("end_date");
if (!empty($start_date)) {
    $this->db->where("j.createdAt >=", $start_date);
}
if (!empty($end_date)) {
    $this->db->where("j.createdAt <=", $end_date);
}

// Group by both department and work status to get individual rows per status
// $this->db->group_by(array('d.id', 'j.work_status'));
$this->db->group_by(array('d.id'));
$query = $this->db->get();
$data["results"] = $query->result();



        
        $data["Allblocks"] = $this->user_model->getAllBlocks(); // Assuming 'your_model' is the name of your model
        $this->loadViews("general/dashboard", $this->global, $data, null);
    }
    public function blockdashboard() {
        $this->global["pageTitle"] = "CodeInsect : Dashboard";
        $this->loadViews("general/blockdashboard", $this->global, [], null);
    }
    function userListing() {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = "";
            if (!empty($this->input->post("searchText"))) {
                $searchText = $this->security->xss_clean($this->input->post("searchText"));
            }
            $data["searchText"] = $searchText;
            $this->load->library("pagination");
            $count = $this->user_model->userListingCount($searchText);
            $returns = $this->paginationCompress("userListing/", $count, 10);
            $data["userRecords"] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
            $this->global["pageTitle"] = "CodeInsect : User Listing";
            $this->loadViews("users/users", $this->global, $data, null);
        }
    }
    public function addNewJansunwai() {
        $this->module = "Block-Level";
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            // Clear session data if form is being loaded fresh (not from error)
            if (!$this->input->post()) {
                $this->session->unset_userdata('jansunwai_form_data');
            }
            
            // Set form validation rules
            $this->form_validation->set_rules("sector_name", "Sector Name", "required");
            $this->form_validation->set_rules("micro_sector_no", "Micro Sector No.", "required");
            $this->form_validation->set_rules("micro_sector_name", "Micro Sector Name", "required");
            $this->form_validation->set_rules("year", "Year", "required");
            $this->form_validation->set_rules("month", "Month", "required");
            $this->form_validation->set_rules("date", "Date", "required");
            $this->form_validation->set_rules("district", "District", "required");
            $this->form_validation->set_rules("assembly", "Assembly", "required");
            $this->form_validation->set_rules("block", "Block", "required");
            $this->form_validation->set_rules("recommended_letter_no", "Recommended Letter No.", "required");
            $this->form_validation->set_rules("booth_no", "Booth No.", "required");
            $this->form_validation->set_rules("booth_name", "Booth Name", "required");
            $this->form_validation->set_rules("panchayat_name", "Panchayat Name", "required");
            $this->form_validation->set_rules("village", "Village", "required");
            $this->form_validation->set_rules("majra_faliya", "Majra-Faliya", "required");
            $this->form_validation->set_rules("work_problem", "Work/Problem", "required");
            $this->form_validation->set_rules("office", "Office", "required");
            $this->form_validation->set_rules("approximate_cost", "Approximate Cost", "required|numeric");
            $this->form_validation->set_rules("department", "Department", "required");
            $this->form_validation->set_rules("priority", "Priority", "required");
            // $this->form_validation->set_rules("ts_no_date", "TS No/Date", "required");
            // $this->form_validation->set_rules("as_no_date", "AS No/Date", "required");
            $this->form_validation->set_rules("type_of_work", "Type of Work", "required");
            $this->form_validation->set_rules("middle_men", "Middle Men", "required");
            $this->form_validation->set_rules("cont_no", "Middle Man Cont No.", "required|regex_match[/^\d{10}$/]");
            $this->form_validation->set_rules("beneficial", "Beneficial", "required");
            $this->form_validation->set_rules("mobile", "Beneficial Cont No.", "required|regex_match[/^\d{10}$/]");
            $this->form_validation->set_rules("po", "PO", "required");
            $this->form_validation->set_rules("work_status", "Work Status", "required");
            $this->form_validation->set_rules("work_agency", "Work Agency", "required");
            $this->form_validation->set_rules("approved_fund", "Approved Fund", "required");
            
            // Section 6 fields are required only for Swechanudan sub work type
            $subWorkTypeId = $this->input->post("sub_work_type_id");
            if (!empty($subWorkTypeId)) {
                $subWorkType = $this->db->select("name")
                    ->from("subtype_of_work")
                    ->where("id", $subWorkTypeId)
                    ->get()
                    ->row();

                if ($subWorkType) {
                    $subWorkTypeName = mb_strtolower(trim($subWorkType->name), 'UTF-8');
                    $isSwechanudan = (mb_strpos($subWorkTypeName, 'स्वेछानुदान', 0, 'UTF-8') !== false)
                        || (mb_strpos($subWorkTypeName, 'स्वेच्छानुदान', 0, 'UTF-8') !== false)
                        || (strpos($subWorkTypeName, 'swechanudan') !== false);

                    if ($isSwechanudan) {
                        $this->form_validation->set_rules("account_details", "Account Details", "required");
                        $this->form_validation->set_rules("id_proof_number", "Adhar Card Number", "required");
                        $this->form_validation->set_rules("residential_number", "IFSC Number", "required");
                        $this->form_validation->set_rules("remark_goshana", "Remark/Goshana", "required");
                    }
                }
            }
            $this->global["pageTitle"] = "CodeInsect : Add New Jansunwai";
            $data["blocks"] = $this->Comman_model->get_all_data("block");
            $data["departments"] = $this->Comman_model->get_all_data("department");
            
            if ($this->form_validation->run() == false) {
                // Preserve form data on validation error
                $post_data = $this->input->post();
                $data["form_data"] = $post_data;
                $data["form_data_json"] = json_encode($post_data);
                
                // Helper function to get old value
                $data["get_old_value"] = function($field_name, $default = '') use ($post_data) {
                    return isset($post_data[$field_name]) ? $post_data[$field_name] : $default;
                };
                
                $this->loadViews("users/addJansunwai", $this->global, $data, null);
            } else {
                $this->load->helper("fund_budget");
                $this->load->model("Fund_budget_model");
                $resolved_fund = resolve_approved_fund_post($this->input->post("approved_fund"), $this->input->post("approved_fund_other"));
                $norm_fund = normalize_approved_fund_name($resolved_fund);
                if ($norm_fund !== null) {
                    $fy = canonicalize_financial_year_for_budget($this->input->post("year"));
                    $chk = $this->Fund_budget_model->check_budget($norm_fund, $fy, (float) $this->input->post("approximate_cost"), null, null);
                    if (!$chk["ok"]) {
                        // Save form data to session before redirecting
                        $post_data = $this->input->post();
                        $this->session->set_userdata('jansunwai_form_data', $post_data);
                        $this->session->set_flashdata("error", $chk["message"]);
                        redirect("user/addNewJansunwai");
                        return;
                    }
                }

                // Gather post data
                
                $config['upload_path'] = './uploads/'; // Specify the upload directory
                $config['allowed_types'] = '*'; // Specify allowed file types
                $config['max_size'] = '*'; // Set maximum file size in KB (2MB)
                $this->load->library('upload', $config);



               

                $data = [
                    "createdAt" => date('Y-m-d H:i:s'),
                    "sector_name" => $this->input->post("sector_name"), 
                    "micro_sector_no" => $this->input->post("micro_sector_no"), 
                    "micro_sector_name" => $this->input->post("micro_sector_name"), 
                    "year" => $this->input->post("year"), 
                    "month" => $this->input->post("month"), 
                    "date" => date("Y-m-d", strtotime($this->input->post("date"))), 
                    "district" => $this->input->post("district"), 
                    "assembly" => $this->input->post("assembly"), 
                    "block" => $this->input->post("block"), 
                    "recommended_letter_no" => $this->input->post("recommended_letter_no"), 
                    "booth_no" => $this->input->post("booth_no"), 
                    "booth_name" => $this->input->post("booth_name"), 
                    "panchayat_name" => $this->input->post("panchayat_name"),
                    "id_proof_number" => $this->input->post("id_proof_number"),
                    "residential_number" => $this->input->post("residential_number"), "village" => $this->input->post("village"), "majra_faliya" => $this->input->post("majra_faliya"), "work_problem" => $this->input->post("work_problem"), "office" => $this->input->post("office"), "approximate_cost" => $this->input->post("approximate_cost"), "department" => $this->input->post("department"), "priority" => $this->input->post("priority"),
                    "ts_no_date" => $this->input->post("ts_no_date"), 
                    "as_no_date" =>$this->input->post("as_no_date"),
                    
                    "type_of_work" => $this->input->post("type_of_work"),
                    "sub_work_type_id" => $this->input->post("sub_work_type_id") ? $this->input->post("sub_work_type_id") : null,
                     "middle_men" => $this->input->post("middle_men"),
                      "cont_no" => $this->input->post("cont_no"), 
                      "beneficial" => $this->input->post("beneficial"),
                       "uname" => $this->input->post("beneficial"),
                        "po" => $this->input->post("po"),
                         "work_status" => "Incomplete",
                         "remark_goshana" => $this->input->post("remark_goshana"),
                         "account_details" => $this->input->post("account_details"),
                          "work_agency" => $this->input->post("work_agency"),
                          "approved_fund" => $this->input->post("approved_fund") === 'others' ? $this->input->post("approved_fund_other") : $this->input->post("approved_fund"),
                           "createdBy" => $this->vendorId,
                            "mobile" => $this->input->post("mobile")
                 ];
                    // Insert data into database
                    
                    // Handle Avedan file upload
                    // Handle Avedan file upload
                    if (!empty($_FILES['file']['name'])) {
                        if ($this->upload->do_upload('file')) {
                            // File upload success
                            $upload_data = $this->upload->data();
                            $data['uploaded_file'] = $upload_data['file_name']; // Add the file name to the data array
                        } else {
                            // Handle file upload error (optional)
                            $error = $this->upload->display_errors();
                        }
                    }

                    // Handle Document upload
                    if (!empty($_FILES['document_upload']['name'])) {
                        if ($this->upload->do_upload('document_upload')) {
                            // File upload success 
                            $upload_data = $this->upload->data();
                            $data['document_upload'] = $upload_data['file_name']; // Add the document file name
                        } else {
                            // Handle file upload error (optional)
                            $error = $this->upload->display_errors();
                        }
                    }


 $lastRegQuery = $this->db->select("registration_no")
                         ->order_by("id", "DESC")
                         ->limit(1)
                         ->get("jansunwai");

$lastRegNo = $lastRegQuery->row_array();

$lastNumber =0; // Default start (so first generated will be AC/002)

if (!empty($lastRegNo)) {
    preg_match('/\d+$/', $lastRegNo['registration_no'], $matches);
    if (!empty($matches)) {
        $lastNumber = (int)$matches[0];
    }
}

// Generate registration_no like AC/002, AC/003, ...
$registration_no = "AC/" . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

$data["registration_no"] = $registration_no;

// Insert into DB
$this->db->insert("jansunwai", $data);
$insert_id = $this->db->insert_id();

                
                if ($insert_id) {
                    // Log activity
                    $this->logActivity('add', 'jansunwai', $insert_id, $data, null, 'Jansunwai record created with ID: ' . $insert_id);
                    // Clear session data after successful submission
                    $this->session->unset_userdata('jansunwai_form_data');
                    // Redirect or load success view
                    $this->session->set_flashdata("success", "Data added successfully.");
                    redirect("user/jansunwai");
                } else {
                    // Redirect or load failure view
                    $this->session->set_flashdata("error", "Failed to add data.");
                    redirect("user/jansunwai");
                }
            }
        }
    }
    public function editJansunwai($id) {
        $this->module = "Block-Level";
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            // Fetch the existing record
            $data["jansunwai"] = $this->db->get_where("jansunwai", ["id" => $id])->row();
            $this->global["pageTitle"] = "CodeInsect : Edit Jansunwai";
            $data["blocks"] = $this->Comman_model->get_all_data("block");
            $data["departments"] = $this->Comman_model->get_all_data("department");
            $this->loadViews("users/editJansunwai", $this->global, $data, null);
        }
    }
    public function updateJansunwai() {
        // Set form validation rules
        $this->form_validation->set_rules("sector_name", "Sector Name", "required");
        $this->form_validation->set_rules("micro_sector_no", "Micro Sector No.", "required");
        $this->form_validation->set_rules("micro_sector_name", "Micro Sector Name", "required");
         $this->form_validation->set_rules("year", "Year", "required");
        $this->form_validation->set_rules("month", "Month", "required");
        $this->form_validation->set_rules("date", "Date", "required");
        $this->form_validation->set_rules("district", "District", "required");
        $this->form_validation->set_rules("assembly", "Assembly", "required");
        $this->form_validation->set_rules("block", "Block", "required");
        $this->form_validation->set_rules("recommended_letter_no", "Recommended Letter No.", "required");
        $this->form_validation->set_rules("booth_no", "Booth No.", "required");
        $this->form_validation->set_rules("booth_name", "Booth Name", "required");
        $this->form_validation->set_rules("panchayat_name", "Panchayat Name", "required");
        $this->form_validation->set_rules("village", "Village", "required");
        $this->form_validation->set_rules("majra_faliya", "Majra-Faliya", "required");
        $this->form_validation->set_rules("work_problem", "Work/Problem", "required");
        $this->form_validation->set_rules("office", "Office", "required");
        $this->form_validation->set_rules("approximate_cost", "Approximate Cost", "required|decimal");
        $this->form_validation->set_rules("department", "Department", "required");
        $this->form_validation->set_rules("priority", "Priority", "required");
        //$this->form_validation->set_rules("ts_no_date", "TS No/Date", "required");
        //$this->form_validation->set_rules("as_no_date", "AS No/Date", "required");
        $this->form_validation->set_rules("type_of_work", "Type of Work", "required");
        $this->form_validation->set_rules("middle_men", "Middle Men", "required");
        $this->form_validation->set_rules("cont_no", "Cont No.", "required|regex_match[/^\d{10}$/]");
        $this->form_validation->set_rules("beneficial", "Beneficial", "required");
        $this->form_validation->set_rules("mobile", "Beneficial Cont No.", "required|regex_match[/^\d{10}$/]");
        $this->form_validation->set_rules("po", "PO", "required");
        $this->form_validation->set_rules("account_details", "Account Details", "required");
        $this->form_validation->set_rules("id_proof_number", "ID Proof Number", "required");
        $this->form_validation->set_rules("residential_number", "Residential Number", "required");
        $this->form_validation->set_rules("work_agency", "Work Agency", "required");
        $this->form_validation->set_rules("approved_fund", "Approved Fund", "required");
        // $this->form_validation->set_rules("work_status", "Work Status", "required");
        //$this->form_validation->set_rules("remark_goshana", "Remark/Goshana", "required");
        $this->global["pageTitle"] = "CodeInsect : Update Jansunwai";
        if ($this->form_validation->run() == false) {
          //  echo validation_errors();
            // If validation fails, reload the edit form with validation errors
            $id = $this->input->post("id");
            $this->editJansunwai($id);
        } else {
            $this->load->helper("fund_budget");
            $this->load->model("Fund_budget_model");
            $id = (int) $this->input->post("id");
            $resolved_fund = resolve_approved_fund_post($this->input->post("approved_fund"), $this->input->post("approved_fund_other"));
            $norm_fund = normalize_approved_fund_name($resolved_fund);
            if ($norm_fund !== null) {
                $fy = canonicalize_financial_year_for_budget($this->input->post("year"));
                $chk = $this->Fund_budget_model->check_budget($norm_fund, $fy, (float) $this->input->post("approximate_cost"), "jansunwai", $id);
                if (!$chk["ok"]) {
                    $this->session->set_flashdata("error", $chk["message"]);
                    redirect("user/editJansunwai/" . $id);
                    return;
                }
            }

            $config['upload_path'] = './uploads/'; // Specify the upload directory
                $config['allowed_types'] = '*'; // Specify allowed file types
                $config['max_size'] = '*'; // Set maximum file size in KB (2MB)
                $this->load->library('upload', $config);
            // Gather post data
            $id = $this->input->post("id");
            $data = ["sector_name" => $this->input->post("sector_name"), "micro_sector_no" => $this->input->post("micro_sector_no"), "micro_sector_name" => $this->input->post("micro_sector_name"), "year" => $this->input->post("year"), "month" => $this->input->post("month"), "date" => $this->input->post("date"), "district" => $this->input->post("district"), "assembly" => $this->input->post("assembly"), "block" => $this->input->post("block"), "recommended_letter_no" => $this->input->post("recommended_letter_no"), "booth_no" => $this->input->post("booth_no"), "booth_name" => $this->input->post("booth_name"), "panchayat_name" => $this->input->post("panchayat_name"), "village" => $this->input->post("village"), "majra_faliya" => $this->input->post("majra_faliya"), "work_problem" => $this->input->post("work_problem"), "office" => $this->input->post("office"), "approximate_cost" => $this->input->post("approximate_cost"), "department" => $this->input->post("department"), "priority" => $this->input->post("priority"),
            "ts_no_date" => $this->input->post("ts_no_date"), 
            "as_no_date" => $this->input->post("as_no_date"), 
            "type_of_work" => $this->input->post("type_of_work"), 
            "sub_work_type_id" => $this->input->post("sub_work_type_id") ? $this->input->post("sub_work_type_id") : null,
            "middle_men" => $this->input->post("middle_men"), 
            "cont_no" => $this->input->post("cont_no"), 
            "beneficial" => $this->input->post("beneficial"), 
            "uname" => $this->input->post("beneficial"), 
            "mobile" => $this->input->post("mobile"), 
            "po" => $this->input->post("po"),
            "account_details" => $this->input->post("account_details"),
            "id_proof_number" => $this->input->post("id_proof_number"),
            "residential_number" => $this->input->post("residential_number"),
            "work_agency" => $this->input->post("work_agency"),
            "approved_fund" => $this->input->post("approved_fund") === 'others' ? $this->input->post("approved_fund_other") : $this->input->post("approved_fund"),
            "remark_goshana" => $this->input->post("remark_goshana"), 
            "updatedBy" => $this->vendorId, 
            ];

            // Handle Avedan file upload
            if (!empty($_FILES['file']['name'])) {
                if ($this->upload->do_upload('file')) {
                    // File upload success
                    $upload_data = $this->upload->data();
                    $data['uploaded_file'] = $upload_data['file_name']; // Add the file name to the data array
                } else {
                    // Handle file upload error (optional)
                    $error = $this->upload->display_errors();
                }
            }

            // Handle Document upload
            if (!empty($_FILES['document_upload']['name'])) {
                if ($this->upload->do_upload('document_upload')) {
                    // File upload success 
                    $upload_data = $this->upload->data();
                    $data['document_upload'] = $upload_data['file_name']; // Add the document file name
                } else {
                    // Handle file upload error (optional)
                    $error = $this->upload->display_errors();
                }
            }


            // Get old data before update for logging
            $oldData = $this->db->get_where("jansunwai", ["id" => $id])->row_array();
            
            $this->db->where("id", $id);
            $update = $this->db->update("jansunwai", $data);
            
            if ($update) {
                // Log activity with old and new data
                $this->logActivity('edit', 'jansunwai', $id, $data, $oldData, 'Jansunwai record updated with ID: ' . $id);
                // Redirect or load success view
                $this->session->set_flashdata("success", "Data updated successfully.");
                redirect("user/jansunwai");
            } else {
                // Redirect or load failure view
                $this->session->set_flashdata("error", "Failed to update data.");
                redirect("user/editJansunwai/" . $id);
            }
        }
    }
    
    
    public function delete_jansunwai($id)
{
    // Optional: check if user has permission
    $this->module = "USS-Level"; // Set module for access control
    
    // Get data before delete for logging
    $jansunwaiData = $this->db->get_where("jansunwai", ["id" => $id])->row_array();

    // Delete from your main table, assuming it's named `jansunwai`
    $this->db->where('id', $id);
    $deleted = $this->db->delete('jansunwai');

    if ($deleted) {
        // Log activity
        $this->logActivity('delete', 'jansunwai', $id, $jansunwaiData, null, 'Jansunwai record deleted with ID: ' . $id . ' (Registration No: ' . (!empty($jansunwaiData['registration_no']) ? $jansunwaiData['registration_no'] : 'N/A') . ')');
        $this->session->set_flashdata('success', 'Record deleted successfully.');
    } else {
        $this->session->set_flashdata('error', 'Failed to delete the record.');
    }

    redirect('user/jansunwai3');
}

    
    public function addNew() {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->model("user_model");
            $data["roles"] = $this->user_model->getUserRoles();
            $this->load->model("Block_model");
            $data["blocks"] = $this->Block_model->get_blocks();
            $this->global["pageTitle"] = "CodeInsect : Add New User";
            $this->loadViews("users/addNew", $this->global, $data, null);
        }
    }
    function checkEmailExists() {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");
        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }
        if (empty($result)) {
            echo "true";
        } else {
            echo "false";
        }
    }
    function addNewUser() {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library("form_validation");
            $this->form_validation->set_rules("fname", "Full Name", "trim|required|max_length[128]");
            $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|max_length[128]");
            $this->form_validation->set_rules("password", "Password", "required|max_length[20]");
            $this->form_validation->set_rules("cpassword", "Confirm Password", "trim|required|matches[password]|max_length[20]");
            $this->form_validation->set_rules("role", "Role", "trim|required|numeric");
            $this->form_validation->set_rules("mobile", "Mobile Number", "required|regex_match[/^\d{10}$/]");
            if ($this->form_validation->run() == false) {
                $this->addNew();
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post("fname"))));
                $email = strtolower($this->security->xss_clean($this->input->post("email")));
                $password = $this->input->post("password");
                $roleId = $this->input->post("role");
                $mobile = $this->security->xss_clean($this->input->post("mobile"));
                $isAdmin = $this->input->post("isAdmin");
                $block = implode(",",$this->input->post("block"));
              
                // if ($roleId == 4) {
                //     $block = 1;
                // } elseif ($roleId == 5) {
                //     $block = 2;
                // } elseif ($roleId == 6) {
                //     $block = 3;
                // } elseif ($roleId == 7) {
                //     $block = 4;
                // } elseif ($roleId == 8) {
                //     $block = 5;
                // }
                $userInfo = ["email" => $email, "password" => getHashedPassword($password), "roleId" => $roleId, "name" => $name, "mobile" => $mobile, "isAdmin" => $isAdmin, "blockId" => $block, "createdBy" => $this->vendorId, "createdDtm" => date("Y-m-d H:i:s"), ];
                $this->load->model("user_model");
                $result = $this->user_model->addNewUser($userInfo);
                if ($result > 0) {
                    // Log activity
                    $this->logActivity('add', 'tbl_users', $result, $userInfo, null, 'User created with ID: ' . $result . ' (Name: ' . $name . ')');
                    $this->session->set_flashdata("success", "New User created successfully");
                } else {
                    $this->session->set_flashdata("error", "User creation failed");
                }
                redirect("addNew");
            }
        }
    }
    function editOld($userId = null) {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect("userListing");
            }
            $data["roles"] = $this->user_model->getUserRoles();
            $data["userInfo"] = $this->user_model->getUserInfo($userId);
            $this->global["pageTitle"] = "CodeInsect : Edit User";
            $this->loadViews("users/editOld", $this->global, $data, null);
        }
    }
    function editUser() {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library("form_validation");
            $userId = $this->input->post("userId");
            $this->form_validation->set_rules("fname", "Full Name", "trim|required|max_length[128]");
            $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|max_length[128]");
            $this->form_validation->set_rules("password", "Password", "matches[cpassword]|max_length[20]");
            $this->form_validation->set_rules("cpassword", "Confirm Password", "matches[password]|max_length[20]");
            $this->form_validation->set_rules("role", "Role", "trim|required|numeric");
            $this->form_validation->set_rules("mobile", "Mobile Number", "required|regex_match[/^\d{10}$/]");
            if ($this->form_validation->run() == false) {
                $this->editOld($userId);
            } else {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post("fname"))));
                $email = strtolower($this->security->xss_clean($this->input->post("email")));
                $password = $this->input->post("password");
                $roleId = $this->input->post("role");
                $mobile = $this->security->xss_clean($this->input->post("mobile"));
                $isAdmin = $this->input->post("isAdmin");
                $block = $this->input->post("block");
                $blockStr = is_array($block) ? implode(",", $block) : '';
                $userInfo = [];
                if (empty($password)) {
                    $userInfo = ["email" => $email, "roleId" => $roleId, "name" => $name, "mobile" => $mobile, "isAdmin" => $isAdmin, "blockId" => $blockStr, "updatedBy" => $this->vendorId, "updatedDtm" => date("Y-m-d H:i:s"), ];
                } else {
                    $userInfo = ["email" => $email, "password" => getHashedPassword($password), "roleId" => $roleId, "name" => ucwords($name), "mobile" => $mobile, "isAdmin" => $isAdmin, "blockId" => $blockStr, "updatedBy" => $this->vendorId, "updatedDtm" => date("Y-m-d H:i:s"), ];
                }
                // Get old data before update for logging
                $oldUserData = $this->user_model->getUserInfo($userId);
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if ($result == true) {
                    // Log activity with old and new data
                    $this->logActivity('edit', 'tbl_users', $userId, $userInfo, (array)$oldUserData, 'User updated with ID: ' . $userId . ' (Name: ' . $name . ')');
                    $this->session->set_flashdata("success", "User updated successfully");
                } else {
                    $this->session->set_flashdata("error", "User updation failed");
                }
                redirect("userListing");
            }
        }
    }
    function deleteUser() {
        if (!$this->hasDeleteAccess()) {
            $this->loadThis();
        } else {
            $userId = $this->input->post("userId");
            
            // Get data before delete for logging
            $userData = $this->user_model->getUserInfo($userId);
            
            $userInfo = ["isDeleted" => 1, "updatedBy" => $this->vendorId, "updatedDtm" => date("Y-m-d H:i:s"), ];
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) {
                // Log activity
                $this->logActivity('delete', 'tbl_users', $userId, (array)$userData, null, 'User deleted with ID: ' . $userId . ' (Name: ' . (!empty($userData->name) ? $userData->name : 'N/A') . ')');
                echo json_encode(["status" => true]);
            } else {
                echo json_encode(["status" => false]);
            }
        }
    }
    function pageNotFound() {
        $this->global["pageTitle"] = "CodeInsect : 404 - Page Not Found";
        $this->loadViews("general/404", $this->global, null, null);
    }
    function loginHistoy($userId = null) {
        // if(!$this->isAdmin())
        // {
        //     $this->loadThis();
        // }
        // else
        // {
        $userId = $userId == null ? 0 : $userId;
        $searchText = $this->input->post("searchText");
        $fromDate = $this->input->post("fromDate");
        $toDate = $this->input->post("toDate");
        $data["userInfo"] = $this->user_model->getUserInfoById($userId);
        $data["searchText"] = $searchText;
        $data["fromDate"] = $fromDate;
        $data["toDate"] = $toDate;
        $this->load->library("pagination");
        $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);
        $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);
        $data["userRecords"] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
        $this->global["pageTitle"] = "CodeInsect : User Login History";
        $this->loadViews("users/loginHistory", $this->global, $data, null);
        // }
        
    }
    function profile($active = "details") {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;
        $this->global["pageTitle"] = $active == "details" ? "CodeInsect : My Profile" : "CodeInsect : Change Password";
        $this->loadViews("users/profile", $this->global, $data, null);
    }
    function profileUpdate($active = "details") {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("fname", "Full Name", "trim|required|max_length[128]");
        $this->form_validation->set_rules("mobile", "Mobile Number", "required|regex_match[/^\d{10}$/]");
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|max_length[128]|callback_emailExists");
        if ($this->form_validation->run() == false) {
            $this->profile($active);
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post("fname"))));
            $mobile = $this->security->xss_clean($this->input->post("mobile"));
            $email = strtolower($this->security->xss_clean($this->input->post("email")));
            $userInfo = ["name" => $name, "email" => $email, "mobile" => $mobile, "updatedBy" => $this->vendorId, "updatedDtm" => date("Y-m-d H:i:s"), ];
            $result = $this->user_model->editUser($userInfo, $this->vendorId);
            $this->Log_model->log_action("Profile update", "tbl_users", $this->vendorId, $userInfo);
            if ($result == true) {
                $this->session->set_userdata("name", $name);
                $this->session->set_flashdata("success", "Profile updated successfully");
            } else {
                $this->session->set_flashdata("error", "Profile updation failed");
            }
            redirect("profile/" . $active);
        }
    }
    function changePassword($active = "changepass") {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("oldPassword", "Old password", "required|max_length[20]");
        $this->form_validation->set_rules("newPassword", "New password", "required|max_length[20]");
        $this->form_validation->set_rules("cNewPassword", "Confirm new password", "required|matches[newPassword]|max_length[20]");
        if ($this->form_validation->run() == false) {
            $this->profile($active);
        } else {
            $oldPassword = $this->input->post("oldPassword");
            $newPassword = $this->input->post("newPassword");
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            if (empty($resultPas)) {
                $this->session->set_flashdata("nomatch", "Your old password is not correct");
                redirect("profile/" . $active);
            } else {
                $usersData = ["password" => getHashedPassword($newPassword), "updatedBy" => $this->vendorId, "updatedDtm" => date("Y-m-d H:i:s"), ];
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                $this->Log_model->log_action("Change Password", "tbl_users", $this->vendorId, $usersData);
                if ($result > 0) {
                    $this->session->set_flashdata("success", "Password updation successful");
                } else {
                    $this->session->set_flashdata("error", "Password updation failed");
                }
                redirect("profile/" . $active);
            }
        }
    }
    function emailExists($email) {
        $userId = $this->vendorId;
        $return = false;
        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }
        if (empty($result)) {
            $return = true;
        } else {
            $this->form_validation->set_message("emailExists", "The {field} already taken");
            $return = false;
        }
        return $return;
    }
    private function servaylisting_datatable_joins()
    {
        $this->db->join("tbl_users", "tbl_users.userId = servayapp.user_id", "left");
        $this->db->join("district", "district.id = servayapp.district", "left");
        $this->db->join("vidhan_sabha", "vidhan_sabha.id = servayapp.vidhan_sabha_id", "left");
        $this->db->join("block", "block.id = servayapp.block_name_number", "left");
        $this->db->join("booth", "booth.id = servayapp.boothname", "left");
        $this->db->join("panchayat", "panchayat.id = servayapp.grampanchayat", "left");
        $this->db->join("village", "village.id = servayapp.village", "left");
        $this->db->join("samiti", "samiti.id = servayapp.samithi", "left");
        $this->db->join("party", "party.id = servayapp.parti", "left");
    }

    /** Exclude "own" survey rows (same as servaylisting view). */
    private function servaylisting_datatable_where_not_own()
    {
        $this->db->group_start();
        $this->db->where("servayapp.servayid IS NULL", null, false);
        $this->db->or_where("servayapp.servayid !=", "own");
        $this->db->group_end();
    }

    private function servaylisting_datatable_apply_form_filters($request)
    {
        $block = isset($request["filter_block"]) ? $request["filter_block"] : "";
        $year = isset($request["filter_year"]) ? $request["filter_year"] : "";
        $month = isset($request["filter_month"]) ? $request["filter_month"] : "";
        $samithi = isset($request["filter_samithi"]) ? $request["filter_samithi"] : "";
        $vehicle = isset($request["filter_vehicle"]) ? $request["filter_vehicle"] : "";
        $code = isset($request["filter_code"]) ? $request["filter_code"] : "";
        $district = isset($request["filter_district"]) ? $request["filter_district"] : "";
        $vidhan_sabha_id = isset($request["filter_vidhan_sabha_id"]) ? $request["filter_vidhan_sabha_id"] : "";

        if ($block !== null && $block !== "") {
            $this->db->where("servayapp.block_name_number", $block);
        }
        if ($district !== null && $district !== "") {
            $this->db->where("servayapp.district", $district);
        }
        if ($vidhan_sabha_id !== null && $vidhan_sabha_id !== "") {
            if ($vidhan_sabha_id === "0" || $vidhan_sabha_id === 0) {
                $this->db->group_start();
                $this->db->where("servayapp.vidhan_sabha_id IS NULL", null, false);
                $this->db->or_where("servayapp.vidhan_sabha_id", "");
                $this->db->or_where("servayapp.vidhan_sabha_id", 0);
                $this->db->group_end();
            } else {
                $this->db->where("servayapp.vidhan_sabha_id", $vidhan_sabha_id);
            }
        }
        if ($year !== null && $year !== "") {
            $this->db->where("YEAR(servayapp.create_date)", $year, false);
        }
        if ($month !== null && $month !== "") {
            $this->db->where("MONTH(servayapp.create_date)", $month, false);
        }
        if ($samithi !== null && $samithi !== "") {
            $this->db->where("servayapp.samithi", $samithi);
        }
        if ($vehicle !== null && $vehicle !== "") {
            $this->db->like("servayapp.vehicle", $vehicle);
        }
        if ($code !== null && $code !== "") {
            $this->db->like("servayapp.code", $code);
        }
    }

    private function servaylisting_datatable_apply_tab($tab)
    {
        if ($tab === "vidhan-sabha") {
            $this->db->where("block.id IS NOT NULL", null, false);
            $this->db->where("block.name !=", "Other");
        } elseif ($tab === "mp") {
            $this->db->where("block.name", "Other");
        }
    }

    private function servaylisting_datatable_apply_search($request)
    {
        if (empty($request["search"]["value"])) {
            return;
        }
        $s = $request["search"]["value"];
        $this->db->group_start();
        $this->db->like("servayapp.name", $s);
        $this->db->or_like("servayapp.votarcode", $s);
        $this->db->or_like("servayapp.mobile", $s);
        $this->db->or_like("servayapp.fathername", $s);
        $this->db->or_like("servayapp.address", $s);
        $this->db->or_like("servayapp.code", $s);
        $this->db->or_like("servayapp.jaati", $s);
        $this->db->or_like("servayapp.education", $s);
        $this->db->or_like("servayapp.remark", $s);
        $this->db->or_like("servayapp.reference", $s);
        $this->db->or_like("tbl_users.name", $s);
        $this->db->or_like("district.name", $s);
        $this->db->or_like("vidhan_sabha.vidhan_sabha_name", $s);
        $this->db->or_like("block.name", $s);
        $this->db->or_like("booth.name", $s);
        $this->db->or_like("panchayat.name", $s);
        $this->db->or_like("village.name", $s);
        $this->db->or_like("samiti.name", $s);
        $this->db->or_like("party.name", $s);
        $this->db->group_end();
    }

    public function servaylistingdata()
    {
        $request = $_REQUEST;

        $this->db->reset_query();
        $this->db->from("servayapp");
        $this->servaylisting_datatable_where_not_own();
        $recordsTotal = $this->db->count_all_results();

        $tab = isset($request["filter_tab"]) ? $request["filter_tab"] : "all";

        $this->db->reset_query();
        $this->db->from("servayapp");
        $this->servaylisting_datatable_joins();
        $this->servaylisting_datatable_where_not_own();
        $this->servaylisting_datatable_apply_form_filters($request);
        if ($tab !== "all") {
            $this->servaylisting_datatable_apply_tab($tab);
        }
        $this->servaylisting_datatable_apply_search($request);
        $recordsFiltered = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->select(
            "servayapp.*, tbl_users.name as user_name, district.name as district_name_str, " .
            "vidhan_sabha.vidhan_sabha_name as vs_name_str, block.name as block_name_str, " .
            "booth.name as booth_name_str, panchayat.name as panchayat_name_str, " .
            "village.name as village_name_str, samiti.name as samiti_name_str, party.name as party_name_str"
        );
        $this->db->from("servayapp");
        $this->servaylisting_datatable_joins();
        $this->servaylisting_datatable_where_not_own();
        $this->servaylisting_datatable_apply_form_filters($request);
        if ($tab !== "all") {
            $this->servaylisting_datatable_apply_tab($tab);
        }
        $this->servaylisting_datatable_apply_search($request);
        $this->db->order_by("servayapp.id", "DESC");
        $start = isset($request["start"]) ? (int) $request["start"] : 0;
        $length = isset($request["length"]) ? (int) $request["length"] : 10;
        if ($length > 0) {
            $this->db->limit($length, $start);
        }
        $rows = $this->db->get()->result();

        $response = [];
        $i = $start + 1;
        foreach ($rows as $row) {
            $dobStr = (!empty($row->dob) && $row->dob !== "0000-00-00")
                ? date("d-m-Y", strtotime($row->dob))
                : "";
            $domStr = (!empty($row->dom) && $row->dom !== "0000-00-00")
                ? date("d-m-Y", strtotime($row->dom))
                : "";

            $vs = isset($row->vs_name_str) && $row->vs_name_str !== "" ? htmlspecialchars($row->vs_name_str) : "N/A";

            $imgCell = "";
            if (!empty($row->image)) {
                $url = base_url("uploads/userservey/" . $row->image);
                $imgCell = '<a href="' . htmlspecialchars($url) . '" class="btn btn-sm btn-primary" target="_blank" title="View Image"><i class="fa fa-eye"></i> view File</a>';
            } else {
                $imgCell = "No-Image";
            }

            $id = (int) $row->id;
            $actions =
                '<a class="btn btn-sm btn-info" href="' . base_url("ServayController/editServay/" . $id) . '" title="Edit"><i class="fa fa-pencil"></i></a> ' .
                '<a class="btn btn-sm btn-info" href="' . base_url("editservayview/" . $id) . '" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-danger" href="' . base_url("User/deletestatus/" . $id) . '" data-userid="' . $id . '" title="Delete"><i class="fa fa-trash"></i></a>';

            $response[] = [
                $i++,
                htmlspecialchars(isset($row->user_name) ? $row->user_name : ""),
                htmlspecialchars(isset($row->district_name_str) ? $row->district_name_str : ""),
                $vs,
                htmlspecialchars(isset($row->name) ? $row->name : ""),
                htmlspecialchars(isset($row->votarcode) ? $row->votarcode : ""),
                htmlspecialchars(isset($row->mobile) ? $row->mobile : ""),
                htmlspecialchars(isset($row->fathername) ? $row->fathername : ""),
                $dobStr,
                $domStr,
                htmlspecialchars(isset($row->block_name_str) ? $row->block_name_str : ""),
                htmlspecialchars(isset($row->janpad_panchayat) ? $row->janpad_panchayat : ""),
                htmlspecialchars(isset($row->mandalam) ? $row->mandalam : ""),
                htmlspecialchars(isset($row->booth_name_str) ? $row->booth_name_str : ""),
                htmlspecialchars(isset($row->boothnumber) ? $row->boothnumber : ""),
                htmlspecialchars(isset($row->panchayat_name_str) ? $row->panchayat_name_str : ""),
                htmlspecialchars(isset($row->village_name_str) ? $row->village_name_str : ""),
                htmlspecialchars(isset($row->samiti_name_str) ? $row->samiti_name_str : ""),
                htmlspecialchars(isset($row->toll) ? $row->toll : ""),
                htmlspecialchars(isset($row->jaati) ? $row->jaati : ""),
                htmlspecialchars(isset($row->age) ? $row->age : ""),
                htmlspecialchars(isset($row->education) ? $row->education : ""),
                htmlspecialchars(isset($row->address) ? $row->address : ""),
                htmlspecialchars(isset($row->gender) ? $row->gender : ""),
                htmlspecialchars(isset($row->vehicle) ? $row->vehicle : ""),
                htmlspecialchars(isset($row->group) ? $row->group : ""),
                htmlspecialchars(isset($row->government_employee) ? $row->government_employee : ""),
                htmlspecialchars(isset($row->party_name_str) ? $row->party_name_str : ""),
                htmlspecialchars(isset($row->padvarsh) ? $row->padvarsh : ""),
                htmlspecialchars(isset($row->code) ? $row->code : ""),
                htmlspecialchars(isset($row->respect_for_women) ? $row->respect_for_women : ""),
                htmlspecialchars(isset($row->farmer_loan_waiver) ? $row->farmer_loan_waiver : ""),
                htmlspecialchars(isset($row->facebook) ? $row->facebook : ""),
                htmlspecialchars(isset($row->instagram) ? $row->instagram : ""),
                htmlspecialchars(isset($row->twitter) ? $row->twitter : ""),
                htmlspecialchars(isset($row->reference) ? $row->reference : ""),
                htmlspecialchars(isset($row->remark) ? $row->remark : ""),
                htmlspecialchars(isset($row->lat) ? $row->lat : ""),
                htmlspecialchars(isset($row->long) ? $row->long : ""),
                htmlspecialchars(isset($row->startdate) ? $row->startdate : ""),
                htmlspecialchars(isset($row->end_lat) ? $row->end_lat : ""),
                htmlspecialchars(isset($row->end_long) ? $row->end_long : ""),
                htmlspecialchars(isset($row->enddate) ? $row->enddate : ""),
                $imgCell,
                htmlspecialchars(isset($row->create_date) ? $row->create_date : ""),
                htmlspecialchars(isset($row->update_date) ? $row->update_date : ""),
                '<div class="text-center">' . $actions . "</div>",
            ];
        }

        $output = [
            "draw" => intval($request["draw"] ?? 0),
            "recordsTotal" => (int) $recordsTotal,
            "recordsFiltered" => (int) $recordsFiltered,
            "data" => $response,
        ];
        $this->output->set_content_type("application/json")->set_output(json_encode($output));
    }

    public function servaylisting() {
        $this->module = "MemberList";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $data["filters"] = [
                "block" => $this->input->post("block"),
                "year" => $this->input->post("year"),
                "month" => $this->input->post("month"),
                "samithi" => $this->input->post("samithi"),
                "vehicle" => $this->input->post("vehicle"),
                "code" => $this->input->post("code"),
                "district" => $this->input->post("district"),
                "vidhan_sabha_id" => $this->input->post("vidhan_sabha_id"),
            ];
            $this->load->model("Vidhan_sabha_model");
            $data["vidhan_sabhas_list"] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            $data["districts_list"] = $this->Comman_model->getAllData("district", [], "");
            $this->loadViews("users/servaylisting", $this->global, $data, null);
        }
    }
    function userservaylisting() {
        // if(!$this->isAdmin())
        // {
        //     $this->loadThis();
        // }
        // else
        // {
        $dd = $this->db->query("SELECT * FROM `servayapp` ORDER BY `create_date` DESC;");
        $data["userRecords"] = $dd->result();
        $this->loadViews("users/userservaylisting", $this->global, $data, null);
        // }
        
    }
    function ipuserlisting() {
        // if(!$this->isAdmin())
        // {
        //     $this->loadThis();
        // }
        // else
        // {
        $dd = $this->db->query("SELECT * FROM `servayapp` WHERE `code` IN('IP (प्रभावशाली व्यक्ति)') ORDER BY `create_date` DESC;");
        $data["userRecords"] = $dd->result();
        $this->loadViews("users/ipuserlisting", $this->global, $data, null);
        // }
        
    }
    //userservaylisting
    function editservay($userId = null) {
        // if(!$this->isAdmin())
        // {
        //     $this->loadThis();
        // }
        // else
        // {
        if ($userId == null) {
            redirect("servaylisting");
        }
        // $data['roles'] = $this->user_model->getUserRoles();
        $data["userInfo"] = $this->user_model->getservayInfoById($userId);
        $this->global["pageTitle"] = "CodeInsect : Edit User";
        $this->loadViews("users/editservay", $this->global, $data, null);
        // }
        
    }
    function editservayview($userId = null) {
        $this->module = "MemberList";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect("servaylisting");
            }
            $data["userInfo"] = $this->user_model->getservayInfoById($userId);
            $this->global["pageTitle"] = "CodeInsect : View User";
            $this->loadViews("users/editservayview", $this->global, $data, null);
        }
    }
    function userservayview($userId = null) {
        // if(!$this->isAdmin())
        // {
        //     $this->loadThis();
        // }
        // else
        // {
        if ($userId == null) {
            redirect("servaylisting");
        }
        // $data['roles'] = $this->user_model->getUserRoles();
        $data["userInfo"] = $this->user_model->getservayInfouserById($userId);
        $this->global["pageTitle"] = "CodeInsect : View User";
        $this->loadViews("users/editservayview", $this->global, $data, null);
        // }
        
    }
    function userwiseipuserlisting($user_id) {
        // if(!$this->isAdmin())
        // {
        //     $this->loadThis();
        // }
        // else
        // {
        $dd = $this->db->query("SELECT * FROM `servayapp` WHERE user_id='$user_id' and  `code` IN('IP (प्रभावशाली व्यक्ति)') ORDER BY `create_date` DESC;");
        $data["userRecords"] = $dd->result();
        $this->loadViews("users/ipuserlisting", $this->global, $data, null);
        //}
        
    }
    public function editstatus() {
        // print_r($this->input->post());die;
        $iddd = $this->input->post();
        $uu = $iddd["editstatus"][0];
        if ($uu == 0) {
            $where["editstatus"] = 0;
            $ui = $this->Comman_model->getAllData("servayapp", $where, "id");
            foreach ($ui as $k => $vv) {
                //  print_r($vv) ;
                $editstatus["editstatus"] = "1";
                $id["id"] = $vv->id;
                $this->Comman_model->UpdateRecord("servayapp", $editstatus, $id);
            }
            redirect("ServayListing");
        } else {
            $aa = $this->input->post("editstatus");
            foreach ($aa as $k => $vv) {
                $editstatus["editstatus"] = "1";
                $id["id"] = $vv;
                $this->Comman_model->UpdateRecord("servayapp", $editstatus, $id);
            }
            redirect("ServayListing");
        }
    }
    public function deletestatus($id) {
        $ifd["id"] = $id;
        
        // Get data before delete for logging
        $servayData = $this->db->get_where("servayapp", ["id" => $id])->row_array();
        
        $this->Comman_model->Deletedata("servayapp", $ifd);
        
        // Log activity
        $this->logActivity('delete', 'servayapp', $id, $servayData, null, 'Servay record deleted with ID: ' . $id . ' (Name: ' . (!empty($servayData['name']) ? $servayData['name'] : 'N/A') . ')');
        
        redirect("ServayListing");
    }
    public function usercount() {
        $this->module = "UserCount";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            // Get date filter from GET parameter
            $date = $this->input->get('date');
            if (empty($date)) {
                $date = date('Y-m-d');
            }
            
            // Get user records
            $userRecords = $this->user_model->usercountListing();
            
            // Calculate count for each user based on date
            $userCounts = array();
            foreach ($userRecords as $record) {
                if ($record->userId != '1') {
                    $count = $this->user_model->getUserCountByDate($record->userId, $date);
                    $userCounts[$record->userId] = $count;
                }
            }
            
            $data["userRecords"] = $userRecords;
            $data["userCounts"] = $userCounts;
            $data["selectedDate"] = $date;
            $this->global["pageTitle"] = "CodeInsect : User Listing";
            $this->loadViews("users/usercount", $this->global, $data, null);
        }
    }

    function jansunwai() {
     //   echo "<pre>";
       // print_r($this->session->userdata());
        $this->module = "Block-Level";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $block = $this->input->post("block");
            $year = $this->input->post("year");
            $month = $this->input->post("month");
            $department = $this->input->post("department");
            $approved_fund = $this->input->post("approved_fund");
            
            // Check for status parameter from URL (for dashboard card filtering)
            $status = $this->input->get("status");
            if (!empty($status)) {
                // Set the status as if it came from POST to be handled by the model
                $_POST['work_status'] = $status;
            }
            
            $data["filters"] = [
                "block" => $block,
                "year" => $year,
                "month" => $month,
                "department" => $department,
                "approved_fund" => $approved_fund,
                "work_status" => $this->input->post("work_status"),
            ];
            $this->global["pageTitle"] = "Jansunwai";
            $this->loadViews("users/jansunwailist", $this->global, $data, null);
        }
    }


 function jansunwaiajax() {
     //   echo "<pre>";
       // print_r($this->session->userdata());
        $this->module = "Block-Level";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $this->global["pageTitle"] = "Jansunwai";
            $this->loadViews("users/jansunwailistajax", $this->global, [], null);
        }
    }



    /**
     * Session block scope (same idea as User_model::jansunwailist).
     */
    private function jansunwai_datatable_session_scope()
    {
        $blockid = $this->session->userdata("blockId");
        if ($blockid != 0) {
            $this->db->where_in("jansunwai.block", explode(",", $blockid));
        }
    }

    /**
     * Form filters + status tab (POSTed from DataTables as filter_*).
     */
    private function jansunwai_datatable_apply_filters($request)
    {
        $this->jansunwai_datatable_session_scope();

        if (!empty($request["filter_block"])) {
            $this->db->where("jansunwai.block", $request["filter_block"]);
        }
        if (!empty($request["filter_department"])) {
            $this->db->where("jansunwai.department", $request["filter_department"]);
        }
        if (!empty($request["filter_approved_fund"])) {
            $this->db->where("jansunwai.approved_fund", $request["filter_approved_fund"]);
        }
        if (!empty($request["filter_year"])) {
            $this->db->where("jansunwai.year", $request["filter_year"]);
        }
        if (!empty($request["filter_month"])) {
            $this->db->where("jansunwai.month", $request["filter_month"]);
        }
        if (!empty($request["filter_work_status"])) {
            $this->db->where("jansunwai.work_status", $request["filter_work_status"]);
        }

        $tab = isset($request["filter_tab"]) ? $request["filter_tab"] : "all";
        if ($tab === "approval" || $tab === "complete") {
            $this->db->where("jansunwai.work_status", "Complete");
        } elseif ($tab === "incomplete") {
            $this->db->where("jansunwai.work_status", "Incomplete");
        } elseif ($tab === "inprogress") {
            $this->db->where("jansunwai.work_status", "In progress");
        } elseif ($tab === "reject") {
            $this->db->where("jansunwai.work_status", "Reject");
        }
    }

    private function jansunwai_datatable_joins()
    {
        $this->db->join("tbl_users", "tbl_users.userId = jansunwai.createdBy", "left");
        $this->db->join("block", "block.id = jansunwai.block", "left");
        $this->db->join("booth", "booth.id = jansunwai.booth_name", "left");
        $this->db->join("village", "village.id = jansunwai.village", "left");
        $this->db->join("panchayat", "panchayat.id = jansunwai.panchayat_name", "left");
        $this->db->join("department", "department.id = jansunwai.department", "left");
        $this->db->join("subtype_of_work", "subtype_of_work.id = jansunwai.sub_work_type_id", "left");
    }

    private function jansunwai_datatable_apply_search($request)
    {
        if (empty($request["search"]["value"])) {
            return;
        }
        $search = $request["search"]["value"];
        $this->db->group_start();
        $this->db->like("jansunwai.registration_no", $search);
        $this->db->or_like("jansunwai.sector_name", $search);
        $this->db->or_like("jansunwai.uname", $search);
        $this->db->or_like("jansunwai.mobile", $search);
        $this->db->or_like("jansunwai.micro_sector_no", $search);
        $this->db->or_like("jansunwai.year", $search);
        $this->db->or_like("jansunwai.district", $search);
        $this->db->or_like("jansunwai.assembly", $search);
        $this->db->or_like("jansunwai.majra_faliya", $search);
        $this->db->or_like("jansunwai.work_problem", $search);
        $this->db->or_like("jansunwai.office", $search);
        $this->db->or_like("jansunwai.address", $search);
        $this->db->or_like("jansunwai.approximate_cost", $search);
        $this->db->or_like("jansunwai.priority", $search);
        $this->db->or_like("jansunwai.type_of_work", $search);
        $this->db->or_like("jansunwai.as_no_date", $search);
        $this->db->or_like("jansunwai.middle_men", $search);
        $this->db->or_like("jansunwai.cont_no", $search);
        $this->db->or_like("jansunwai.work_status", $search);
        $this->db->or_like("jansunwai.beneficial", $search);
        $this->db->or_like("jansunwai.remark_goshana", $search);
        $this->db->or_like("jansunwai.recommended_letter_no", $search);
        $this->db->or_like("jansunwai.approved_fund", $search);
        $this->db->or_like("jansunwai.work_agency", $search);
        $this->db->or_like("tbl_users.name", $search);
        $this->db->or_like("block.name", $search);
        $this->db->or_like("department.name", $search);
        $this->db->or_like("subtype_of_work.name", $search);
        $this->db->group_end();
    }

    public function jansunwaidata()
    {
        $request = $_REQUEST;
        $listVariant = isset($request["list_variant"]) ? $request["list_variant"] : "full";

        $this->db->reset_query();
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_session_scope();
        $recordsTotal = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_joins();
        $this->jansunwai_datatable_apply_filters($request);
        $this->jansunwai_datatable_apply_search($request);
        $recordsFiltered = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->select(
            "jansunwai.*, tbl_users.name as added_by, subtype_of_work.name as sub_work_type_name, " .
            "block.name as block_join_name, booth.bnumber as booth_number_join, booth.name as booth_display_name, " .
            "village.name as village_join_name, panchayat.name as panchayat_join_name, department.name as department_join_name"
        );
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_joins();
        $this->jansunwai_datatable_apply_filters($request);
        $this->jansunwai_datatable_apply_search($request);
        $this->db->order_by("jansunwai.id", "DESC");
        $start = isset($request["start"]) ? (int) $request["start"] : 0;
        $length = isset($request["length"]) ? (int) $request["length"] : 10;
        if ($length > 0) {
            $this->db->limit($length, $start);
        }
        $rows = $this->db->get()->result();

        $monthNames = [
            1 => "January", 2 => "February", 3 => "March",
            4 => "April", 5 => "May", 6 => "June",
            7 => "July", 8 => "August", 9 => "September",
            10 => "October", 11 => "November", 12 => "December",
        ];

        $response = [];
        $i = $start + 1;
        $currentTime = new DateTime();

        foreach ($rows as $row) {
            $createdAt = new DateTime($row->createdAt);
            $updatedAt = !empty($row->updatedAt) ? new DateTime($row->updatedAt) : null;
            $createdAtTimestamp = $createdAt->getTimestamp() * 1000;

            if ($row->work_status == "Complete" && $updatedAt) {
                $timeDiff = $updatedAt->diff($createdAt);
                $timer = "<b style=\"color: red;\">" . $timeDiff->format("%dd, %hh, %im, %ss") . "</b>";
            } else {
                $timer = '<span class="live-timer" data-created-at="' . $createdAtTimestamp . '"><b style="color: red;"></b></span>';
            }

            $timeDifferenceInSeconds = $currentTime->getTimestamp() - $createdAt->getTimestamp();
            $isWithin72Hours = $timeDifferenceInSeconds < (72 * 60 * 60);
            $isWithin48Hours = $timeDifferenceInSeconds < (48 * 60 * 60);

            $monthKey = (int) $row->month;
            $monthLabel = isset($monthNames[$monthKey]) ? $monthNames[$monthKey] : ($row->month ?: "N/A");

            $blockName = $row->block_join_name ?: "N/A";
            $boothNo = $row->booth_number_join ?: "N/A";
            $boothNameDisp = $row->booth_display_name ?: "N/A";
            $panchayatName = $row->panchayat_join_name ?: "N/A";
            $villageName = $row->village_join_name ?: "N/A";
            $departmentName = $row->department_join_name ?: "N/A";

            $approvedFundCell = !empty($row->approved_fund) ? $row->approved_fund : "-";
            $workAgencyCell = !empty($row->work_agency) ? $row->work_agency : "-";

            if ($listVariant === "ajax_simple") {
                $commentWindow = $isWithin48Hours;
                $actionSimple =
                    '<a class="btn btn-sm btn-info" href="' . base_url("user/jansunwaicommentview/" . $row->id) . '" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                    '<a class="btn btn-sm btn-success ' . (!$commentWindow ? "disabled" : "") . '" href="' . base_url("user/submit_form/" . $row->id . "/1") . '" data-userid="' . $row->id . '" title="Comment"><i class="fa fa-edit"></i></a> ' .
                    '<a class="btn btn-sm btn-warning" href="' . base_url("user/editJansunwai/" . $row->id) . '" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                $response[] = [
                    $i++,
                    $row->registration_no,
                    $timer,
                    $row->sector_name,
                    $row->micro_sector_no,
                    $row->micro_sector_name,
                    $row->year,
                    $monthLabel,
                    $row->date,
                    $row->district,
                    $row->assembly,
                    $blockName,
                    $row->recommended_letter_no,
                    $boothNo,
                    $boothNameDisp,
                    $panchayatName,
                    $villageName,
                    $row->majra_faliya,
                    $row->work_problem,
                    $row->office,
                    $row->approximate_cost,
                    $departmentName,
                    $row->priority,
                    $row->ts_no_date,
                    $row->as_no_date,
                    $row->type_of_work,
                    isset($row->sub_work_type_name) ? $row->sub_work_type_name : "-",
                    $row->middle_men,
                    $row->cont_no,
                    $row->beneficial,
                    $row->po,
                    $this->getWorkStatusLabel($row->work_status),
                    $row->remark_goshana,
                    $row->remark,
                    $row->added_by,
                    $row->mobile,
                    $row->lat . "<br>" . $row->lng,
                    $row->createdAt,
                    !empty($row->uploaded_file)
                        ? '<a class="btn btn-sm btn-info" href="' . base_url("uploads/" . $row->uploaded_file) . '" title="Image" target="_blank">View File</a>'
                        : "<span>No File Uploaded</span>",
                    '<div class="text-center">' . $actionSimple . "</div>",
                ];
                continue;
            }

            $actionButtons =
                '<a class="btn btn-sm btn-info" href="' . base_url("user/jansunwaicommentview/" . $row->id) . '" title="View Comment"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-success ' . (!$isWithin72Hours ? "disabled" : "") . '" href="' . base_url("user/submit_form/" . $row->id . "/1") . '" data-userid="' . $row->id . '" title="Add Comment"><i class="fa fa-edit"></i></a> ' .
                '<a class="btn btn-sm btn-warning" href="' . base_url("user/editJansunwai/" . $row->id) . '" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-danger" href="' . base_url("user/delete_jansunwai/" . $row->id) . '" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete"><i class="fa fa-trash"></i></a>';

            $response[] = [
                $i++,
                $row->registration_no,
                $timer,
                $row->sector_name,
                $row->micro_sector_no,
                $row->micro_sector_name,
                $row->year,
                $monthLabel,
                $row->date,
                $row->district,
                $row->assembly,
                $blockName,
                $row->recommended_letter_no,
                $boothNo,
                $boothNameDisp,
                $panchayatName,
                $villageName,
                $row->majra_faliya,
                $row->work_problem,
                $row->office,
                $row->approximate_cost,
                $departmentName,
                $approvedFundCell,
                $workAgencyCell,
                $row->priority,
                $row->ts_no_date,
                $row->as_no_date,
                $row->type_of_work,
                isset($row->sub_work_type_name) ? $row->sub_work_type_name : "-",
                $row->middle_men,
                $row->cont_no,
                $row->beneficial,
                $row->po,
                $this->getWorkStatusLabel($row->work_status),
                $row->remark_goshana,
                $row->remark,
                $row->added_by,
                $row->mobile,
                $row->lat . "<br>" . $row->lng,
                $row->createdAt,
                !empty($row->uploaded_file)
                    ? '<a class="btn btn-sm btn-info" href="' . base_url("uploads/" . $row->uploaded_file) . '" title="Image" target="_blank">View File</a>'
                    : "<span>No File Uploaded</span>",
                '<div class="text-center">' . $actionButtons . "</div>",
            ];
        }

        $output = [
            "draw" => intval($request["draw"] ?? 0),
            "recordsTotal" => (int) $recordsTotal,
            "recordsFiltered" => (int) $recordsFiltered,
            "data" => $response,
        ];

        $this->output->set_content_type("application/json")->set_output(json_encode($output));
    }

    public function getWorkStatusLabel($status)
    {
        switch ($status) {
            case "Complete":
                return '<span class="label label-success">' . $status . "</span>";
            case "Incomplete":
                return '<span class="label label-danger">' . $status . "</span>";
            case "In progress":
                return '<span class="label label-warning">' . $status . "</span>";
            case "Reject":
                return '<span class="label label-default" style="background-color: #d73925; color: white;">' . $status . "</span>";
            case "Approval":
                return '<span class="label label-default">' . $status . "</span>";
            default:
                return '<span class="label label-default">' . ($status ?: "Unknown") . "</span>";
        }
    }
    function filterJansunwai() {
        $this->module = "Block-Level";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $block = $this->input->get("block");
            $stage = $this->input->get("stage");
            $status = $this->input->get("status");
            $department = $this->input->get("department");
            $today = "";
            if ($stage == 4) {
                $today = date("Y-m-d");
            }
            $data["userRecords"] = $this->user_model->filterjansunwailist($block, $stage, $status, $today,$department);
            $this->global["pageTitle"] = "Jansunwai";
            if($stage=='' || $stage== 1 ){
            $this->loadViews("users/jansunwailist", $this->global, $data, null);
            }else if( $stage== 2){
                
            $this->loadViews("users/jansunwailiststage2", $this->global, $data, null);
            
        }else if( $stage== 3){
                
            $this->loadViews("users/jansunwailiststage3", $this->global, $data, null);
        }
            
        }
    }
    function jansunwai2() {
        $this->module = "Bhopal-Level";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $this->global["pageTitle"] = "Jansunwai";
            $this->loadViews("users/jansunwailiststage2ajax", $this->global, [], null);
        }
    }

    public function jansunwai2data()
    {
        $request = $_REQUEST;
        
        $this->db->reset_query();
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_session_scope();
        $this->db->where("jansunwai.current_stage", 2);
        $recordsTotal = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_joins();
        $this->jansunwai_datatable_apply_filters($request);
        $this->jansunwai_datatable_apply_search($request);
        $this->db->where("jansunwai.current_stage", 2);
        $recordsFiltered = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->select(
            "jansunwai.*, tbl_users.name as added_by, subtype_of_work.name as sub_work_type_name, " .
            "block.name as block_join_name, booth.bnumber as booth_number_join, booth.name as booth_display_name, " .
            "village.name as village_join_name, panchayat.name as panchayat_join_name, department.name as department_join_name"
        );
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_joins();
        $this->jansunwai_datatable_apply_filters($request);
        $this->jansunwai_datatable_apply_search($request);
        $this->db->where("jansunwai.current_stage", 2);
        $this->db->order_by("jansunwai.id", "DESC");
        $start = isset($request["start"]) ? (int) $request["start"] : 0;
        $length = isset($request["length"]) ? (int) $request["length"] : 10;
        if ($length > 0) {
            $this->db->limit($length, $start);
        }
        $rows = $this->db->get()->result();

        $monthNames = [
            1 => "January", 2 => "February", 3 => "March",
            4 => "April", 5 => "May", 6 => "June",
            7 => "July", 8 => "August", 9 => "September",
            10 => "October", 11 => "November", 12 => "December",
        ];

        $response = [];
        $i = $start + 1;
        $currentTime = new DateTime();

        foreach ($rows as $row) {
            $createdAt = new DateTime($row->createdAt);
            $updatedAt = !empty($row->updatedAt) ? new DateTime($row->updatedAt) : null;
            $createdAtTimestamp = $createdAt->getTimestamp() * 1000;

            if ($row->work_status == "Complete" && $updatedAt) {
                $timeDiff = $updatedAt->diff($createdAt);
                $timer = "<b style=\"color: red;\">" . $timeDiff->format("%dd, %hh, %im, %ss") . "</b>";
            } else {
                $timer = '<span class="live-timer" data-created-at="' . $createdAtTimestamp . '"><b style="color: red;"></b></span>';
            }

            $timeDifferenceInSeconds = $currentTime->getTimestamp() - $createdAt->getTimestamp();
            $isWithin72Hours = $timeDifferenceInSeconds < (72 * 60 * 60);

            $monthKey = (int) $row->month;
            $monthLabel = isset($monthNames[$monthKey]) ? $monthNames[$monthKey] : ($row->month ?: "N/A");

            // Format year to financial year format
            $year_display = $row->year;
            if (!empty($year_display) && strpos($year_display, '-') === false) {
                $year_num = (int)$year_display;
                $next_year = substr($year_num + 1, -2);
                $year_display = $year_num . '-' . $next_year;
            }

            $blockName = $row->block_join_name ?: "N/A";
            $boothNo = $row->booth_number_join ?: "N/A";
            $boothNameDisp = $row->booth_display_name ?: "N/A";
            $panchayatName = $row->panchayat_join_name ?: "N/A";
            $villageName = $row->village_join_name ?: "N/A";
            $departmentName = $row->department_join_name ?: "N/A";

            $actionButtons =
                '<a class="btn btn-sm btn-info" href="' . base_url("user/jansunwaicommentview/" . $row->id) . '" title="View Comment"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-success ' . (!$isWithin72Hours ? "disabled" : "") . '" href="' . base_url("user/submit_form/" . $row->id . "/2") . '" data-userid="' . $row->id . '" title="Add Comment"><i class="fa fa-edit"></i></a> ' .
                '<a class="btn btn-sm btn-warning" href="' . base_url("user/editJansunwai/" . $row->id) . '" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-danger" href="' . base_url("user/delete_jansunwai/" . $row->id) . '" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete"><i class="fa fa-trash"></i></a>';

            $response[] = [
                $i++,
                $row->registration_no,
                $timer,
                $row->sector_name,
                $row->micro_sector_no,
                $row->micro_sector_name,
                $year_display,
                $monthLabel,
                $row->date,
                $row->district,
                $row->assembly,
                $blockName,
                $row->recommended_letter_no,
                $boothNo,
                $boothNameDisp,
                $panchayatName,
                $villageName,
                $row->majra_faliya,
                $row->work_problem,
                $row->office,
                $row->approximate_cost,
                $departmentName,
                $row->priority,
                $row->ts_no_date,
                $row->as_no_date,
                $row->type_of_work,
                isset($row->sub_work_type_name) ? $row->sub_work_type_name : "-",
                $row->middle_men,
                $row->cont_no,
                $row->beneficial,
                $row->po,
                $this->getWorkStatusLabel($row->work_status),
                $row->remark_goshana,
                $row->remark,
                $row->added_by,
                $row->mobile,
                $row->lat . "<br>" . $row->lng,
                $row->createdAt,
                !empty($row->uploaded_file)
                    ? '<a class="btn btn-sm btn-info" href="' . base_url("uploads/" . $row->uploaded_file) . '" title="Image" target="_blank">View File</a>'
                    : "<span>No File Uploaded</span>",
                '<div class="text-center">' . $actionButtons . "</div>",
            ];
        }

        $output = [
            "draw" => intval($request["draw"] ?? 0),
            "recordsTotal" => (int) $recordsTotal,
            "recordsFiltered" => (int) $recordsFiltered,
            "data" => $response,
        ];

        $this->output->set_content_type("application/json")->set_output(json_encode($output));
    }
    function jansunwai3() {
        
        $this->module = "USS-Level"; // Fixed: Changed from "PublicProblems3" to match config
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $this->global["pageTitle"] = "Jansunwai";
            $this->loadViews("users/jansunwailiststage3ajax", $this->global, [], null);
        }
    }

    public function jansunwai3data()
    {
        $request = $_REQUEST;
        
        $this->db->reset_query();
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_session_scope();
        $this->db->where("jansunwai.current_stage", 3);
        $recordsTotal = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_joins();
        $this->jansunwai_datatable_apply_filters($request);
        $this->jansunwai_datatable_apply_search($request);
        $this->db->where("jansunwai.current_stage", 3);
        $recordsFiltered = $this->db->count_all_results();

        $this->db->reset_query();
        $this->db->select(
            "jansunwai.*, tbl_users.name as added_by, subtype_of_work.name as sub_work_type_name, " .
            "block.name as block_join_name, booth.bnumber as booth_number_join, booth.name as booth_display_name, " .
            "village.name as village_join_name, panchayat.name as panchayat_join_name, department.name as department_join_name"
        );
        $this->db->from("jansunwai");
        $this->jansunwai_datatable_joins();
        $this->jansunwai_datatable_apply_filters($request);
        $this->jansunwai_datatable_apply_search($request);
        $this->db->where("jansunwai.current_stage", 3);
        $this->db->order_by("jansunwai.id", "DESC");
        $start = isset($request["start"]) ? (int) $request["start"] : 0;
        $length = isset($request["length"]) ? (int) $request["length"] : 10;
        if ($length > 0) {
            $this->db->limit($length, $start);
        }
        $rows = $this->db->get()->result();

        $monthNames = [
            1 => "January", 2 => "February", 3 => "March",
            4 => "April", 5 => "May", 6 => "June",
            7 => "July", 8 => "August", 9 => "September",
            10 => "October", 11 => "November", 12 => "December",
        ];

        $response = [];
        $i = $start + 1;
        $currentTime = new DateTime();

        foreach ($rows as $row) {
            $createdAt = new DateTime($row->createdAt);
            $updatedAt = !empty($row->updatedAt) ? new DateTime($row->updatedAt) : null;
            $createdAtTimestamp = $createdAt->getTimestamp() * 1000;

            if ($row->work_status == "Complete" && $updatedAt) {
                $timeDiff = $updatedAt->diff($createdAt);
                $timer = "<b style=\"color: red;\">" . $timeDiff->format("%dd, %hh, %im, %ss") . "</b>";
            } else {
                $timer = '<span class="live-timer" data-created-at="' . $createdAtTimestamp . '"><b style="color: red;"></b></span>';
            }

            $timeDifferenceInSeconds = $currentTime->getTimestamp() - $createdAt->getTimestamp();
            $isWithin72Hours = $timeDifferenceInSeconds < (72 * 60 * 60);

            $monthKey = (int) $row->month;
            $monthLabel = isset($monthNames[$monthKey]) ? $monthNames[$monthKey] : ($row->month ?: "N/A");

            // Format year to financial year format
            $year_display = $row->year;
            if (!empty($year_display) && strpos($year_display, '-') === false) {
                $year_num = (int)$year_display;
                $next_year = substr($year_num + 1, -2);
                $year_display = $year_num . '-' . $next_year;
            }

            $blockName = $row->block_join_name ?: "N/A";
            $boothNo = $row->booth_number_join ?: "N/A";
            $boothNameDisp = $row->booth_display_name ?: "N/A";
            $panchayatName = $row->panchayat_join_name ?: "N/A";
            $villageName = $row->village_join_name ?: "N/A";
            $departmentName = $row->department_join_name ?: "N/A";

            $actionButtons =
                '<a class="btn btn-sm btn-info" href="' . base_url("user/jansunwaicommentview/" . $row->id) . '" title="View Comment"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-success ' . (!$isWithin72Hours ? "disabled" : "") . '" href="' . base_url("user/submit_form/" . $row->id . "/3") . '" data-userid="' . $row->id . '" title="Add Comment"><i class="fa fa-edit"></i></a> ' .
                '<a class="btn btn-sm btn-warning" href="' . base_url("user/editJansunwai/" . $row->id) . '" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> ' .
                '<a class="btn btn-sm btn-danger" href="' . base_url("user/delete_jansunwai/" . $row->id) . '" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete"><i class="fa fa-trash"></i></a>';

            $response[] = [
                $i++,
                $row->registration_no,
                $timer,
                $row->sector_name,
                $row->micro_sector_no,
                $row->micro_sector_name,
                $year_display,
                $monthLabel,
                $row->date,
                $row->district,
                $row->assembly,
                $blockName,
                $row->recommended_letter_no,
                $boothNo,
                $boothNameDisp,
                $panchayatName,
                $villageName,
                $row->majra_faliya,
                $row->work_problem,
                $row->office,
                $row->approximate_cost,
                $departmentName,
                $row->priority,
                $row->ts_no_date,
                $row->as_no_date,
                $row->type_of_work,
                isset($row->sub_work_type_name) ? $row->sub_work_type_name : "-",
                $row->middle_men,
                $row->cont_no,
                $row->beneficial,
                $row->po,
                $this->getWorkStatusLabel($row->work_status),
                $row->remark_goshana,
                $row->remark,
                $row->added_by,
                $row->mobile,
                $row->lat . "<br>" . $row->lng,
                $row->createdAt,
                !empty($row->uploaded_file)
                    ? '<a class="btn btn-sm btn-info" href="' . base_url("uploads/" . $row->uploaded_file) . '" title="Image" target="_blank">View File</a>'
                    : "<span>No File Uploaded</span>",
                '<div class="text-center">' . $actionButtons . "</div>",
            ];
        }

        $output = [
            "draw" => intval($request["draw"] ?? 0),
            "recordsTotal" => (int) $recordsTotal,
            "recordsFiltered" => (int) $recordsFiltered,
            "data" => $response,
        ];

        $this->output->set_content_type("application/json")->set_output(json_encode($output));
    }
    // function jansunwaicommentview($id) {
        
    //     $this->module = "PublicProblems0";
    //     if (!$this->hasListAccess()) {
    //         $this->loadThis();
    //     } else {
    //       $data["userRecords"] = $this->user_model->jansunwaicommentlist($id);
    //         $this->global["pageTitle"] = "Jansunwai";
    //         $this->loadViews("users/jansunwaicommentview", $this->global, $data, null);
    //     }
         
    // }
    function jansunwaicommentview($id) {
    // Static list of available modules
    $availableModules = ["Block-Level", "Myassembly1", "Bhopal-Level"];
    
    foreach ($availableModules as $module) {
        $this->module = $module;

        if (!$this->hasListAccess()) {
            $this->loadThis();
            return; // Exit if access is denied
        } else {
            // Fetch user records for the given ID
            $data["userRecords"] = $this->user_model->jansunwaicommentlist($id);

            // Set the page title
            $this->global["pageTitle"] = "Jansunwai";

            // Load the views with the provided data
            $this->loadViews("users/jansunwaicommentview", $this->global, $data, null);
            return; // Exit after successful loading
        }
    }
    
    // Handle case if no module is processed successfully
    $this->global["pageTitle"] = "Access Denied";
    $this->loadThis();
}

    function department() {
        $this->module = "Department";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $data["userRecords"] = $this->user_model->departmentlist();
            $this->global["pageTitle"] = "department";
            $this->loadViews("users/departmentlist", $this->global, $data, null);
        }
    }
    function party() {
        $this->module = "Party";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $data["userRecords"] = $this->user_model->partylist();
            $this->global["pageTitle"] = "party";
            $this->loadViews("users/partylist", $this->global, $data, null);
        }
    }
    public function partyadd() {
        $this->module = "Party";
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules("name", "Name", "trim|required");
            if ($this->form_validation->run() == false) {
                if ($this->form_validation->error_string() != "") {
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                    <i class="fa fa-warning"></i>
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
                }
            } else {
                $arrayName = ["name" => $this->input->post("name"), ];
                $ids = $this->Comman_model->insertData("party", $arrayName);
                if ($ids) {
                    // Log activity
                    $this->logActivity('add', 'party', $ids, $arrayName, null, 'Party created with ID: ' . $ids . ' (Name: ' . $arrayName['name'] . ')');
                }
                $this->session->set_flashdata("success_req", '<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your request Add successfully...
                                        </div>');
                redirect("user/party");
            }
            $this->global["pageTitle"] = "Add party";
            $this->loadViews("users/partyadd", $this->global, [], null);
        }
    }
    public function vibhagadd() {
        $this->module = "Department";
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules("name", "Name", "trim|required");
            if ($this->form_validation->run() == false) {
                if ($this->form_validation->error_string() != "") {
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                    <i class="fa fa-warning"></i>
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
                }
            } else {
                $arrayName = ["name" => $this->input->post("name"), ];
                $ids = $this->Comman_model->insertData("department", $arrayName);
                if ($ids) {
                    // Log activity
                    $this->logActivity('add', 'department', $ids, $arrayName, null, 'Department created with ID: ' . $ids . ' (Name: ' . $arrayName['name'] . ')');
                }
                $this->session->set_flashdata("success_req", '<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your request Add successfully...
                                        </div>');
                redirect("user/department");
            }
            $this->global["pageTitle"] = "Add Vibhag";
            $this->loadViews("users/departmentadd", $this->global, [], null);
        }
    }
    public function deprtedit($id) {
        $this->module = "Department";
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules("name", "Name", "trim|required");
            if ($this->form_validation->run() == false) {
                if ($this->form_validation->error_string() != "") {
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                    <i class="fa fa-warning"></i>
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
                }
            } else {
                // Get old data before update for logging
                $oldDeptData = $this->Comman_model->getdata("department", ["id" => $id]);
                
                $arrayName = ["name" => $this->input->post("name"), ];
                $ids = $this->Comman_model->UpdateRecord("department", $arrayName, ["id" => $id]);
                
                if ($ids) {
                    // Log activity with old and new data
                    $this->logActivity('edit', 'department', $id, $arrayName, (array)$oldDeptData, 'Department updated with ID: ' . $id . ' (Name: ' . $arrayName['name'] . ')');
                }
                $this->session->set_flashdata("success_req", '<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your request Add successfully...
                                        </div>');
                redirect("user/department");
            }
            $this->global["pageTitle"] = "Add Vibhag";
            $data["row"] = $this->Comman_model->getdata("department", ["id" => $id, ]);
            $this->loadViews("users/departmentedit", $this->global, $data, null);
        }
    }
    public function partyedit($id) {
        $this->module = "Party";
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules("name", "Name", "trim|required");
            if ($this->form_validation->run() == false) {
                if ($this->form_validation->error_string() != "") {
                    $data["error"] = '<div class="alert alert-warning alert-dismissible" role="alert">
                                    <i class="fa fa-warning"></i>
                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                  <strong>Warning!</strong> ' . $this->form_validation->error_string() . '
                                </div>';
                }
            } else {
                // Get old data before update for logging
                $oldPartyData = $this->Comman_model->getdata("party", ["id" => $id]);
                
                $arrayName = ["name" => $this->input->post("name"), ];
                $ids = $this->Comman_model->UpdateRecord("party", $arrayName, ["id" => $id, ]);
                
                if ($ids) {
                    // Log activity with old and new data
                    $this->logActivity('edit', 'party', $id, $arrayName, (array)$oldPartyData, 'Party updated with ID: ' . $id . ' (Name: ' . $arrayName['name'] . ')');
                }
                $this->session->set_flashdata("success_req", '<div class="alert alert-success alert-dismissible" role="alert">
                                            <i class="fa fa-check"></i>
                                          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                          <strong>Success!</strong> Your request Add successfully...
                                        </div>');
                redirect("user/party");
            }
            $this->global["pageTitle"] = "Add Vibhag";
            $data["row"] = $this->Comman_model->getdata("party", ["id" => $id]);
            $this->loadViews("users/partyedit", $this->global, $data, null);
        }
    }
    function partydelete($id) {
        $this->module = "Party";
        if (!$this->hasDeleteAccess()) {
            $this->loadThis();
        } else {
            // Get data before delete for logging
            $partyData = $this->Comman_model->getdata("party", ["id" => $id]);
            
            $data = $this->Comman_model->Deletedata("party", ["id" => $id]);
            
            // Log activity
            if ($partyData) {
                $this->logActivity('delete', 'party', $id, (array)$partyData, null, 'Party deleted with ID: ' . $id . ' (Name: ' . (!empty($partyData->name) ? $partyData->name : 'N/A') . ')');
            }
            redirect("user/party");
        }
    }
    function departdelete($id) {
        $this->module = "Department";
        if (!$this->hasDeleteAccess()) {
            $this->loadThis();
        } else {
            // Get data before delete for logging
            $deptData = $this->Comman_model->getdata("department", ["id" => $id]);
            
            $data = $this->Comman_model->Deletedata("department", ["id" => $id, ]);
            
            // Log activity
            if ($deptData) {
                $this->logActivity('delete', 'department', $id, (array)$deptData, null, 'Department deleted with ID: ' . $id . ' (Name: ' . (!empty($deptData->name) ? $deptData->name : 'N/A') . ')');
            }
            redirect("user/department");
        }
    }
  public function submit_form($id, $stage) {
    $this->global["pageTitle"] = "Jansunwai";
    
    // Load form validation and file upload libraries
    $this->load->library("form_validation");
    $this->load->helper(["form", "url"]);
    
    // Set validation rules
    // $this->form_validation->set_rules("date", "Date", "required");
    $this->form_validation->set_rules("comment", "Comment", "required");
    $this->form_validation->set_rules("status", "Status", "required");

    // Check if the form validation passed
    if ($this->form_validation->run() == false) {
        // Validation failed, load the form again with errors
        $this->loadViews("users/form_view", $this->global, [], null);
    } else {
        // Validation passed
        // Handle file upload if a file is uploaded
        $file_name = null;  // Initialize file name variable

        if (!empty($_FILES['file_upload']['name'])) {
            // Set file upload configuration
            $config["upload_path"] = "./uploads/";
            $config["allowed_types"] = "*";
            $config["max_size"] = 20000; // 2MB

            $this->load->library("upload", $config);

            if (!$this->upload->do_upload("file_upload")) {
                // File upload failed, load the form again with errors
                $error = ["error" => $this->upload->display_errors()];
                $this->loadViews("users/form_view", $this->global, $error, null);
                return;
            } else {
                // File upload success
                $upload_data = $this->upload->data();
                $file_name = $upload_data["file_name"];  // Save file name if upload was successful
            }
        }

        // Prepare data for database
       $data = [
    // "commentdate" => $this->input->post("date"),
    "comment" => $this->input->post("comment"),
    "fileupload" => $file_name, // If no file uploaded, file_name will be null
    "status" => $this->input->post("status"),
    "jid" => $id,
    "stage" => $stage,
    "createdBy" => $this->vendorId,
    "createdAt" => date('Y-m-d H:i:s') // Add current date and time
];


        // Insert data into the database
        if ($this->db->insert("jansunwaicomment", $data)) {
            // Update work status in the jansunwai table
            $this->db->where("id", $id);
            
            $update = $this->db->update("jansunwai", ['work_status'=> $this->input->post("status"), "updatedAt" => date('Y-m-d H:i:s')]);

            // Log the action - set module based on stage
            $commentId = $this->db->insert_id();
            $moduleName = "Block-Level";
            if ($stage == 2) {
                $moduleName = "Bhopal-Level";
            } else if ($stage == 3) {
                $moduleName = "USS-Level";
            }
            $this->logActivity('add', 'jansunwaicomment', $commentId, $data, null, 'Jansunwai comment added for record ID: ' . $id . ' (Stage: ' . $stage . ', Module: ' . $moduleName . ')');
            
            // Redirect based on stage
            if ($stage == 1) {
                redirect("user/jansunwai");
            } else if ($stage == 2) {
                redirect("user/jansunwai2");
            } else if ($stage == 3) {
                redirect("user/jansunwai3");
            }
        } else {
            // Handle the error case
            $this->loadViews("users/form_view", $this->global, ["error" => "Failed to save data"], null);
        }
    }
}

    // API method to get jansunwai record details and comments
    public function get_jansunwai_details($id) {
        header('Content-Type: application/json');
        
        // Get record details
        $this->db->select('jansunwai.*, block.name as block_name, booth.name as booth_name, booth.bnumber as booth_number, village.name as village_name, panchayat.name as panchayat_name, department.name as department_name, tbl_users.name as added_by_name, subtype_of_work.name as sub_work_type_name');
        $this->db->from('jansunwai');
        $this->db->join('block', 'block.id = jansunwai.block', 'left');
        $this->db->join('booth', 'booth.id = jansunwai.booth_no', 'left');
        $this->db->join('village', 'village.id = jansunwai.village', 'left');
        $this->db->join('panchayat', 'panchayat.id = jansunwai.panchayat_name', 'left');
        $this->db->join('department', 'department.id = jansunwai.department', 'left');
        $this->db->join('tbl_users', 'tbl_users.userId = jansunwai.createdBy', 'left');
        $this->db->join('subtype_of_work', 'subtype_of_work.id = jansunwai.sub_work_type_id', 'left');
        $this->db->where('jansunwai.id', $id);
        $record = $this->db->get()->row();
        
        // Get comments
        $comments = $this->user_model->jansunwaicommentlist($id);
        
        if ($record) {
            echo json_encode([
                'success' => true,
                'record' => $record,
                'comments' => $comments
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }
    }

    // AJAX method to get sub work types by work type name
    public function getSubWorkTypesByWorkType() {
        header('Content-Type: application/json');
        
        $workTypeName = $this->input->post('work_type_name');
        
        if (empty($workTypeName)) {
            echo json_encode([
                'success' => false,
                'message' => 'Work type name is required',
                'subtypes' => []
            ]);
            return;
        }
        
        // First, get the work type ID by name
        $this->db->select('id');
        $this->db->from('workType');
        $this->db->where('name', $workTypeName);
        $workTypeQuery = $this->db->get();
        $workType = $workTypeQuery->row();
        
        if (!$workType) {
            echo json_encode([
                'success' => false,
                'message' => 'Work type not found',
                'subtypes' => []
            ]);
            return;
        }
        
        // Get sub work types for this work type
        $this->db->select('id, name');
        $this->db->from('subtype_of_work');
        $this->db->where('work_type_id', $workType->id);
        $this->db->order_by('name', 'ASC');
        $subTypesQuery = $this->db->get();
        $subTypes = $subTypesQuery->result_array();
        
        echo json_encode([
            'success' => true,
            'subtypes' => $subTypes
        ]);
    }

    // API method to add comment via AJAX
    public function add_comment_ajax() {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id');
        $stage = $this->input->post('stage');
        $comment = $this->input->post('comment');
        $status = $this->input->post('status');
        
        if (empty($id) || empty($comment) || empty($status)) {
            echo json_encode([
                'success' => false,
                'message' => 'Required fields are missing'
            ]);
            return;
        }
        
        $file_name = null;
        if (!empty($_FILES['file_upload']['name'])) {
            $config["upload_path"] = "./uploads/";
            $config["allowed_types"] = "*";
            $config["max_size"] = 20000;
            
            $this->load->library("upload", $config);
            
            if ($this->upload->do_upload("file_upload")) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data["file_name"];
            }
        }
        
        $data = [
            "comment" => $comment,
            "fileupload" => $file_name,
            "status" => $status,
            "jid" => $id,
            "stage" => $stage,
            "createdBy" => $this->vendorId,
            "createdAt" => date('Y-m-d H:i:s')
        ];
        
        if ($this->db->insert("jansunwaicomment", $data)) {
            $this->db->where("id", $id);
            $this->db->update("jansunwai", ['work_status' => $status, "updatedAt" => date('Y-m-d H:i:s')]);
            
            // Log the action - set module based on stage
            $commentId = $this->db->insert_id();
            $moduleName = "Block-Level";
            if ($stage == 2) {
                $moduleName = "Bhopal-Level";
            } else if ($stage == 3) {
                $moduleName = "USS-Level";
            }
            $this->logActivity('add', 'jansunwaicomment', $commentId, $data, null, 'Jansunwai comment added via AJAX for record ID: ' . $id . ' (Stage: ' . $stage . ', Module: ' . $moduleName . ')');
            
            // Get updated comments
            $comments = $this->user_model->jansunwaicommentlist($id);
            
            echo json_encode([
                'success' => true,
                'message' => 'Comment added successfully',
                'comments' => $comments
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to add comment'
            ]);
        }
    }

    public function filterServaylisting() {
        $this->module = "MemberList";
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $block = $this->input->get("block");
            $code = $this->input->get("code");
            $district_id = $this->input->get("district_id");
            $vidhan_sabha_id = $this->input->get("vidhan_sabha_id");
            $today = $this->input->get("today");
            $this->db->select("servayapp.*, b.name as block_name");
            $this->db->from("servayapp");
            $this->db->join("block b", "b.id = servayapp.block_name_number", "left");
            $this->db->where("b.id !=", 6);
            $this->db->order_by("servayapp.id", "DESC");
            if ($district_id !== null && $district_id !== "") {
                $this->db->where("servayapp.district", $district_id);
            }
            if ($vidhan_sabha_id !== null && $vidhan_sabha_id !== "") {
                $this->db->where("servayapp.vidhan_sabha_id", $vidhan_sabha_id);
            }
            if ($block !== null && $block !== "") {
                $this->db->where("servayapp.block_name_number", $block);
            }
            if ($code !== null && $code !== "") {
                $this->db->like("servayapp.code", $code);
            }
            if ($today !== null && $today !== "") {
                $this->db->like("servayapp.createdAt", date("Y-m-d"));
            }
            // Execute the query
            $query = $this->db->get();
            $data["userRecords"] = $query->result();
            $data["filters"] = [
                "block" => $this->input->get("block"),
                "district" => $this->input->get("district_id"),
                "vidhan_sabha_id" => $this->input->get("vidhan_sabha_id"),
                "code" => $this->input->get("code"),
            ];
            $this->load->model('Vidhan_sabha_model');
            $data['vidhan_sabhas_list'] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            $data['districts_list'] = $this->Comman_model->getAllData('district', [], '');
            $this->loadViews("users/servaylisting", $this->global, $data, null);
        }
    }
    
    /**
     * User logout functionality
     */
    public function logout() {
        // Get current user info before destroying session
        $userId = $this->session->userdata('userId');
        $userName = $this->session->userdata('name');
        
        // Log logout activity and end session tracking if user is logged in
        if ($userId) {
            try {
                // Make sure Log_model is loaded
                if (!isset($this->Log_model)) {
                    $this->load->model('Log_model');
                }
                
                // End session tracking
                if (method_exists($this->Log_model, 'end_user_session')) {
                    $sessionMinutes = $this->Log_model->end_user_session($userId);
                } else {
                    $sessionMinutes = 0;
                }
                
                // Log logout activity
                if (method_exists($this->Log_model, 'log_activity')) {
                    $this->Log_model->log_activity(
                        'logout',
                        'Authentication',
                        'tbl_users',
                        $userId,
                        null,
                        null,
                        'User logged out successfully' . ($sessionMinutes > 0 ? ' (Session duration: ' . number_format($sessionMinutes/60, 2) . ' hours)' : ''),
                        $userId,
                        $userName
                    );
                }
            } catch (Exception $e) {
                // Silently fail - logout should still work even if logging fails
                log_message('error', 'Logout logging failed: ' . $e->getMessage());
            }
        }
        
        // Destroy session
        $this->session->sess_destroy();
        
        // Redirect to login page
        redirect('login');
    }
}
?>