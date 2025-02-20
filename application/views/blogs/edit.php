<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .register-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Edit Blog</h2>

        <!-- Ensure the form helper is loaded in your controller: $this->load->helper('form'); -->
        <?= form_open('blogs/edit/' . $blog['id']); ?>
        
        <div class="form-group mb-3">
            <label for="title">Blog Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title', $blog['title']); ?>" required>
            <!-- Display form error if title is not valid -->
            <?= form_error('title', '<div class="text-danger">', '</div>'); ?>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required><?= set_value('description', $blog['description']); ?></textarea>
            <!-- Display form error if description is not valid -->
            <?= form_error('description', '<div class="text-danger">', '</div>'); ?>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Blog</button>

        <?= form_close(); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
