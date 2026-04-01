<?php
class Samiti_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get all samitis
    public function get_samitis() {
        $query = $this->db->get('samiti');
        return $query->result_array();
    }

    // Get a single samiti by ID
    public function get_samiti($id) {
        $query = $this->db->get_where('samiti', array('id' => $id));
        return $query->row_array();
    }

    // Insert a new samiti
    public function create_samiti($data) {
        return $this->db->insert('samiti', $data);
    }

    // Update a samiti
    public function update_samiti($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('samiti', $data);
    }

    // Delete a samiti
    public function delete_samiti($id) {
        return $this->db->delete('samiti', array('id' => $id));
    }
}
?>
