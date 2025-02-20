<h2>Comments on <?= $post->title; ?></h2>

<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <p><?= $comment->content; ?> (Status: <?= ucfirst($comment->status); ?>)</p>
        <?php if($comment->status == 'pending'): ?>
            <a href="<?= base_url('comments/approve/' . $comment->id); ?>" class="btn btn-success">Approve</a>
            <a href="<?= base_url('comments/reject/' . $comment->id); ?>" class="btn btn-danger">Reject</a>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>No comments found.</p>
<?php endif; ?>
