<?php
class Panchayat_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get all panchayats
public function get_panchayats() {
    $this->db->select('panchayat.*, block.name as block_name, booth.name as booth_name, booth.year'); // Select columns from all tables
    $this->db->from('panchayat');
    $this->db->join('block', 'block.id = panchayat.blockid', 'left'); // Join block table on blockid
    $this->db->join('booth', 'booth.id = panchayat.boothid', 'left'); // Join booth table on boothid
    $query = $this->db->get();
    return $query->result_array();
}


    // Get a single panchayat by ID
    public function get_panchayat($id) {
        $query = $this->db->get_where('panchayat', array('id' => $id));
        return $query->row_array();
    }

    // Insert a new panchayat
    public function create_panchayat($data) {
        return $this->db->insert('panchayat', $data);
    }

    // Update a panchayat
    public function update_panchayat($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('panchayat', $data);
    }

    // Delete a panchayat
    public function delete_panchayat($id) {
        return $this->db->delete('panchayat', array('id' => $id));
    }
}
?>
