<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/register.css') ?>">
<main class="container">
    <h1>Member Registration</h1>
    <p>Interested and motivated to work out more and build up your fitness level? Join the UniFit family now! Simply fill up the registration form to become a Unifit member today! It is that simple and easy!</p>

    <form action="process_register.php" method="post">
        <div class="row">
            <div class="col-lg-6 col-md-12">
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
            </div>
            
            <div class="col-lg-6 col-md-12">
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
                </div>
                <div class="mb-3">
                    <label for="pwd_confirm" class="form-label">Confirm Password:</label>
                    <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control" placeholder="Confirm password">
                </div>
                <div class="mb-3">
                    <label for="gender" class= "label_selection">Gender:</label>
                    <select name="gender" id="gender" class="selection">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dob" class= "label_selection">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" class="selection" required>
                </div>
                <div class="mb-3">
                    <label for="weight" class= "label_selection">Height (m):</label>
                    <input type="number" id="weight" name="weight" class="selection" placeholder="e.g. 1.83" step="0.01" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="weight" class= "label_selection">Weight (kg):</label>
                    <input type="number" id="weight" name="weight" class="selection" placeholder="e.g. 63.0" step="0.1" min="0" required>
                </div>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input required type="checkbox" name="agree" id="agree" class="form-check-input">
            <label class="form-check-label" for="agree">
                By signing up, I agree to terms and conditions and privacy policy set forth by UniFit.
            </label>
        </div>
        <div class="mb-3 submit_button">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>
<?= $this->endSection() ?>