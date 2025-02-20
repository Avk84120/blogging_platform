<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Post</h2>

        <?php if (isset($post) && !empty($post)): ?>
            <?php echo form_open('posts/edit/' . $post['id']); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    <?= form_error('title', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <?= form_error('content', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            <?php echo form_close(); ?>
        <?php else: ?>
            <div class="alert alert-danger">Post not found.</div>
        <?php endif; ?>
    </div>
</body>
</html>

