<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<section class="auth-shell">
    <div class="auth-shell-bg">
        <div class="auth-blob auth-blob-1"></div>
        <div class="auth-blob auth-blob-2"></div>
        <div class="auth-grid-lines"></div>
    </div>

    <div class="container auth-shell-container">
        <div class="auth-showcase reveal active">
            <span class="section-label">Smart Study System</span>
            <h1>Build discipline.<br>Track progress.<br>Study with clarity.</h1>
            <p>
                StudyFlow AI helps you manage subjects, deadlines, focus sessions,
                and progress in one clean workspace.
            </p>

            <div class="auth-feature-list">
                <div class="auth-feature-item">
                    <span>⚡</span>
                    <div>
                        <h4>Fast access</h4>
                        <p>Log in and continue from your dashboard instantly.</p>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <span>🧠</span>
                    <div>
                        <h4>Smart planning</h4>
                        <p>See what matters today and stay ahead of deadlines.</p>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <span>📈</span>
                    <div>
                        <h4>Visible progress</h4>
                        <p>Track your momentum with focus and task analytics.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="auth-panel reveal active">
            <div class="auth-card-modern">
                <div class="auth-card-top">
                    <span class="section-label">Welcome Back</span>
                    <h2>Login to StudyFlow AI</h2>
                    <p>Continue your study journey with your personal workspace.</p>
                </div>

                <?php flash('register_success'); ?>

                <form action="<?php echo URLROOT; ?>/users/login" method="POST" class="auth-form-modern">
                    <div class="form-group modern-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrap">
                            <span class="input-icon">✉</span>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>"
                                placeholder="Enter your email"
                            >
                        </div>
                        <small class="form-error"><?php echo $data['email_err'] ?? ''; ?></small>
                    </div>

                    <div class="form-group modern-group">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Enter your password"
                            >
                        </div>
                        <small class="form-error"><?php echo $data['password_err'] ?? ''; ?></small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg auth-submit-btn">Login</button>

                    <p class="auth-switch-modern">
                        Don’t have an account?
                        <a href="<?php echo URLROOT; ?>/users/register">Create one now</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>