<?php
require APPPATH . '/libraries/BaseController.php';

class Visitors extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->load->model('Visitors_model');
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('Comman_model');
        $this->isLoggedIn();
        $this->load->library('form_validation');  
        $this->load->model('Log_model');
        $this->module = 'Visitors';
    }

    // Display all visitors
    // public function index() {
    //     if (!$this->hasListAccess()) {
    //         $this->loadThis(); // Redirect to the unauthorized access page
    //     } else {
    //         $data['visitors'] = $this->Visitors_model->get_visitors();
    //         $this->global['pageTitle'] = 'Datacollector : Visitors';
    //         $this->loadViews("visitors/index", $this->global, $data, NULL);
    //     }
    // }
    public function index() {
    if (!$this->hasListAccess()) {
        $this->loadThis(); // Redirect to the unauthorized access page
    } else {
    $data['visitors'] = $this->Visitors_model->get_visitors();

    // Helper function to clean and normalize values
    $clean = function($value) {
        return strtolower(trim($value));
    };

    // Extract unique, cleaned values for dropdowns
    $districts = array_map($clean, array_column($data['visitors'], 'district'));
    $districts = array_filter($districts, function($v) { return $v !== '' && $v !== null; });
    $districts = array_unique($districts);
    sort($districts);
    $data['districts'] = $districts;

    $vidhan_sabhas = array_map($clean, array_column($data['visitors'], 'vidhan_sabha'));
    $vidhan_sabhas = array_filter($vidhan_sabhas, function($v) { return $v !== '' && $v !== null; });
    $vidhan_sabhas = array_unique($vidhan_sabhas);
    sort($vidhan_sabhas);
    $data['vidhan_sabhas'] = $vidhan_sabhas;

    // Get blocks as array of block names, cleaned and unique
    $query = $this->db->get('block');
    $blocks = $query->result_array();
    // Check for both 'block_name' and 'name' field variations
    $block_names = array_map(function($b) use ($clean) {
        $name = isset($b['block_name']) ? $b['block_name'] : (isset($b['name']) ? $b['name'] : '');
        return $clean($name);
    }, $blocks);
    $block_names = array_filter($block_names, function($v) { return $v !== '' && $v !== null; });
    $block_names = array_unique($block_names);
    sort($block_names);
    $data['blocks'] = $block_names;

    $this->global['pageTitle'] = 'Datacollector : Visitors';
    $this->loadViews("visitors/index", $this->global, $data, NULL);
    }
}

    // Show a form to create a new visitor
    public function create() {
        if (!$this->hasCreateAccess()) {
            $this->loadThis(); // Redirect to the unauthorized access page
        } else {
            $this->global['pageTitle'] = 'Datacollector : Create Visitor';
            $this->load->model('District_model');
            $this->load->model('Vidhan_sabha_model');
            
            $query = $this->db->get('block');
            $data['blocks'] = $query->result();
            $data['districts'] = $this->District_model->get_districts();
            $data['vidhan_sabhas'] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            
            $this->loadViews("visitors/create", $this->global, $data, NULL);
        }
    }

    // Insert a new visitor
    public function store() {
        if (!$this->hasCreateAccess()) {
            $this->loadThis(); // Redirect to the unauthorized access page
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'mobile_no' => $this->input->post('mobile_no'),
                'place' => $this->input->post('place'),
                'category' => $this->input->post('category'),
                'post' => $this->input->post('post'),
                'message' => $this->input->post('message'),
                'remark' => $this->input->post('remark'),
                'uss_coding' => $this->input->post('uss_coding'),
                'bhaiya_ke_nirdesh' => $this->input->post('bhaiya_ke_nirdesh'),
                'district' => $this->input->post('district'),
                'vidhan_sabha' => $this->input->post('vidhan_sabha'),
                'block' => $this->input->post('block'),
                'type' => $this->input->post('type'),
                'attend' => $this->input->post('attend'),
              'date' => date('Y-m-d', strtotime($this->input->post('date'))),
              'time' => $this->input->post('time'),
                'in_coming_visitor' => $this->input->post('in_coming_visitor'),
                'createdBy' => $this->vendorId,
            );
            $id = $this->Visitors_model->create_visitor($data);
            if ($id) {
                $this->logActivity('add', 'visitors', $id, $data, null, 'Visitor created with ID: ' . $id . ' (Name: ' . $data['name'] . ')');
            }
            redirect('visitors');
        }
    }

    // Show a form to edit a visitor
    public function edit($id) {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis(); // Redirect to the unauthorized access page
        } else {
            $data['visitor'] = $this->Visitors_model->get_visitor($id);
            
            // Normalize visitor district and vidhan_sabha to uppercase for comparison
            $visitor_district = strtoupper(trim($data['visitor']['district'] ?? ''));
            $visitor_vidhan_sabha = strtoupper(trim($data['visitor']['vidhan_sabha'] ?? ''));
            
            $this->global['pageTitle'] = 'Datacollector : Edit Visitor';
            $this->load->model('District_model');
            $this->load->model('Vidhan_sabha_model');
            
            $query = $this->db->get('block');
            $data['blocks'] = $query->result();
            
            // Get districts and add match field (uppercase for case-insensitive comparison)
            $raw_districts = $this->District_model->get_districts();
            $data['districts'] = [];
            foreach($raw_districts as $dist) {
                $data['districts'][] = [
                    'id' => $dist['id'],
                    'name' => $dist['name'],
                    'match_value' => strtoupper($dist['name']),
                    'is_selected' => ($visitor_district === strtoupper($dist['name'])) ? true : false
                ];
            }
            
            // Get vidhan sabhas and add match field (uppercase for case-insensitive comparison)
            $raw_vs = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            $data['vidhan_sabhas'] = [];
            foreach($raw_vs as $vs) {
                $data['vidhan_sabhas'][] = [
                    'id' => $vs['id'],
                    'name' => $vs['vidhan_sabha_name'],
                    'match_value' => strtoupper($vs['vidhan_sabha_name']),
                    'is_selected' => ($visitor_vidhan_sabha === strtoupper($vs['vidhan_sabha_name'])) ? true : false
                ];
            }
            
            $this->loadViews("visitors/edit", $this->global, $data, NULL);
        }
    }

    // Update a visitor
    public function update($id) {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis(); // Redirect to the unauthorized access page
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'mobile_no' => $this->input->post('mobile_no'),
                'place' => $this->input->post('place'),
                'category' => $this->input->post('category'),
                'post' => $this->input->post('post'),
                'message' => $this->input->post('message'),
                'remark' => $this->input->post('remark'),
                'uss_coding' => $this->input->post('uss_coding'),
                'bhaiya_ke_nirdesh' => $this->input->post('bhaiya_ke_nirdesh'),
                'district' => $this->input->post('district'),
                'type' => $this->input->post('type'),
                'attend' => $this->input->post('attend'),
                'vidhan_sabha' => $this->input->post('vidhan_sabha'),
                'block' => $this->input->post('block'),
                  'date' => date('Y-m-d', strtotime($this->input->post('date'))),           
                  'time' => $this->input->post('time'),
                'in_coming_visitor' => $this->input->post('in_coming_visitor'),
                'updatedBy' => $this->vendorId,
            );
            // Get old data before update for logging
            $oldData = $this->Visitors_model->get_visitor($id);
            
            $result = $this->Visitors_model->update_visitor($id, $data);
            
            if ($result) {
                // Log activity with old and new data
                $this->logActivity('edit', 'visitors', $id, $data, $oldData, 'Visitor updated with ID: ' . $id . ' (Name: ' . $data['name'] . ')');
                $this->session->set_flashdata('success', 'Visitor updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to update visitor. Please try again.');
            }
            
            redirect('visitors');
        }
    }

    // Delete a visitor
    public function delete($id) {
        if (!$this->hasDeleteAccess()) {
            $this->loadThis(); // Redirect to the unauthorized access page
        } else {
            // Get data before delete for logging
            $visitorData = $this->Visitors_model->get_visitor($id);
            
            $this->Visitors_model->delete_visitor($id);
            
            // Log activity
            $this->logActivity('delete', 'visitors', $id, $visitorData, null, 'Visitor deleted with ID: ' . $id . ' (Name: ' . (!empty($visitorData['name']) ? $visitorData['name'] : 'N/A') . ')');
            
            redirect('visitors');
        }
    }

    // Get visitor details for modal view (AJAX)
    public function get_visitor_details($id) {
        if (!$this->hasListAccess()) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $visitor = $this->Visitors_model->get_visitor($id);
        
        if (!$visitor) {
            echo json_encode(['success' => false, 'message' => 'Visitor not found']);
            return;
        }

        // Get block name
        $block = $this->db->get_where('block', ['id' => $visitor['block']])->row_array();
        $visitor['block_name'] = isset($block['name']) ? $block['name'] : '-';

        // Remove ID from response for security
        unset($visitor['id']);

        echo json_encode(['success' => true, 'data' => $visitor]);
    }

}
