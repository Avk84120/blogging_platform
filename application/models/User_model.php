<?php

class User_model extends CI_Model {


public function __construct() {
    $this->load->database();  // Load database
}
// Register a new user in the 'users' table
public function register($data) {
    if ($this->db->insert('users', $data)) {
        return $this->db->insert_id(); // Return the inserted user's ID on success
    }
    return false; // Return false if the insertion failed
}

// Login: verify user credentials based on email and password
public function login($email, $password) {
    $this->db->where('email', $email);
    $query = $this->db->get('users');

    if ($query->num_rows() == 1) {
        $user = $query->row();
        // Verify the password using the hash
        if (password_verify($password, $user->password)) {
            return $user; // Return user object if password matches
        }
    }
    return false; // Return false if no matching user or invalid password
}

// Fetch a user's details by their ID
public function get_user($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('users');
    
    if ($query->num_rows() == 1) {
        return $query->row(); // Return the user object
    }
    return false; // Return false if no user is found
}
}

