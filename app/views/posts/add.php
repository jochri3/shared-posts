<?php require APPROOT.'/views/inc/header.php'; ?>
<a href="<?= URLROOT; ?>/posts" class="btn btn-link">
    <i class="glyphicon glyphicon-backward">
        Back
    </i>
</a>
<div class="row jumbotron jumbotron-fluid text-center">
    <div class="col-md-6">
        <div class="card card-body bg-light mt-5">
            <h2>Add post</h2>
            <form action="<?= URLROOT; ?>/posts/add" method="post">
                <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <div class="<?php echo (!empty($data['title_error']))?'has-error':''?>">
                        <input type="text" name="title" class="form-control form-control-lg" value="<?= $data['title']; ?>">
                    </div>
                    <span class="text-danger"><?= $data['title_error'] ?></span>
                </div>
                <div class="form-group">
                    <label for="body">Body: <sup>*</sup></label>
                    <div class="<?php echo (!empty($data['body_error']))?'has-error':''?>">
                        <textarea name="body" class="form-control form-control-lg"><?= $data['body']; ?></textarea>
                    </div>
                    <span class="text-danger"><?= $data['body_error']; ?></span>
                </div>
                <div>
                    <div class="submit">
                        <input type="submit" value="Submit" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
