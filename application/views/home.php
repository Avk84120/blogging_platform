<h1>Welcome to the Multi-User Blogging Platform</h1>

<?php if (!empty($blogs)): ?>
    <?php foreach ($blogs as $blog): ?>
        <h2><?= $blog->title; ?></h2>
        <p><?= $blog->description; ?></p>
        <a href="<?= base_url('blogs/view/' . $blog->id); ?>">View Blog</a>
    <?php endforeach; ?>
<?php else: ?>
    <p>No blogs found.</p>
<?php endif; ?>
