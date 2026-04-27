<?php
require APPPATH . '/libraries/BaseController.php';

class Mp_vidhan_sabha_member extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mp_vidhan_sabha_member_model');
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('Comman_model');
        $this->isLoggedIn();
        $this->load->model('Log_model');
        $this->load->library('form_validation');
        $this->module = 'MP-Vidhan-Sabha-Member';
    }

    // Display all members
    public function index() {
        if(!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            // Get filter values from GET request
            $filter_district = $this->input->get('filter_district');
            $filter_block = $this->input->get('filter_block');
            $filter_vidhan_sabha = $this->input->get('filter_vidhan_sabha');
            $filter_month = $this->input->get('filter_month');
            $filter_year = $this->input->get('filter_year');
            
            // Get all members
            $all_members = $this->Mp_vidhan_sabha_member_model->get_members();
            
            // Apply filters
            $filtered_members = $all_members;
            
            if (!empty($filter_district)) {
                $filtered_members = array_filter($filtered_members, function($member) use ($filter_district) {
                    return $member['district_id'] == $filter_district;
                });
            }
            
            if (!empty($filter_block)) {
                $filtered_members = array_filter($filtered_members, function($member) use ($filter_block) {
                    return $member['block_id'] == $filter_block;
                });
            }
            
            if (!empty($filter_vidhan_sabha)) {
                $filtered_members = array_filter($filtered_members, function($member) use ($filter_vidhan_sabha) {
                    return $member['vidhan_sabha_id'] == $filter_vidhan_sabha;
                });
            }
            
            if (!empty($filter_month)) {
                $filtered_members = array_filter($filtered_members, function($member) use ($filter_month) {
                    return !empty($member['date']) && date('m', strtotime($member['date'])) == str_pad($filter_month, 2, '0', STR_PAD_LEFT);
                });
            }
            
            if (!empty($filter_year)) {
                $filtered_members = array_filter($filtered_members, function($member) use ($filter_year) {
                    return !empty($member['date']) && date('Y', strtotime($member['date'])) == $filter_year;
                });
            }
            
            // Load dropdown data
            $this->load->model('District_model');
            $this->load->model('Block_model');
            $this->load->model('Vidhan_sabha_model');
            
            $data['members'] = array_values($filtered_members);
            $data['districts'] = $this->District_model->get_districts();
            $data['blocks'] = $this->Block_model->get_blocks();
            $data['vidhan_sabhas'] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            
            // Pass filter values to view
            $data['filter_district'] = $filter_district;
            $data['filter_block'] = $filter_block;
            $data['filter_vidhan_sabha'] = $filter_vidhan_sabha;
            $data['filter_month'] = $filter_month;
            $data['filter_year'] = $filter_year;
            
            $this->global['pageTitle'] = 'Datacollector : MP Vidhan Sabha Member';
            $this->loadViews("mp_vidhan_sabha_member/index", $this->global, $data, NULL);
        }
    }

    // Show a form to create a new member
    public function create() {
        if(!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->model('District_model');
            $this->load->model('Block_model');
            $this->load->model('Panchayat_model');
            $this->load->model('Vidhan_sabha_model');
            $this->load->model('Village_model');
            
            $data['districts'] = $this->District_model->get_districts();
            $data['blocks'] = $this->Block_model->get_blocks();
            $data['panchayats'] = $this->Panchayat_model->get_panchayats();
            $data['vidhan_sabhas'] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            $data['villages'] = $this->Village_model->get_villages();
            
            $this->global['pageTitle'] = 'Datacollector : Add MP Vidhan Sabha Member';
            $this->loadViews("mp_vidhan_sabha_member/create", $this->global, $data, NULL);
        }
    }

    // Insert a new member
    public function store() {
        if(!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
                    'month' => $this->input->post('month'),
                    'date' => $this->input->post('date'),
                    'block_id' => !empty($this->input->post('block_id')) ? (int)$this->input->post('block_id') : null,
                    'panchayat_id' => !empty($this->input->post('panchayat_id')) ? (int)$this->input->post('panchayat_id') : null,
                    'vidhan_sabha_id' => !empty($this->input->post('vidhan_sabha_id')) ? (int)$this->input->post('vidhan_sabha_id') : null,
                    'district_id' => !empty($this->input->post('district_id')) ? (int)$this->input->post('district_id') : null,
                    'village_id' => !empty($this->input->post('village_id')) ? (int)$this->input->post('village_id') : null,
                    'name' => $this->input->post('name'),
                    'position' => $this->input->post('position'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'bg' => $this->input->post('bg') ? 1 : 0,
                    'bc' => $this->input->post('bc') ? 1 : 0,
                    'er' => $this->input->post('er') ? 1 : 0,
                    'br' => $this->input->post('br') ? 1 : 0,
                    'ip' => $this->input->post('ip') ? 1 : 0,
                    'sc' => $this->input->post('sc') ? 1 : 0,
                    'sa' => $this->input->post('sa') ? 1 : 0,
                    'yc' => $this->input->post('yc') ? 1 : 0,
                    'ap' => $this->input->post('ap') ? 1 : 0,
                    'fp' => $this->input->post('fp') ? 1 : 0,
                    'pp' => $this->input->post('pp') ? 1 : 0,
                    'wc' => $this->input->post('wc') ? 1 : 0,
                    'pa' => $this->input->post('pa') ? 1 : 0,
                    'pc' => $this->input->post('pc') ? 1 : 0,
                    'ak' => $this->input->post('ak') ? 1 : 0,
                    'fm' => $this->input->post('fm') ? 1 : 0,
                    'zp' => $this->input->post('zp') ? 1 : 0,
                    'vp' => $this->input->post('vp') ? 1 : 0,
                    'sr' => $this->input->post('sr') ? 1 : 0,
                    'in_field' => $this->input->post('in_field') ? 1 : 0,
                    'eo' => $this->input->post('eo') ? 1 : 0,
                    'gs' => $this->input->post('gs') ? 1 : 0,
                    'us' => $this->input->post('us') ? 1 : 0,
                    'pw' => $this->input->post('pw') ? 1 : 0,
                    'nl' => $this->input->post('nl') ? 1 : 0,
                    'fr' => $this->input->post('fr') ? 1 : 0,
                    'so' => $this->input->post('so') ? 1 : 0,
                    'st' => $this->input->post('st') ? 1 : 0,
                    'ob' => $this->input->post('ob') ? 1 : 0,
                    'smw' => $this->input->post('smw') ? 1 : 0,
                    'smtw' => $this->input->post('smtw') ? 1 : 0,
                    'it' => $this->input->post('it') ? 1 : 0,
                    'test' => $this->input->post('test') ? 1 : 0,
                    'dyc' => $this->input->post('dyc') ? 1 : 0,
                    'dcc' => $this->input->post('dcc') ? 1 : 0,
                    'obc' => $this->input->post('obc') ? 1 : 0,
                    'cell' => $this->input->post('cell') ? 1 : 0,
                    'mp' => $this->input->post('mp') ? 1 : 0,
                    'dt' => $this->input->post('dt') ? 1 : 0,
                    'dp' => $this->input->post('dp') ? 1 : 0,
                    'avp' => $this->input->post('avp') ? 1 : 0,
                    'meet' => $this->input->post('meet') ? 1 : 0,
                    'media' => $this->input->post('media') ? 1 : 0,
                    'mla_x_mla' => $this->input->post('mla_x_mla') ? 1 : 0,
                    'vech' => $this->input->post('vech') ? 1 : 0,
                    'it_cell_exp' => $this->input->post('it_cell_exp') ? 1 : 0,
                    'info' => $this->input->post('info') ? 1 : 0,
                    'nsui' => $this->input->post('nsui') ? 1 : 0,
                    'imp' => $this->input->post('imp') ? 1 : 0,
                    'advise' => $this->input->post('advise') ? 1 : 0,
                    'ref' => $this->input->post('ref') ? 1 : 0,
                    'remark' => $this->input->post('remark'),
                    'created_by' => $this->session->userdata('userId'),
                    'added_by' => $this->session->userdata('userId')
                );

                $insert_id = $this->Mp_vidhan_sabha_member_model->create_member($data);
                if ($insert_id) {
                    $this->logActivity('add', 'mp_vidhan_sabha_member', $insert_id, $data, null, 'MP Vidhan Sabha Member created with ID: ' . $insert_id . ' (Name: ' . $data['name'] . ')');
                    $this->session->set_flashdata('success', 'Member created successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create Member.');
                }

                redirect('mp_vidhan_sabha_member');
            }
        }
    }

    // Show a form to edit a member
    public function edit($id) {
        if(!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $data['member'] = $this->Mp_vidhan_sabha_member_model->get_member($id);
            if (empty($data['member'])) {
                $this->session->set_flashdata('error', 'Member not found.');
                redirect('mp_vidhan_sabha_member');
            }
            
            $this->load->model('District_model');
            $this->load->model('Block_model');
            $this->load->model('Panchayat_model');
            $this->load->model('Vidhan_sabha_model');
            $this->load->model('Village_model');
            
            $data['districts'] = $this->District_model->get_districts();
            $data['blocks'] = $this->Block_model->get_blocks();
            $data['panchayats'] = $this->Panchayat_model->get_panchayats();
            $data['vidhan_sabhas'] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            $data['villages'] = $this->Village_model->get_villages();
            
            $this->global['pageTitle'] = 'Datacollector : Edit MP Vidhan Sabha Member';
            $this->loadViews("mp_vidhan_sabha_member/edit", $this->global, $data, NULL);
        }
    }

    // Update a member
    public function update($id) {
        if(!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($id);
            } else {
                $data = array(
                    'month' => $this->input->post('month'),
                    'date' => $this->input->post('date'),
                    'block_id' => !empty($this->input->post('block_id')) ? (int)$this->input->post('block_id') : null,
                    'panchayat_id' => !empty($this->input->post('panchayat_id')) ? (int)$this->input->post('panchayat_id') : null,
                    'vidhan_sabha_id' => !empty($this->input->post('vidhan_sabha_id')) ? (int)$this->input->post('vidhan_sabha_id') : null,
                    'district_id' => !empty($this->input->post('district_id')) ? (int)$this->input->post('district_id') : null,
                    'village_id' => !empty($this->input->post('village_id')) ? (int)$this->input->post('village_id') : null,
                    'name' => $this->input->post('name'),
                    'position' => $this->input->post('position'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'bg' => $this->input->post('bg') ? 1 : 0,
                    'bc' => $this->input->post('bc') ? 1 : 0,
                    'er' => $this->input->post('er') ? 1 : 0,
                    'br' => $this->input->post('br') ? 1 : 0,
                    'ip' => $this->input->post('ip') ? 1 : 0,
                    'sc' => $this->input->post('sc') ? 1 : 0,
                    'sa' => $this->input->post('sa') ? 1 : 0,
                    'yc' => $this->input->post('yc') ? 1 : 0,
                    'ap' => $this->input->post('ap') ? 1 : 0,
                    'fp' => $this->input->post('fp') ? 1 : 0,
                    'pp' => $this->input->post('pp') ? 1 : 0,
                    'wc' => $this->input->post('wc') ? 1 : 0,
                    'pa' => $this->input->post('pa') ? 1 : 0,
                    'pc' => $this->input->post('pc') ? 1 : 0,
                    'ak' => $this->input->post('ak') ? 1 : 0,
                    'fm' => $this->input->post('fm') ? 1 : 0,
                    'zp' => $this->input->post('zp') ? 1 : 0,
                    'vp' => $this->input->post('vp') ? 1 : 0,
                    'sr' => $this->input->post('sr') ? 1 : 0,
                    'in_field' => $this->input->post('in_field') ? 1 : 0,
                    'eo' => $this->input->post('eo') ? 1 : 0,
                    'gs' => $this->input->post('gs') ? 1 : 0,
                    'us' => $this->input->post('us') ? 1 : 0,
                    'pw' => $this->input->post('pw') ? 1 : 0,
                    'nl' => $this->input->post('nl') ? 1 : 0,
                    'fr' => $this->input->post('fr') ? 1 : 0,
                    'so' => $this->input->post('so') ? 1 : 0,
                    'st' => $this->input->post('st') ? 1 : 0,
                    'ob' => $this->input->post('ob') ? 1 : 0,
                    'smw' => $this->input->post('smw') ? 1 : 0,
                    'smtw' => $this->input->post('smtw') ? 1 : 0,
                    'it' => $this->input->post('it') ? 1 : 0,
                    'test' => $this->input->post('test') ? 1 : 0,
                    'dyc' => $this->input->post('dyc') ? 1 : 0,
                    'dcc' => $this->input->post('dcc') ? 1 : 0,
                    'obc' => $this->input->post('obc') ? 1 : 0,
                    'cell' => $this->input->post('cell') ? 1 : 0,
                    'mp' => $this->input->post('mp') ? 1 : 0,
                    'dt' => $this->input->post('dt') ? 1 : 0,
                    'dp' => $this->input->post('dp') ? 1 : 0,
                    'avp' => $this->input->post('avp') ? 1 : 0,
                    'meet' => $this->input->post('meet') ? 1 : 0,
                    'media' => $this->input->post('media') ? 1 : 0,
                    'mla_x_mla' => $this->input->post('mla_x_mla') ? 1 : 0,
                    'vech' => $this->input->post('vech') ? 1 : 0,
                    'it_cell_exp' => $this->input->post('it_cell_exp') ? 1 : 0,
                    'info' => $this->input->post('info') ? 1 : 0,
                    'nsui' => $this->input->post('nsui') ? 1 : 0,
                    'imp' => $this->input->post('imp') ? 1 : 0,
                    'advise' => $this->input->post('advise') ? 1 : 0,
                    'ref' => $this->input->post('ref') ? 1 : 0,
                    'remark' => $this->input->post('remark'),
                    'updated_time' => date('Y-m-d H:i:s')
                );

                $oldData = $this->Mp_vidhan_sabha_member_model->get_member($id);
                
                $result = $this->Mp_vidhan_sabha_member_model->update_member($id, $data);
                if ($result) {
                    $this->logActivity('edit', 'mp_vidhan_sabha_member', $id, $data, (array)$oldData, 'MP Vidhan Sabha Member updated with ID: ' . $id . ' (Name: ' . $data['name'] . ')');
                    $this->session->set_flashdata('success', 'Member updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update Member.');
                }

                redirect('mp_vidhan_sabha_member');
            }
        }
    }

    // Delete a member
    public function delete($id) {
        if(!$this->hasDeleteAccess()) {
            $this->loadThis();
        } else {
            $member = $this->Mp_vidhan_sabha_member_model->get_member($id);
            if (empty($member)) {
                $this->session->set_flashdata('error', 'Member not found.');
            } else {
                $result = $this->Mp_vidhan_sabha_member_model->delete_member($id);
                if ($result) {
                    $this->logActivity('delete', 'mp_vidhan_sabha_member', $id, (array)$member, null, 'MP Vidhan Sabha Member deleted with ID: ' . $id . ' (Name: ' . (!empty($member['name']) ? $member['name'] : 'N/A') . ')');
                    $this->session->set_flashdata('success', 'Member deleted successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Failed to delete Member.');
                }
            }
            redirect('mp_vidhan_sabha_member');
        }
    }

    // Show bulk upload form
    public function bulk_upload() {
        if(!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->model('District_model');
            $this->load->model('Block_model');
            $this->load->model('Panchayat_model');
            $this->load->model('Vidhan_sabha_model');
            $this->load->model('Village_model');
            
            $data['districts'] = $this->District_model->get_districts();
            $data['blocks'] = $this->Block_model->get_blocks();
            $data['panchayats'] = $this->Panchayat_model->get_panchayats();
            $data['vidhan_sabhas'] = $this->Vidhan_sabha_model->get_vidhan_sabhas();
            $data['villages'] = $this->Village_model->get_villages();
            
            $this->global['pageTitle'] = 'Datacollector : Bulk Upload MP Vidhan Sabha Members';
            $this->loadViews("mp_vidhan_sabha_member/bulk_upload", $this->global, $data, NULL);
        }
    }

    // Process bulk upload
    public function process_bulk_upload() {
        if(!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $config['upload_path'] = './uploads/bulk/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 10240; // 10MB
            
            // Create upload directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }
            
            $this->load->library('upload', $config);
            $this->load->helper('bulk_upload');
            
            if (!$this->upload->do_upload('bulk_file')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('mp_vidhan_sabha_member/bulk_upload');
            } else {
                $upload_data = $this->upload->data();
                $file_path = $upload_data['full_path'];
                
                try {
                    $rows = parse_bulk_upload_file($file_path);
                    
                    if (empty($rows)) {
                        $file_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                        if ($file_ext === 'xlsx' || $file_ext === 'xls') {
                            throw new Exception('Excel file parsing failed. Please convert your Excel file to CSV format and try again. To convert: Open in Excel → Save As → CSV (Comma delimited)');
                        } else {
                            throw new Exception('Unable to parse file. Please ensure it is a valid CSV file.');
                        }
                    }
                    
                    // Get header row to map columns dynamically
                    $headers = array_map('trim', $rows[0]);
                    $column_map = array();
                    
                    // Map column names to indices
                    foreach ($headers as $index => $header) {
                        $column_map[strtolower(str_replace(' ', '_', $header))] = $index;
                    }
                    
                    $success_count = 0;
                    $error_count = 0;
                    $errors = array();
                    
                    // Skip header row (start from index 1)
                    for ($i = 1; $i < count($rows); $i++) {
                        $row = $rows[$i];
                        
                        // Skip completely empty rows only
                        if (empty(array_filter($row))) continue;
                        
                        // Helper function to get value by column name
                        $get_col = function($col_name) use ($row, $column_map) {
                            $key = strtolower(str_replace(' ', '_', $col_name));
                            return isset($column_map[$key]) && isset($row[$column_map[$key]]) ? trim($row[$column_map[$key]]) : '';
                        };
                        
                        // Lookup IDs from names or IDs
                        $district_id = !empty($get_col('District ID')) ? (int)$get_col('District ID') : null;
                        if (!$district_id && !empty($get_col('District Name'))) {
                            $district_id = get_id_by_name($this, 'district', 'name', $get_col('District Name'));
                        }
                        
                        $block_id = !empty($get_col('Block ID')) ? (int)$get_col('Block ID') : null;
                        if (!$block_id && !empty($get_col('Block Name'))) {
                            $block_id = get_id_by_name($this, 'block', 'name', $get_col('Block Name'));
                        }

                        $vidhan_sabha_id = !empty($get_col('Vidhan Sabha ID')) ? (int)$get_col('Vidhan Sabha ID') : null;
                        if (!$vidhan_sabha_id && !empty($get_col('Vidhan Sabha Name'))) {
                            $vidhan_sabha_id = get_id_by_name($this, 'vidhan_sabha', 'vidhan_sabha_name', $get_col('Vidhan Sabha Name'));
                        }

                        $panchayat_id = !empty($get_col('Panchayat ID')) ? (int)$get_col('Panchayat ID') : null;
                        $panchayat_name = $get_col('Panchayat Name');
                        if (!$panchayat_id && !empty($panchayat_name)) {
                            $panchayat_id = get_id_by_name($this, 'panchayat', 'name', $panchayat_name, 'blockid', $block_id);
                            if (empty($panchayat_id)) {
                                $this->db->insert('panchayat', ['name' => $panchayat_name, 'blockid' => $block_id ?: 0]);
                                $panchayat_id = $this->db->insert_id();
                            }
                        }

                        // Village handling
                        $village_id = !empty($get_col('Village ID')) && is_numeric($get_col('Village ID')) ? (int)$get_col('Village ID') : null;
                        $village_name = $get_col('Village Name');
                        if (empty($village_name) && !is_numeric($get_col('Village ID'))) {
                            $village_name = $get_col('Village ID'); // might be a name placed in the ID column
                        }
                        if (empty($village_name)) {
                            $village_name = $get_col('Village'); // another possible header
                        }
                        
                        if (!$village_id && !empty($village_name)) {
                            $village_id = get_id_by_name($this, 'village', 'name', $village_name, 'blockid', $block_id);
                            if (empty($village_id)) {
                                $this->db->insert('village', ['name' => $village_name, 'blockid' => $block_id ?: 0, 'panchayatid' => $panchayat_id ?: 0]);
                                $village_id = $this->db->insert_id();
                            }
                        }
                        
                        $data = array(
                            'month' => !empty($get_col('Month')) ? $get_col('Month') : null,
                            'date' => !empty($get_col('Date')) ? date('Y-m-d', strtotime($get_col('Date'))) : null,
                            'district_id' => $district_id,
                            'block_id' => $block_id,
                            'panchayat_id' => $panchayat_id,
                            'vidhan_sabha_id' => $vidhan_sabha_id,
                            'village_id' => $village_id,
                            'name' => !empty($get_col('Name')) ? $get_col('Name') : '',
                            'position' => !empty($get_col('Position')) ? $get_col('Position') : '',
                            'mobile_no' => !empty($get_col('Mobile No')) ? $get_col('Mobile No') : '',
                            'bg' => !empty($get_col('BG')) ? 1 : 0,
                            'bc' => !empty($get_col('BC')) ? 1 : 0,
                            'er' => !empty($get_col('ER')) ? 1 : 0,
                            'br' => !empty($get_col('BR')) ? 1 : 0,
                            'ip' => !empty($get_col('IP')) ? 1 : 0,
                            'sc' => !empty($get_col('SC')) ? 1 : 0,
                            'sa' => !empty($get_col('SA')) ? 1 : 0,
                            'yc' => !empty($get_col('YC')) ? 1 : 0,
                            'ap' => !empty($get_col('AP')) ? 1 : 0,
                            'fp' => !empty($get_col('FP')) ? 1 : 0,
                            'pp' => !empty($get_col('PP')) ? 1 : 0,
                            'wc' => !empty($get_col('WC')) ? 1 : 0,
                            'pa' => !empty($get_col('PA')) ? 1 : 0,
                            'pc' => !empty($get_col('PC')) ? 1 : 0,
                            'ak' => !empty($get_col('AK')) ? 1 : 0,
                            'fm' => !empty($get_col('FM')) ? 1 : 0,
                            'zp' => !empty($get_col('ZP')) ? 1 : 0,
                            'vp' => !empty($get_col('VP')) ? 1 : 0,
                            'sr' => !empty($get_col('SR')) ? 1 : 0,
                            'in_field' => !empty($get_col('In Field')) ? 1 : 0,
                            'eo' => !empty($get_col('EO')) ? 1 : 0,
                            'gs' => !empty($get_col('GS')) ? 1 : 0,
                            'us' => !empty($get_col('US')) ? 1 : 0,
                            'pw' => !empty($get_col('PW')) ? 1 : 0,
                            'nl' => !empty($get_col('NL')) ? 1 : 0,
                            'fr' => !empty($get_col('FR')) ? 1 : 0,
                            'so' => !empty($get_col('SO')) ? 1 : 0,
                            'st' => !empty($get_col('ST')) ? 1 : 0,
                            'ob' => !empty($get_col('OB')) ? 1 : 0,
                            'smw' => !empty($get_col('SMW')) ? 1 : 0,
                            'smtw' => !empty($get_col('SMTW')) ? 1 : 0,
                            'it' => !empty($get_col('IT')) ? 1 : 0,
                            'test' => !empty($get_col('Test')) ? 1 : 0,
                            'dyc' => !empty($get_col('DYC')) ? 1 : 0,
                            'dcc' => !empty($get_col('DCC')) ? 1 : 0,
                            'obc' => !empty($get_col('OBC')) ? 1 : 0,
                            'cell' => !empty($get_col('Cell')) ? 1 : 0,
                            'mp' => !empty($get_col('MP')) ? 1 : 0,
                            'dt' => !empty($get_col('DT')) ? 1 : 0,
                            'dp' => !empty($get_col('DP')) ? 1 : 0,
                            'avp' => !empty($get_col('AVP')) ? 1 : 0,
                            'meet' => !empty($get_col('Meet')) ? 1 : 0,
                            'media' => !empty($get_col('Media')) ? 1 : 0,
                            'mla_x_mla' => !empty($get_col('MLA X MLA')) ? 1 : 0,
                            'vech' => !empty($get_col('Vech')) ? 1 : 0,
                            'it_cell_exp' => !empty($get_col('IT Cell Exp')) ? 1 : 0,
                            'info' => !empty($get_col('Info')) ? 1 : 0,
                            'nsui' => !empty($get_col('NSUI')) ? 1 : 0,
                            'imp' => !empty($get_col('IMP')) ? 1 : 0,
                            'advise' => !empty($get_col('Advise')) ? 1 : 0,
                            'ref' => !empty($get_col('Ref')) ? 1 : 0,
                            'remark' => !empty($get_col('Remark')) ? $get_col('Remark') : '',
                            'created_by' => $this->session->userdata('userId'),
                            'added_by' => $this->session->userdata('userId')
                        );
                        
                        // Validate required fields
                        if (empty($data['name'])) {
                            $errors[] = "Row " . ($i + 1) . ": Name is required";
                            $error_count++;
                            continue;
                        }
                        
                        $insert_id = $this->Mp_vidhan_sabha_member_model->create_member($data);
                        if ($insert_id) {
                            $this->logActivity('add', 'mp_vidhan_sabha_member', $insert_id, $data, null, 'MP Vidhan Sabha Member created via bulk upload with ID: ' . $insert_id . ' (Name: ' . $data['name'] . ')');
                            $success_count++;
                        } else {
                            $errors[] = "Row " . ($i + 1) . ": Failed to insert member";
                            $error_count++;
                        }
                    }
                    
                    // Clean up uploaded file
                    unlink($file_path);
                    
                    $message = "Bulk upload completed. Success: $success_count, Errors: $error_count";
                    if (!empty($errors)) {
                        $message .= "\nErrors: " . implode(", ", array_slice($errors, 0, 5));
                        if (count($errors) > 5) {
                            $message .= " and " . (count($errors) - 5) . " more...";
                        }
                    }
                    
                    if ($success_count > 0) {
                        $this->session->set_flashdata('success', $message);
                    } else {
                        $this->session->set_flashdata('error', $message);
                    }
                    
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', 'Error processing file: ' . $e->getMessage());
                }
                
                redirect('mp_vidhan_sabha_member');
            }
        }
    }

    // Download sample CSV template
    public function download_template() {
        $filename = 'mp_vidhan_sabha_member_template.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // CSV headers
        $headers = array(
            'Month', 'Date (YYYY-MM-DD)', 'District ID', 'Block ID', 'Panchayat ID', 'Vidhan Sabha ID', 'Village ID',
            'Name*', 'Position', 'Mobile No', 'BG', 'BC', 'ER', 'BR', 'IP', 'SC', 'SA', 'YC', 'AP', 'FP', 'PP', 'WC',
            'PA', 'PC', 'AK', 'FM', 'ZP', 'VP', 'SR', 'In Field', 'EO', 'GS', 'US', 'PW', 'NL', 'FR', 'SO', 'ST',
            'OB', 'SMW', 'SMTW', 'IT', 'Test', 'DYC', 'DCC', 'OBC', 'Cell', 'MP', 'DT', 'DP', 'AVP', 'Meet', 'Media',
            'MLA X MLA', 'Vech', 'IT Cell Exp', 'Info', 'NSUI', 'IMP', 'Advise', 'Ref', 'Remark'
        );
        
        fputcsv($output, $headers);
        
        // Sample data row
        $sample = array(
            'January', '2026-01-15', '1', '1', '1', '1', '1', 'Sample Name', 'Sample Position', '9876543210',
            '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0',
            '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', '1', '0',
            '1', '0', '1', '0', '1', '0', '1', '0', '1', '0', 'Sample remark'
        );
        
        fputcsv($output, $sample);
        fclose($output);
    }

    // Get Vidhan Sabha by District (AJAX endpoint)
    public function get_vidhan_sabhas_by_district() {
        $this->load->model('Vidhan_sabha_model');
        
        $district_id = $this->input->post('district_id');
        $vidhan_sabhas = $this->Vidhan_sabha_model->get_vidhan_sabhas_by_district($district_id);
        
        header('Content-Type: application/json');
        echo json_encode($vidhan_sabhas);
    }

    public function get_panchayats_by_block() {
        $this->load->model('Panchayat_model');
        
        $block_id = $this->input->post('block_id');
        if ($block_id) {
            $panchayats = $this->Panchayat_model->get_panchayats_by_block($block_id);
            header('Content-Type: application/json');
            echo json_encode(array('error' => false, 'panchayats' => $panchayats));
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => true, 'message' => 'Block ID is required'));
        }
    }

    public function get_villages_by_panchayat() {
        $this->load->model('Village_model');
        
        $panchayat_id = $this->input->post('panchayat_id');
        if ($panchayat_id) {
            $villages = $this->Village_model->get_villages_by_panchayat($panchayat_id);
            header('Content-Type: application/json');
            echo json_encode(array('error' => false, 'villages' => $villages));
        } else {
            header('Content-Type: application/json');
            echo json_encode(array('error' => true, 'message' => 'Panchayat ID is required'));
        }
    }
}
