<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the necessary models, libraries, and helpers
        $this->load->model('Blog_model');  // Load Blog model
        $this->load->library('form_validation');  // Form validation library
        $this->load->library('session');  // Session library
        $this->load->helper('url');  // URL helper
        $this->load->helper('form');  // Form helper

        // Ensure user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    // Create a new blog
    public function create() {
        // Set form validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, load the form again
            $data['title'] = 'Create New Blog';
            $this->load->view('layouts/main', [
                'content' => $this->load->view('blogs/create', $data, TRUE)
            ]);
        } else {
            // Validation passed, prepare blog data for insertion
            $blog_data = [
                'user_id' => $this->session->userdata('user_id'),  // Get logged-in user's ID
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Insert blog into the database
            if ($this->Blog_model->create_blog($blog_data)) {
                // Set success message
                $this->session->set_flashdata('message', 'Blog created successfully');
                redirect('blogs/manage');
            } else {
                // Set error message
                $this->session->set_flashdata('message', 'Failed to create blog. Please try again.');
                redirect('blogs/create');
            }
        }
    }

    // Manage blogs (list blogs for the logged-in user)
    public function manage() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Manage Your Blogs';
        $data['blogs'] = $this->Blog_model->get_user_blogs($user_id);  // Fetch blogs for the logged-in user

        // Load the view with blog list
        $this->load->view('layouts/main', [
            'content' => $this->load->view('blogs/manage', $data, TRUE)
        ]);
    }

    // Edit blog
    public function edit($id) {
        $data['title'] = 'Edit Blog';
        $data['blog'] = $this->Blog_model->get_blog($id);

        if ($this->session->userdata('user_id') != $data['blog']['user_id']) {
            redirect('blogs/manage');  // Redirect if user tries to edit a blog they don't own
        }

        // Set form validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Load the edit form with blog data
            $this->load->view('layouts/main', [
                'content' => $this->load->view('blogs/edit', $data, TRUE)
            ]);
        } else {
            // Update blog data
            $updated_data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Blog_model->update_blog($id, $updated_data)) {
                // Success message
                $this->session->set_flashdata('message', 'Blog updated successfully');
                redirect('blogs/manage');
            } else {
                // Error message
                $this->session->set_flashdata('message', 'Failed to update blog. Please try again.');
                redirect('blogs/edit/' . $id);
            }
        }
    }

    // Delete a blog
    public function delete($id) {
        $blog = $this->Blog_model->get_blog($id);

        // Ensure user owns the blog before deletion
        if ($this->session->userdata('user_id') != $blog['user_id']) {
            redirect('blogs/manage');
        }

        if ($this->Blog_model->delete_blog($id)) {
            // Success message
            $this->session->set_flashdata('message', 'Blog deleted successfully');
        } else {
            // Error message
            $this->session->set_flashdata('message', 'Failed to delete blog. Please try again.');
        }

        redirect('blogs/manage');
    }
}
