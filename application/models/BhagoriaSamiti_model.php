<?php
class BhagoriaSamiti_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get all records (with total members count)
    public function get_all() {
        $blockid = $this->session->userdata('blockId');

        $this->db->select('bhagoria_samiti.*, (SELECT COUNT(*) FROM bhagoria_samiti_members WHERE bhagoria_samiti_members.samiti_id = bhagoria_samiti.id) as total_members');

        if ($blockid != 0) {
            $blockid_array = explode(',', $blockid);
            $this->db->where_in('block', $blockid_array);
        }

        $query = $this->db->get('bhagoria_samiti');
        return $query->result_array();
    }

    // Get single record by ID
    public function get_by_id($id) {
        $query = $this->db->get_where('bhagoria_samiti', array('id' => $id));
        return $query->row_array();
    }

    // Insert new record
    public function create($data) {
        $this->db->insert('bhagoria_samiti', $data);
        return $this->db->insert_id();
    }

    // Update record
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('bhagoria_samiti', $data);
    }

    // Delete record (and its members)
    public function delete($id) {
        $this->db->where('samiti_id', $id);
        $this->db->delete('bhagoria_samiti_members');
        return $this->db->delete('bhagoria_samiti', array('id' => $id));
    }

    // ===== MEMBER METHODS =====

    public function get_members_by_samiti($samiti_id) {
        $this->db->select('*');
        $this->db->from('bhagoria_samiti_members');
        $this->db->where('samiti_id', $samiti_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_member_by_id($id) {
        $query = $this->db->get_where('bhagoria_samiti_members', array('id' => $id));
        return $query->row_array();
    }

    public function create_member($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('bhagoria_samiti_members', $data);
        return $this->db->insert_id();
    }

    public function update_member($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('bhagoria_samiti_members', $data);
    }

    public function delete_member($id) {
        return $this->db->delete('bhagoria_samiti_members', array('id' => $id));
    }
}
?>
