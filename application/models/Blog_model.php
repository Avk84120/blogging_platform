<?php
class Blog_model extends CI_Model {

    public function __construct() {
        $this->load->database();  // Load the database
    }

    // Create a new blog
    public function create_blog($data) {
        return $this->db->insert('blogs', $data);
    }

    // Get all blogs for the logged-in user
    public function get_user_blogs($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('blogs');
        return $query->result_array();
    }

    // Get a specific blog by ID
    public function get_blog($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('blogs');
        return $query->row_array();
    }

    // Update a specific blog
    public function update_blog($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('blogs', $data);
    }

    // Delete a blog
    public function delete_blog($id) {
        $this->db->where('id', $id);
        return $this->db->delete('blogs');
    }
}
