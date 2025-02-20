<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!--<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>"> -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <!--<li><a href="<?= base_url(); ?>">Home</a></li>-->
                <?php if($this->session->userdata('logged_in')): ?>
                    <li><a href="<?= base_url('comments/manage'); ?>">Add Comment </a></li>
                    <li><a href="<?= base_url('posts/create'); ?>">Post Manage</a></li>
                    <li><a href="<?= base_url('auth/logout'); ?>">Logout</a></li>

                <?php else: ?>
                    <li><a href="<?= base_url('auth/login'); ?>">Login</a></li>
                    <li><a href="<?= base_url('auth/register'); ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="container">
        <?php if ($this->session->flashdata('message')): ?>
            <p class="alert"><?= $this->session->flashdata('message'); ?></p>
        <?php endif; ?>
        <?= $content; ?>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Multi-User Blogging Platform</p>
    </footer>
</body>
</html>
