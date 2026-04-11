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
                <span class="section-label">Welcome Back</span>
                <h1>Login to StudyFlow AI</h1>
                <p>Continue your smart study journey.</p>
            </div>

            <?php flash('register_success'); ?>

            <form action="<?php echo URLROOT; ?>/users/login" method="POST" class="auth-form">
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

                <button type="submit" class="btn btn-primary btn-lg auth-btn">Login</button>

                <p class="auth-switch">
                    Don’t have an account?
                    <a href="<?php echo URLROOT; ?>/users/register">Register</a>
                </p>
            </form>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>