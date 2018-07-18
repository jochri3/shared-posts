<?php require APPROOT.'/views/inc/header.php'; ?>
<?= flash('post-message'); ?>
<div class="row">
    <div class="col-md6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?= URLROOT;  ?>/posts/add" class="btn btn-primary pull-right">
            <i class="glyphicon glyphicon-pencil">Add Post</i>
        </a>
    </div>
</div>
<?php foreach ($data['posts'] as $post){ ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?= $post->title;  ?></h4>
        <div class="bg-light p-2 mb-3">
            Publie par <?= $post->name; ?> le <?= datetimeformatter($post->postCreated); ?>
        </div>
        <p class="card-text">
            <?= $post->body ?>
        </p>
        <a href="<?= URLROOT; ?>/posts/show/<?= $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
    <hr>
<?php } ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>
