<?php

class Comment_model extends CI_Model {
    public function create_comment($data) {
        return $this->db->insert('comments', $data);
    }

    public function get_post_comments($post_id) {
        return $this->db->get_where('comments', array('post_id' => $post_id))->result();
    }

    public function moderate_comment($comment_id, $status) {
        $this->db->where('id', $comment_id);
        return $this->db->update('comments', array('status' => $status));
    }
}
