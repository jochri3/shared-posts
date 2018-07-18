<?php require APPROOT.'/views/inc/header.php'; ?>
<div class="row jumbotron jumbotron-fluid text-center">
    <div class="col-md-6">
        <div class="card card-body bg-light mt-5">
        <?= flash('register_success'); ?>
            <h2>Login</h2>
            <form action="<?= URLROOT ?>/users/login" method="post">
                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <div class="<?php echo (!empty($data['email_error']))?'has-error':''?>">
                    <input type="text" name="email" class="form-control form-control-lg" value="<?= $data['email'] ?>">
                    </div>
                    <span class="text-danger"><?= $data['email_error'] ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <div class="<?php echo (!empty($data['password_error']))?'has-error':''?>">
                    <input type="password" name="password" class="form-control form-control-lg" value="<?= $data['password'] ?>">
                    </div>
                    <span class="text-danger"><?= $data['password_error'] ?></span>
                </div>
                <div>
                    <div class="submit">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="link">
                        <a href="<?= URLROOT ?>/users/register" class="btn btn-default bn-block">Don't have an account?Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
