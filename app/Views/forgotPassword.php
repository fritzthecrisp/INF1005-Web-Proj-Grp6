<!-- Users who have forgotten their passwword will be redirected to this page -->

<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/authentication.css') ?>">

<main class="container authentication">
    <h1>Reset Password</h1>
    <div class="pwd_criteria">
    </div>
    <form action="/AuthController/forgotPassword" method="post">

        <div class="mb-3 form-group">
            <label for="email" class="form-label">Email:</label>
            <input required type="email" id="email" name="email" class="form-control" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <button type="submit">Submit</button>
        </div>
    </form>
</main>
<?= $this->endSection() ?>