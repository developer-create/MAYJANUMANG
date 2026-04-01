<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class PhoneDirectory extends BaseController
{
    // Declare properties that may be dynamically assigned
    public $session;
    public $PhoneDirectory_model;
    public $form_validation;

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PhoneDirectory_model');
        $this->isLoggedIn();
        $this->module = 'Phone-Directory'; // Fixed: Changed to match config (with hyphen)
        $this->load->library('form_validation');
    }

    /**
     * This function used to load the first screen of the phone directory
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Jan Umang : Phone Directory';
        
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->input->post('searchText');
            $searchText = $searchText ? $this->security->xss_clean($searchText) : '';
            $data['searchText'] = $searchText;
            
            $data['phoneDirectoryRecords'] = $this->PhoneDirectory_model->phoneDirectoryListingAll($searchText);
            
            $this->loadViews("phonedirectory/index", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->global['pageTitle'] = 'Jan Umang : Add New Phone Directory Entry';

            $this->form_validation->set_rules('name','Name','trim|required|max_length[255]');
            $this->form_validation->set_rules('number','Number','trim|required|max_length[20]');
            $this->form_validation->set_rules('alternate_number','Alternate Number','trim|max_length[20]');
            $this->form_validation->set_rules('email','Email','trim|valid_email|max_length[255]');
            $this->form_validation->set_rules('post','Post','trim|max_length[255]');
            $this->form_validation->set_rules('department_id','Department','trim|numeric');
            $this->form_validation->set_rules('district_id','District','trim|numeric');
            $this->form_validation->set_rules('vs_block_id','VS Block','trim|numeric');
            $this->form_validation->set_rules('party_id','Party','trim|numeric');
            $this->form_validation->set_rules('remark','Remark','trim');
            
            if($this->form_validation->run() == FALSE)
            {
                $data['departments'] = $this->PhoneDirectory_model->getDepartments();
                $data['districts'] = $this->PhoneDirectory_model->getDistricts();
                $data['blocks'] = $this->PhoneDirectory_model->getBlocks();
                $data['parties'] = $this->PhoneDirectory_model->getParties();
                
                $this->loadViews("phonedirectory/add", $this->global, $data, NULL);
            }
            else
            {
                $name_input = $this->input->post('name');
                $name = $name_input ? ucwords(strtolower($this->security->xss_clean($name_input))) : '';
                
                $post_input = $this->input->post('post');
                $post = $post_input ? $this->security->xss_clean($post_input) : '';
                
                $department_id = $this->input->post('department_id') ? $this->input->post('department_id') : NULL;
                $district_id = $this->input->post('district_id') ? $this->input->post('district_id') : NULL;
                $vs_block_id = $this->input->post('vs_block_id') ? $this->input->post('vs_block_id') : NULL;
                
                $number_input = $this->input->post('number');
                $number = $number_input ? $this->security->xss_clean($number_input) : '';
                
                $alternate_number_input = $this->input->post('alternate_number');
                $alternate_number = $alternate_number_input ? $this->security->xss_clean($alternate_number_input) : '';
                
                $email_input = $this->input->post('email');
                $email = $email_input ? strtolower($this->security->xss_clean($email_input)) : '';
                
                $party_id = $this->input->post('party_id') ? $this->input->post('party_id') : NULL;
                
                $remark_input = $this->input->post('remark');
                $remark = $remark_input ? $this->security->xss_clean($remark_input) : '';
                
                $phoneDirectoryInfo = array(
                    'name' => $name,
                    'post' => $post,
                    'department_id' => $department_id,
                    'district_id' => $district_id,
                    'vs_block_id' => $vs_block_id,
                    'number' => $number,
                    'alternate_number' => $alternate_number,
                    'email' => $email,
                    'party_id' => $party_id,
                    'remark' => $remark,
                    'status' => 'Active',
                    'created_by' => $this->vendorId,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $result = $this->PhoneDirectory_model->addNewPhoneDirectory($phoneDirectoryInfo);
                
                if($result > 0)
                {
                    // Log activity
                    $this->logActivity('add', 'phone_directory', $result, $phoneDirectoryInfo, null, 'Phone Directory entry created with ID: ' . $result . ' (Name: ' . $phoneDirectoryInfo['name'] . ')');
                    $this->session->set_flashdata('success', 'New Phone Directory entry created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Phone Directory entry creation failed');
                }
                
                redirect('phonedirectory');
            }
        }
    }

    /**
     * This function is used load phone directory edit information
     * @param number $phoneDirectoryId : Optional parameter of the phone directory
     */
    function edit($phoneDirectoryId = NULL)
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($phoneDirectoryId == null)
            {
                redirect('phonedirectory');
            }
            
            $data['phoneDirectoryInfo'] = $this->PhoneDirectory_model->getPhoneDirectoryInfo($phoneDirectoryId);
            
            if(empty($data['phoneDirectoryInfo']))
            {
                $this->session->set_flashdata('error', 'Phone Directory entry not found');
                redirect('phonedirectory');
            }
            
            $this->global['pageTitle'] = 'Jan Umang : Edit Phone Directory Entry';
            
            $this->form_validation->set_rules('name','Name','trim|required|max_length[255]');
            $this->form_validation->set_rules('number','Number','trim|required|max_length[20]');
            $this->form_validation->set_rules('alternate_number','Alternate Number','trim|max_length[20]');
            $this->form_validation->set_rules('email','Email','trim|valid_email|max_length[255]');
            $this->form_validation->set_rules('post','Post','trim|max_length[255]');
            $this->form_validation->set_rules('department_id','Department','trim|numeric');
            $this->form_validation->set_rules('district_id','District','trim|numeric');
            $this->form_validation->set_rules('vs_block_id','VS Block','trim|numeric');
            $this->form_validation->set_rules('party_id','Party','trim|numeric');
            $this->form_validation->set_rules('remark','Remark','trim');
            
            if($this->form_validation->run() == FALSE)
            {
                $data['departments'] = $this->PhoneDirectory_model->getDepartments();
                $data['districts'] = $this->PhoneDirectory_model->getDistricts();
                $data['blocks'] = $this->PhoneDirectory_model->getBlocks();
                $data['parties'] = $this->PhoneDirectory_model->getParties();
                
                $this->loadViews("phonedirectory/edit", $this->global, $data, NULL);
            }
            else
            {
                $name_input = $this->input->post('name');
                $name = $name_input ? ucwords(strtolower($this->security->xss_clean($name_input))) : '';
                
                $post_input = $this->input->post('post');
                $post = $post_input ? $this->security->xss_clean($post_input) : '';
                
                $department_id = $this->input->post('department_id') ? $this->input->post('department_id') : NULL;
                $district_id = $this->input->post('district_id') ? $this->input->post('district_id') : NULL;
                $vs_block_id = $this->input->post('vs_block_id') ? $this->input->post('vs_block_id') : NULL;
                
                $number_input = $this->input->post('number');
                $number = $number_input ? $this->security->xss_clean($number_input) : '';
                
                $alternate_number_input = $this->input->post('alternate_number');
                $alternate_number = $alternate_number_input ? $this->security->xss_clean($alternate_number_input) : '';
                
                $email_input = $this->input->post('email');
                $email = $email_input ? strtolower($this->security->xss_clean($email_input)) : '';
                
                $party_id = $this->input->post('party_id') ? $this->input->post('party_id') : NULL;
                
                $remark_input = $this->input->post('remark');
                $remark = $remark_input ? $this->security->xss_clean($remark_input) : '';
                
                $phoneDirectoryInfo = array(
                    'name' => $name,
                    'post' => $post,
                    'department_id' => $department_id,
                    'district_id' => $district_id,
                    'vs_block_id' => $vs_block_id,
                    'number' => $number,
                    'alternate_number' => $alternate_number,
                    'email' => $email,
                    'party_id' => $party_id,
                    'remark' => $remark,
                    'updated_by' => $this->vendorId,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                // Get old data before update for logging
                $oldData = $this->PhoneDirectory_model->getPhoneDirectoryInfo($phoneDirectoryId);
                
                $result = $this->PhoneDirectory_model->editPhoneDirectory($phoneDirectoryInfo, $phoneDirectoryId);
                
                if($result == true)
                {
                    // Log activity with old and new data
                    $this->logActivity('edit', 'phone_directory', $phoneDirectoryId, $phoneDirectoryInfo, (array)$oldData, 'Phone Directory entry updated with ID: ' . $phoneDirectoryId . ' (Name: ' . $phoneDirectoryInfo['name'] . ')');
                    $this->session->set_flashdata('success', 'Phone Directory entry updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Phone Directory entry updation failed');
                }
                
                redirect('phonedirectory');
            }
        }
    }

    /**
     * This function is used to view phone directory information
     * @param number $phoneDirectoryId : Optional parameter of the phone directory
     */
    function view($phoneDirectoryId = NULL)
    {
        if(!$this->hasListAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($phoneDirectoryId == null)
            {
                redirect('phonedirectory');
            }
            
            $data['phoneDirectoryInfo'] = $this->PhoneDirectory_model->getPhoneDirectoryInfo($phoneDirectoryId);
            
            if(empty($data['phoneDirectoryInfo']))
            {
                $this->session->set_flashdata('error', 'Phone Directory entry not found');
                redirect('phonedirectory');
            }
            
            $this->global['pageTitle'] = 'Jan Umang : Phone Directory Details';
            
            $this->loadViews("phonedirectory/view", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to delete phone directory entry
     * @param number $phoneDirectoryId : This is phone directory id
     */
    function delete($phoneDirectoryId = NULL)
    {
        if(!$this->hasDeleteAccess())
        {
            $this->loadThis();
        }
        else
        {
            if($phoneDirectoryId == null)
            {
                $this->session->set_flashdata('error', 'Invalid phone directory entry');
                redirect('phonedirectory');
            }
            else
            {
                $phoneDirectoryInfo = $this->PhoneDirectory_model->getPhoneDirectoryInfo($phoneDirectoryId);
                
                if(empty($phoneDirectoryInfo))
                {
                    $this->session->set_flashdata('error', 'Phone Directory entry not found');
                    redirect('phonedirectory');
                }
                else
                {
                    $result = $this->PhoneDirectory_model->deletePhoneDirectory($phoneDirectoryId);
                    
                    if ($result > 0) {
                        // Log activity
                        $this->logActivity('delete', 'phone_directory', $phoneDirectoryId, (array)$phoneDirectoryInfo, null, 'Phone Directory entry deleted with ID: ' . $phoneDirectoryId . ' (Name: ' . (!empty($phoneDirectoryInfo->name) ? $phoneDirectoryInfo->name : 'N/A') . ')');
                        $this->session->set_flashdata('success', 'Phone Directory entry deleted successfully');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Phone Directory entry deletion failed');
                    }
                    
                    redirect('phonedirectory');
                }
            }
        }
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Jan Umang : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>