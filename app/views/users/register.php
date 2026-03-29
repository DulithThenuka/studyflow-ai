<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<section class="auth-section">
    <div class="auth-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <div class="container auth-container">
        <div class="auth-card reveal active">
            <div class="auth-header">
                <span class="section-label">Create Account</span>
                <h1>Join StudyFlow AI</h1>
                <p>Start planning smarter and studying better.</p>
            </div>

            <form action="<?php echo URLROOT; ?>/users/register" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $data['name'] ?? ''; ?>" placeholder="Enter your full name">
                    <small class="form-error"><?php echo $data['name_err'] ?? ''; ?></small>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?php echo $data['email'] ?? ''; ?>" placeholder="Enter your email">
                    <small class="form-error"><?php echo $data['email_err'] ?? ''; ?></small>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $data['password'] ?? ''; ?>" placeholder="Enter password">
                    <small class="form-error"><?php echo $data['password_err'] ?? ''; ?></small>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $data['confirm_password'] ?? ''; ?>" placeholder="Confirm password">
                    <small class="form-error"><?php echo $data['confirm_password_err'] ?? ''; ?></small>
                </div>

                <button type="submit" class="btn btn-primary btn-lg auth-btn">Create Account</button>

                <p class="auth-switch">
                    Already have an account?
                    <a href="<?php echo URLROOT; ?>/users/login">Login</a>
                </p>
            </form>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>