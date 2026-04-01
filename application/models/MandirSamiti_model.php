<?php
class MandirSamiti_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // ===== GROUP/LOCATION METHODS =====
    
    // Get all groups with member count
    public function get_all_groups() {
        $this->db->select('mandir_samiti_groups.*, block.name as block_name, booth.name as booth_name, booth.bnumber as booth_no,
                          (SELECT COUNT(*) FROM mandir_samiti WHERE mandir_samiti.group_id = mandir_samiti_groups.id) as total_members');
        $this->db->from('mandir_samiti_groups');
        $this->db->join('block', 'block.id = mandir_samiti_groups.block', 'left');
        $this->db->join('booth', 'booth.id = mandir_samiti_groups.booth_name', 'left');
        $this->db->order_by('mandir_samiti_groups.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get single group by ID
    public function get_group_by_id($id) {
        // Keep original booth_name as booth_id for form selection
        $this->db->select('mandir_samiti_groups.*, block.name as block_name, 
                          mandir_samiti_groups.booth_name as booth_id,
                          booth.name as booth_display_name, booth.bnumber as booth_no');
        $this->db->from('mandir_samiti_groups');
        $this->db->join('block', 'block.id = mandir_samiti_groups.block', 'left');
        $this->db->join('booth', 'booth.id = mandir_samiti_groups.booth_name', 'left');
        $this->db->where('mandir_samiti_groups.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Create new group
    public function create_group($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('mandir_samiti_groups', $data);
        return $this->db->insert_id();
    }

    // Update group
    public function update_group($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('mandir_samiti_groups', $data);
    }

    // Delete group
    public function delete_group($id) {
        // Delete all members first
        $this->db->where('group_id', $id);
        $this->db->delete('mandir_samiti');
        
        // Delete group
        $this->db->where('id', $id);
        return $this->db->delete('mandir_samiti_groups');
    }

    // ===== MEMBER METHODS =====
    
    // Get all members for a specific group
    public function get_members_by_group($group_id) {
        $this->db->select('*');
        $this->db->from('mandir_samiti');
        $this->db->where('group_id', $group_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get single member by ID
    public function get_member_by_id($id) {
        $query = $this->db->get_where('mandir_samiti', array('id' => $id));
        return $query->row_array();
    }

    // Create new member
    public function create_member($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('mandir_samiti', $data);
        return $this->db->insert_id();
    }

    // Update member
    public function update_member($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('mandir_samiti', $data);
    }

    // Delete member
    public function delete_member($id) {
        $this->db->where('id', $id);
        return $this->db->delete('mandir_samiti');
    }

    // ===== HELPER METHODS =====
    
    // Get all blocks
    public function get_blocks() {
        $this->db->select('*');
        $this->db->from('block');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get booths by block ID
    public function get_booths_by_block($block_id) {
        $this->db->select('id, name, bnumber');
        $this->db->from('booth');
        $this->db->where('blockid', $block_id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Get booth details by booth ID
    public function get_booth_details($booth_id) {
        $query = $this->db->get_where('booth', array('id' => $booth_id));
        return $query->row();
    }

    // Get panchayat by booth ID
    public function get_panchayat_by_booth($booth_id) {
        $this->db->select('*');
        $this->db->from('panchayat');
        $this->db->where('boothid', $booth_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Get villages by panchayat ID
    public function get_villages_by_panchayat($panchayat_id) {
        $this->db->select('*');
        $this->db->from('village');
        $this->db->where('panchayatid', $panchayat_id);
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // ===== BACKWARD COMPATIBILITY METHODS =====
    
    // For existing controller compatibility
    function getGroups() {
        return $this->get_all_groups();
    }
    
    function getGroupInfo($groupId) {
        $result = $this->get_group_by_id($groupId);
        return (object)$result; // Convert to object for compatibility
    }
    
    function addGroup($groupInfo) {
        return $this->create_group($groupInfo);
    }
    
    function editGroup($groupInfo, $groupId) {
        return $this->update_group($groupId, $groupInfo);
    }
    
    function deleteGroup($groupId) {
        return $this->delete_group($groupId);
    }
    
    function getMembers($groupId) {
        $members = $this->get_members_by_group($groupId);
        // Convert to object for compatibility
        return array_map(function($member) {
            return (object)$member;
        }, $members);
    }
    
    function getMemberInfo($memberId) {
        $result = $this->get_member_by_id($memberId);
        return (object)$result; // Convert to object for compatibility
    }
    
    function addMember($memberInfo) {
        return $this->create_member($memberInfo);
    }
    
    function editMember($memberInfo, $memberId) {
        return $this->update_member($memberId, $memberInfo);
    }
    
    function deleteMember($memberId) {
        return $this->delete_member($memberId);
    }
    
    function getBlocks() {
        return $this->get_blocks();
    }
    
    function getBoothsByBlock($blockId) {
        return $this->get_booths_by_block($blockId);
    }
    
    function getBoothDetails($boothId) {
        return $this->get_booth_details($boothId);
    }
    
    function getPanchayatByBooth($boothId) {
        return $this->get_panchayat_by_booth($boothId);
    }
    
    function getVillagesByPanchayat($panchayatId) {
        return $this->get_villages_by_panchayat($panchayatId);
    }
}
