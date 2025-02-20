<h2>Posts in <?= $blog->title; ?></h2>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <h3><?= $post->title; ?> (<?= ucfirst($post->status); ?>)</h3>
        <p><?= substr($post->content, 0, 100); ?>...</p>
        <a href="<?= base_url('posts/edit/' . $post->id); ?>" class="btn btn-warning">Edit Post</a>
        <a href="<?= base_url('posts/delete/' . $post->id); ?>" class="btn btn-danger">Delete Post</a>
        <?php if($post->status == 'draft'): ?>
            <a href="<?= base_url('posts/publish/' . $post->id); ?>" class="btn btn-success">Publish Post</a>
        <?php endif; ?>
        <?php if($post->status == 'published'): ?>
            <a href="<?= base_url('posts/archive/' . $post->id); ?>" class="btn btn-secondary">Archive Post</a>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>
