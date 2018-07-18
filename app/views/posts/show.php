<?php require APPROOT.'/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/posts" class="btn btn-link">
    <i class="glyphicon glyphicon-backward">
        Back
    </i>
</a>

<br>
<h1><?= $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Publie par <?= $data['user']->name; ?>,le <?= datetimeformatter($data['post']->created_at) ?>
</div>
<p>
    <?= $data['post']->body; ?>
</p>
<?php if($data['post']->user_id==$_SESSION['user_id']): ?>
    <hr>
    <a class="btn btn-primary" href="<?= URLROOT; ?>/posts/edit/<?= $data['post']->id;?>">
        Edit
    </a>
    <form class="pull-right" method="post" action="<?= URLROOT; ?>/posts/delete/<?= $data['post']->id; ?>">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif; ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>
