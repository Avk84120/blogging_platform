# Multi-User Blogging Platform

## Introduction
This project is a multi-user blogging platform developed using **CodeIgniter 3**. The platform allows users to create blogs, write posts, comment, and interact.

## Features
- User Registration/Login
- Blog Creation, Editing, and Deletion
- Role-Based Access Control (Admin, Editor, User)
- Post Management with Draft, Published, and Archived statuses
- Commenting on posts (with moderation by post authors/admin)

## Requirements
- PHP 7.2 or higher
- MySQL 5.6 or higher
- Composer (optional)
- XAMPP, WAMP, or similar local server environment

## Installation
1. Download and Install CodeIgniter 3: Download CodeIgniter 3 from the official website, and extract it   into your web directory.

2. Setup the MySQL database: Create a database called multi_user_blog

    ```sql
    CREATE DATABASE multi_user_blog;
    ``` 
    And
    CREATE TABLE users,blogs,posts,comments;
    **
    CREATE TABLE `users` (
    `id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` ENUM('admin', 'editor', 'user') DEFAULT 'user',
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `blogs` (
    `id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `title` varchar(255) NOT NULL,
    `description` text,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `posts` (
    `id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `blog_id` int(11) NOT NULL,
    `title` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `status` ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`blog_id`) REFERENCES `blogs`(`id`)
);

CREATE TABLE `comments` (
    `id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `post_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `comment` text NOT NULL,
    `approved` BOOLEAN DEFAULT FALSE,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
 **


3. Configure the MySQL credentials application by editing the `application/config/database.php` file.
4. Create Models : 1- User Model (User_model.php)
                   2- Blog Model (Blog_model.php)
                   3- Post Model (Post_model.php)
                   4- Comment Model (Comment_model.php)

5. Create Controllers : 1- Authentication Controller (Auth.php)
                        2- Blog Controller (Blogs.php)
                        3- Post Controller (Posts.php)
                        4- Comment Controller (Comments.php)

6. Create Views:-
   Create views for registration, login, blog management, post management, and comment moderation.

7. Define Routes:-
   Update the config/routes.php to map your URLs to the appropriate controllers

8. Role-Based Access Control:-
   Implement role checks in the controllers, ensuring that certain actions are only available to users with appropriate roles

9. Run the application by starting your local server and visiting `http://localhost/blogging_platform`.

## Usage

- **Admin**: Manage all blogs, posts, and users.
- **User**: Create posts and comment on blogs.

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------