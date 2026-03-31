<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="auth-section">
    <div class="auth-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <div class="container auth-container">
        <div class="auth-card reveal active">
            <div class="auth-header">
                <span class="section-label">Admin Console</span>
                <h1>Admin Login</h1>
                <p>Sign in to access the StudyFlow AI admin dashboard.</p>
            </div>

            <?php flash('admin_auth_error'); ?>

            <form action="<?php echo URLROOT; ?>/admin/login" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Admin Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>" placeholder="Enter admin email">
                    <small class="form-error"><?php echo $data['email_err']; ?></small>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>" placeholder="Enter password">
                    <small class="form-error"><?php echo $data['password_err']; ?></small>
                </div>

                <button type="submit" class="btn btn-primary btn-lg auth-btn">Login as Admin</button>

                <p class="auth-switch">
                    Return to
                    <a href="<?php echo URLROOT; ?>/">main website</a>
                </p>
            </form>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>