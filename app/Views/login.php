<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/authentication.css') ?>">
<main class="container authentication">
<?php if (session()->has('message')): ?>
    <div class="alert alert-success">
        <?= session('message') ?>
    </div>
<?php endif; ?>
    <h1>Login</h1>
    <form action="<?= base_url('AuthController/login') ?>" method="post">
        <div class="mb-3 form-group">
            <label for="email" class="form-label">Email:</label>
            <input required type="email" id="email" name="email" class="form-control" placeholder="Enter email">
        </div>
        <div class="mb-3 form-group">
            <label for="pwd" class="form-label">Password:</label>
            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
        </div>
        <div class="mb-3">
    <?php if(session()->getFlashdata('error')):?>
        <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
            <button type="submit">Submit</button>
        </div>
    </form>
    <p>New to Unifit?
        <a class="register-link" href="<?= site_url("register") ?>"> Sign up as a member now!</a>.</p>
    <p>Forget password?
        <a class="register-link" href="<?= site_url('forgotPassword') ?>">Click here.</a>.</p>

</main>
<script src="<?= base_url('js/main.js') ?>"></script>
<?= $this->endSection() ?>
