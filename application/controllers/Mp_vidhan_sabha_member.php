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
                    'bg' => $this->input->post('bg'),
                    'bc' => $this->input->post('bc'),
                    'er' => $this->input->post('er'),
                    'br' => $this->input->post('br'),
                    'ip' => $this->input->post('ip'),
                    'sc' => $this->input->post('sc'),
                    'sa' => $this->input->post('sa'),
                    'yc' => $this->input->post('yc'),
                    'ap' => $this->input->post('ap'),
                    'fp' => $this->input->post('fp'),
                    'pp' => $this->input->post('pp'),
                    'wc' => $this->input->post('wc'),
                    'pa' => $this->input->post('pa'),
                    'pc' => $this->input->post('pc'),
                    'ak' => $this->input->post('ak'),
                    'fm' => $this->input->post('fm'),
                    'zp' => $this->input->post('zp'),
                    'vp' => $this->input->post('vp'),
                    'sr' => $this->input->post('sr'),
                    'in_field' => $this->input->post('in_field'),
                    'eo' => $this->input->post('eo'),
                    'gs' => $this->input->post('gs'),
                    'us' => $this->input->post('us'),
                    'pw' => $this->input->post('pw'),
                    'nl' => $this->input->post('nl'),
                    'fr' => $this->input->post('fr'),
                    'so' => $this->input->post('so'),
                    'st' => $this->input->post('st'),
                    'ob' => $this->input->post('ob'),
                    'smw' => $this->input->post('smw'),
                    'smtw' => $this->input->post('smtw'),
                    'it' => $this->input->post('it'),
                    'test' => $this->input->post('test'),
                    'dyc' => $this->input->post('dyc'),
                    'dcc' => $this->input->post('dcc'),
                    'obc' => $this->input->post('obc'),
                    'cell' => $this->input->post('cell'),
                    'mp' => $this->input->post('mp'),
                    'dt' => $this->input->post('dt'),
                    'dp' => $this->input->post('dp'),
                    'avp' => $this->input->post('avp'),
                    'meet' => $this->input->post('meet'),
                    'media' => $this->input->post('media'),
                    'mla_x_mla' => $this->input->post('mla_x_mla'),
                    'vech' => $this->input->post('vech'),
                    'it_cell_exp' => $this->input->post('it_cell_exp'),
                    'info' => $this->input->post('info'),
                    'nsui' => $this->input->post('nsui'),
                    'imp' => $this->input->post('imp'),
                    'advise' => $this->input->post('advise'),
                    'ref' => $this->input->post('ref'),
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
                    'bg' => $this->input->post('bg'),
                    'bc' => $this->input->post('bc'),
                    'er' => $this->input->post('er'),
                    'br' => $this->input->post('br'),
                    'ip' => $this->input->post('ip'),
                    'sc' => $this->input->post('sc'),
                    'sa' => $this->input->post('sa'),
                    'yc' => $this->input->post('yc'),
                    'ap' => $this->input->post('ap'),
                    'fp' => $this->input->post('fp'),
                    'pp' => $this->input->post('pp'),
                    'wc' => $this->input->post('wc'),
                    'pa' => $this->input->post('pa'),
                    'pc' => $this->input->post('pc'),
                    'ak' => $this->input->post('ak'),
                    'fm' => $this->input->post('fm'),
                    'zp' => $this->input->post('zp'),
                    'vp' => $this->input->post('vp'),
                    'sr' => $this->input->post('sr'),
                    'in_field' => $this->input->post('in_field'),
                    'eo' => $this->input->post('eo'),
                    'gs' => $this->input->post('gs'),
                    'us' => $this->input->post('us'),
                    'pw' => $this->input->post('pw'),
                    'nl' => $this->input->post('nl'),
                    'fr' => $this->input->post('fr'),
                    'so' => $this->input->post('so'),
                    'st' => $this->input->post('st'),
                    'ob' => $this->input->post('ob'),
                    'smw' => $this->input->post('smw'),
                    'smtw' => $this->input->post('smtw'),
                    'it' => $this->input->post('it'),
                    'test' => $this->input->post('test'),
                    'dyc' => $this->input->post('dyc'),
                    'dcc' => $this->input->post('dcc'),
                    'obc' => $this->input->post('obc'),
                    'cell' => $this->input->post('cell'),
                    'mp' => $this->input->post('mp'),
                    'dt' => $this->input->post('dt'),
                    'dp' => $this->input->post('dp'),
                    'avp' => $this->input->post('avp'),
                    'meet' => $this->input->post('meet'),
                    'media' => $this->input->post('media'),
                    'mla_x_mla' => $this->input->post('mla_x_mla'),
                    'vech' => $this->input->post('vech'),
                    'it_cell_exp' => $this->input->post('it_cell_exp'),
                    'info' => $this->input->post('info'),
                    'nsui' => $this->input->post('nsui'),
                    'imp' => $this->input->post('imp'),
                    'advise' => $this->input->post('advise'),
                    'ref' => $this->input->post('ref'),
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
}
?>
