<?php
class Booth_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get all booths
  public function get_booths() {
    $this->db->select('booth.*, block.name as block_name'); // Select columns from both tables
    $this->db->from('booth');
    $this->db->join('block', 'block.id = booth.blockid', 'left'); // Join block table on blockid
    $query = $this->db->get();
    return $query->result_array();
}


   public function getvillageBypanchayat($blockId) {
   $this->db->where('panchayatid', $blockId);
    $query = $this->db->get('village');
    return $query->result_array();
}


  public function getpanchayatidByBooth($blockId) {
   $this->db->where('boothid', $blockId);
    $query = $this->db->get('panchayat');
    return $query->result_array();
}



public function getBoothsByBlock($blockId, $year = null) {
    if ($blockId) {
        $this->db->where('blockid', $blockId);
    }
    if ($year) {
        $this->db->where('year', $year);
    }
    $query = $this->db->get('booth');
    return $query->result_array();
}


    // Get a single booth by ID
    public function get_booth($id) {
        $query = $this->db->get_where('booth', array('id' => $id));
        return $query->row_array();
    }

    // Insert a new booth
    public function create_booth($data) {
        return $this->db->insert('booth', $data);
    }

    // Update a booth
    public function update_booth($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('booth', $data);
    }

    // Delete a booth
    public function delete_booth($id) {
        return $this->db->delete('booth', array('id' => $id));
    }
}
?>
