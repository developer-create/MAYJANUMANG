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
}
?>
