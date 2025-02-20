<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Blogs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .blogs-container {
            max-width: 800px;
            margin: 50px auto;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .blog-card {
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .blog-card h3 {
            margin-bottom: 10px;
        }
        .btn-actions {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="blogs-container">
        <h2>Your Blogs</h2>

        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="card blog-card">
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="card-text"><?= htmlspecialchars($blog['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="btn-actions">
                            <a href="<?= site_url('blogs/edit/' . $blog['id']); ?>" class="btn btn-secondary me-2">Edit</a>
                            <a href="<?= site_url('blogs/delete/' . $blog['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You have no blogs. <a href="<?= site_url('blogs/create'); ?>" class="btn btn-primary">Create a new blog</a></p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
