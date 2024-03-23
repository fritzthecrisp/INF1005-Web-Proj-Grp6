<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<main class="container">
    <h1>Member Registration</h1>
    <p>
        For existing members, please go to the
        <a href="<?= site_url("login") ?>">Sign In page</a>.
    </p>
    <form action="process_register.php" method="post">
        <div class="mb-3">
            <label for="uname" class="form-label">Username:</label>
            <input type="text" id="uname" name="uname" class="form-control" placeholder="Enter username">
        </div>
        <div class="mb-3">
            <label for="fname" class="form-label">First Name:</label>
            <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter first name">
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name:</label>
            <input required maxlength="45" type="text" id="lname" name="lname" class="form-control" placeholder="Enter last name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input required type="email" id="email" name="email" class="form-control" placeholder="Enter email">
        </div>
        <div class="mb-3">
            <label for="gender">Choose your gender:</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
        <div class="mb-3">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" placeholder="Kilograms" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
        </div>
        <div class="mb-3">
            <label for="pwd_confirm" class="form-label">Confirm Password:</label>
            <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control" placeholder="Confirm password">
        </div>
        <div class="mb-3 form-check">
            <input required type="checkbox" name="agree" id="agree" class="form-check-input">
            <label class="form-check-label" for="agree">
                Agree to terms and conditions.
            </label>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>
<?= $this->endSection() ?>
