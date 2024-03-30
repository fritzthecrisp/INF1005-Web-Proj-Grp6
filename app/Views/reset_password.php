<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/authentication.css') ?>">

<main class="container authentication">
    <h1>Reset Password</h1>
    <div class="pwd_criteria">
        <p>New password set must be:</p>
        <ul>
            <li>At least 12 Characters Long</li>
            <li>A combination of uppercase and lowercase letters (Aa-Zz), numbers (0-9) and special characters (!@#$%^&*)</li>
            <li> Must not be your last 3 passwords used for this account.
        </ul>
    </div>
    <form action="process_login.php" method="post">

        <div class="mb-3 form-group">
            <label for="email" class="form-label">Email:</label>
            <input required type="email" id="email" name="email" class="form-control" placeholder="Enter email">
        </div>
        <div class="mb-3 form-group">
            <label for="pwd" class="form-label">Password:</label>
            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
        </div>
        <div class="mb-3 form-group">
            <label for="pwd" class="form-label">Confirm Password:</label>
            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
        </div>
        <div class="mb-3">
            <button type="submit">Submit</button>
        </div>
    </form>
</main>
<?= $this->endSection() ?>