<?php
class Post_model extends CI_Model {

    // Fetch post by ID
    public function get_posts_by_user($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('posts');
    
        // Check if query returns results
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Return as an array
        } else {
            return []; // Return empty array if no posts found
        }
    }
    


    public function get_post($post_id) {
        $query = $this->db->get_where('posts', array('id' => $post_id));
        return $query->row_array();
    }

    // Create a new post
    public function create_post($blog_id) {
        $data = array(
            'blog_id' => $blog_id,
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'status' => 'draft', // Default status for a new post
            'created_at' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('posts', $data);
    }

    // Update an existing post
    public function update_post($post_id) {
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $post_id);
        return $this->db->update('posts', $data);
    }

    // Delete a post
    public function delete_post($post_id) {
        return $this->db->delete('posts', array('id' => $post_id));
    }

    // Update post status (publish/archive)
    public function update_status($post_id, $status) {
        $this->db->where('id', $post_id);
        return $this->db->update('posts', array('status' => $status));
    }

}
