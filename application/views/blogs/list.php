<h2>Your Blogs</h2>

<?php if (!empty($blogs)): ?>
    <?php foreach ($blogs as $blog): ?>
        <h3><?= $blog->title; ?></h3>
        <p><?= $blog->description; ?></p>
        <a href="<?= base_url('posts/create/' . $blog->id); ?>" class="btn btn-primary">Add Post</a>
        <a href="<?= base_url('blogs/edit/' . $blog->id); ?>" class="btn btn-warning">Edit Blog</a>
        <a href="<?= base_url('blogs/delete/' . $blog->id); ?>" class="btn btn-danger">Delete Blog</a>
    <?php endforeach; ?>
<?php else: ?>
    <p>No blogs found.</p>
<?php endif; ?>
