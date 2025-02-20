
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');  // Load User model
        $this->load->library('form_validation');  // Load form validation library
        $this->load->library('session');  // Load session library
        $this->load->helper('url');  // Load URL helper
    }

    // Registration Function
    public function register() {
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, load the registration form again with errors
            $data['title'] = 'Register';
            $this->load->view('layouts/main', [
                'content' => $this->load->view('auth/register', $data, TRUE)
            ]);
        } else {
            // Validation passed, register user
            $enc_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $user_data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $enc_password,
                'role' => 'user'  // Default role is user
            ];

            if ($this->User_model->register($user_data)) {
                // Set success message
                $this->session->set_flashdata('message', 'Registration successful, you can now log in');
                redirect('auth/login');
            } else {
                // Registration failed, show an error message
                $this->session->set_flashdata('message', 'Registration failed, please try again');
                redirect('auth/register');
            }
        }
    }

    // Login Function
    /*public function login() {
        // Set validation rules for login
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed, load the login form again with errors
            $data['title'] = 'Login';
            $this->load->view('layouts/main', [
                'content' => $this->load->view('auth/login', $data, TRUE)
            ]);
        } else {
            // Get email and password from input
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Check for user credentials
            $user = $this->User_model->login($email,$password);

            if ($user && password_verify($password, $user['password'])) {
                // Create session
                $user_data = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($user_data);

                // Redirect to homepage
                redirect('blogs/create');
            } else {
                // Set login failed message
                $this->session->set_flashdata('message', 'Invalid login credentials');
                redirect('auth/login');
            }
        }
    }*/

    public function login() {
        // Set validation rules for login
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            // Validation failed, load the login form again with errors
            $data['title'] = 'Login';
            $this->load->view('layouts/main', [
                'content' => $this->load->view('auth/login', $data, TRUE)
            ]);
        } else {
            // Get email and password from input
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            // Check for user credentials
            $user = $this->User_model->login($email, $password);
    
            if ($user && password_verify($password, $user->password)) {
                // Create session
                $user_data = [
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($user_data);
    
                // Redirect to homepage
                redirect('blogs/create');
            } else {
                // Set login failed message
                $this->session->set_flashdata('message', 'Invalid login credentials');
                redirect('auth/login');
            }
        }
    }
    

    // Logout Function
    public function logout() {
        // Unset session data and log out the user
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('logged_in');

        // Set logout message
        $this->session->set_flashdata('message', 'You have logged out successfully');
        redirect('auth/login');
    }
}