<?php
class Posts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load required models, libraries, and helpers
        $this->load->model('Post_model'); // Post model for interacting with the database
        $this->load->model('Blog_model'); // Blog model for blog information
        $this->load->helper(array('form', 'url')); // Form and URL helpers
        $this->load->library('session');  // Load the session library
        $this->load->library('form_validation'); // Form validation library
    }

    // Create a new post
    public function create($blog_id) {
        // Check if the blog exists
        $data['blog'] = $this->Blog_model->get_blog($blog_id);
        if (!$data['blog']) {
            show_404();
        }
    
        // Set form validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            // Reload the view with errors
            $this->load->view('posts/create', $data);
        } else {
            // Save the new post to the database
            $this->Post_model->create_post($blog_id);
            $this->session->set_flashdata('post_created', 'Your post has been created successfully.');
            redirect('posts/manage/' . $blog_id);
        }
    }
    

    public function manage() {
        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id'); // Get the logged-in user's ID
        $data['posts'] = $this->Post_model->get_posts_by_user($user_id); // Fetch posts for the user

        if (!is_array($data['posts'])) {
            $data['posts'] = []; // Ensure $posts is always an array
        }

        $this->load->view('posts/edit', $data);
    }


    /*public function create($blog = NULL) {
        // Check if the blog ID was provided and if the blog exists
        if ($blog === NULL || !$this->Blog_model->get_blog($blog)) {
            show_404();  // Show 404 if no blog ID is provided or if the blog does not exist
        }

        // Load the blog details
        $data['blog'] = $this->Blog_model->get_blog($blog);

        // Set form validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        // Run validation
        if ($this->form_validation->run() === FALSE) {
            // If validation fails, reload the view with error messages
            $this->load->view('posts/create', $data);
        } else {
            // If validation passes, save the new post to the database
            $this->Post_model->create_post($blog);
            // Set a flash message to indicate success
            $this->session->set_flashdata('post_created', 'Your post has been created successfully.');
            // Redirect to the blog view page
            redirect('blogs/view/' . $blog);
        }
    }*/



    // Edit an existing post
    public function edit($post_id) {
        // Fetch the post by ID
        $data['post'] = $this->Post_model->get_post($post_id);
        
        // Check if the post exists
        if (!$data['post']) {
            show_404(); // Show 404 if the post does not exist
        }
    
        // Set form validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            // Load the view with post data
            $this->load->view('posts/edit', $data);
        } else {
            // Prepare data for update
            $update_data = [
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            ];
    
            // Update the post
            $this->Post_model->update_post($post_id, $update_data);
            $this->session->set_flashdata('post_updated', 'Your post has been updated successfully.');
            redirect('posts/manage'); // Redirect to manage posts
        }
    }
    

    // Delete a post
    public function delete($post_id) {
        $post = $this->Post_model->get_post($post_id);
        if (!$post) {
            show_404();
        }

        $this->Post_model->delete_post($post_id);
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted.');
        redirect('blogs/view/' . $post['blog_id']);
    }

    // Publish a post
    public function publish($post_id) {
        $post = $this->Post_model->get_post($post_id);
        if (!$post) {
            show_404();
        }

        $this->Post_model->update_status($post_id, 'published');
        $this->session->set_flashdata('post_published', 'Your post has been published.');
        redirect('posts/view/' . $post_id);
    }

    // Archive a post
    public function archive($post_id) {
        $post = $this->Post_model->get_post($post_id);
        if (!$post) {
            show_404();
        }

        $this->Post_model->update_status($post_id, 'archived');
        $this->session->set_flashdata('post_archived', 'Your post has been archived.');
        redirect('posts/view/' . $post_id);
    }
}

