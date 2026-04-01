<?php
class Events_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Get all events
 public function get_events() {
    $blockid = $this->session->userdata('blockId');

    if ($blockid != 0) {
        // Convert the comma-separated string into an array
        $blockid_array = explode(',', $blockid);

        // Apply the where_in condition before executing the query
        $this->db->where_in('block', $blockid_array);
    }

    // Order by ID descending to show newest first
    $this->db->order_by('id', 'DESC');

    // Now get the results after applying conditions
    $query = $this->db->get('events');

    return $query->result_array();
}


    // Get a single event by ID
    public function get_event($id) {
        $query = $this->db->get_where('events', array('id' => $id));
        return $query->row_array();
    }

    // Insert a new event
    public function create_event($data) {
        $this->db->insert('events', $data);
        return $this->db->insert_id();
    }
    
    // Update Google Calendar event ID
    public function update_google_event_id($eventId, $googleEventId) {
        $this->db->where('id', $eventId);
        return $this->db->update('events', array('google_event_id' => $googleEventId));
    }
    
    // Get Google event ID
    public function get_google_event_id($eventId) {
        $query = $this->db->get_where('events', array('id' => $eventId));
        $result = $query->row_array();
        return $result ? (isset($result['google_event_id']) ? $result['google_event_id'] : null) : null;
    }

    // Update a event
    public function update_event($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('events', $data);
    }

    // Delete a event
    public function delete_event($id) {
        return $this->db->delete('events', array('id' => $id));
    }
}
?>
