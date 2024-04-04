<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/authentication.css') ?>">

<main class="container authentication">
    <h1>Reset Password</h1>
    <div class="pwd_criteria">
        <p>New password set must be:</p>
        <ul>
            <li>At least 8 Characters Long</li>
            
        </ul>
    </div>
    <form action="<?= site_url('/reset/resetPasswordProcess/' . $token) ?>" method="post">

        <div class="mb-3 form-group">
            <label for="pwd" class="form-label">Password:</label>
            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
        </div>
        <div class="mb-3 form-group">
            <label for="pwd_confirm" class="form-label">Confirm Password:</label>
            <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control" placeholder="Enter password">
        </div>
        <div class="mb-3">
            <button type="submit">Submit</button>
        </div>
    </form>
</main>
<?= $this->endSection() ?>