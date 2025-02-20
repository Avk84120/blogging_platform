<?php

class Comments extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load models and libraries
        $this->load->model('Comment_model');
        $this->load->model('Post_model');
        $this->load->library('form_validation');
        
        // Check if user is logged in (optional)
         $this->load->library('session');
    }

    public function create($post_id) {
        // Check if the post exists
        $data['post'] = $this->Post_model->get_post($post_id);
        if (!$data['post']) {
            show_404(); // Show 404 if post not found
        }

        // Set form validation rules
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Load the view with the post and errors
            $this->load->view('comments/create', $data);
        } else {
            // Save the new comment to the database
            $comment_data = [
                'post_id' => $post_id,
                'user_id' => $this->session->userdata('user_id'), // Assuming you store user_id in session
                'content' => $this->input->post('content'),
                'status' => 'pending', // Default status for new comments
            ];

            $this->Comment_model->create_comment($comment_data);
            $this->session->set_flashdata('comment_created', 'Your comment is submitted and will be visible after approval.');
            redirect('posts/view/' . $post_id); // Redirect back to the post
        }
    }

    public function moderate($comment_id) {
        // Check if the comment exists
        $comment = $this->Comment_model->get_comment($comment_id);
        if (!$comment) {
            show_404(); 
        }

        $action = $this->input->post('action'); 
        if ($action === 'approve') {
            $this->Comment_model->update_comment_status($comment_id, 'approved');
            $this->session->set_flashdata('comment_moderated', 'Comment approved successfully.');
        } elseif ($action === 'reject') {
            $this->Comment_model->update_comment_status($comment_id, 'rejected');
            $this->session->set_flashdata('comment_moderated', 'Comment rejected successfully.');
        }

        redirect('posts/view/' . $comment['post_id']);
    }
}

