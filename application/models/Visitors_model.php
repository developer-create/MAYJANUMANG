<?php
class Visitors_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get all visitors
    public function get_visitors() {
    // $blockid = $this->session->userdata('blockId');

    // if ($blockid != 0) {
    //     // Convert the comma-separated string into an array
    //     $blockid_array = explode(',', $blockid);
 
    //     // Apply the where_in condition before executing the query
    //     $this->db->where_in('visitors.block', $blockid_array);
    // }

    $query = $this->db->get('visitors');
    return $query->result_array();
}

   

   

    // Get a single visitor by ID
    public function get_visitor($id) {
        $query = $this->db->get_where('visitors', array('id' => $id));
        return $query->row_array();
    }

    // Insert a new visitor
    public function create_visitor($data) {
        return $this->db->insert('visitors', $data);
    }

    // Update a visitor
    public function update_visitor($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('visitors', $data);
    }

    // Delete a visitor
    public function delete_visitor($id) {
        return $this->db->delete('visitors', array('id' => $id));
    }
}
?>
