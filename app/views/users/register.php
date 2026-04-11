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
            <span class="section-label">Start Strong</span>
            <h1>Create your study system and stay consistent every day.</h1>
            <p>
                Join StudyFlow AI and organize subjects, deadlines, tasks,
                focus sessions, and progress in one beautiful workspace.
            </p>

            <div class="auth-metric-grid">
                <div class="auth-metric-card">
                    <strong>Subjects</strong>
                    <span>Track all your modules cleanly</span>
                </div>
                <div class="auth-metric-card">
                    <strong>Tasks</strong>
                    <span>Stay ready for deadlines and revisions</span>
                </div>
                <div class="auth-metric-card">
                    <strong>Focus</strong>
                    <span>Build deep work habits daily</span>
                </div>
                <div class="auth-metric-card">
                    <strong>Progress</strong>
                    <span>See what is improving over time</span>
                </div>
            </div>
        </div>

        <div class="auth-panel reveal active">
            <div class="auth-card-modern">
                <div class="auth-card-top">
                    <span class="section-label">Create Account</span>
                    <h2>Join StudyFlow AI</h2>
                    <p>Build your personal study workspace in a few seconds.</p>
                </div>

                <form action="<?php echo URLROOT; ?>/users/register" method="POST" class="auth-form-modern">
                    <div class="form-group modern-group">
                        <label for="name">Full Name</label>
                        <div class="input-wrap">
                            <span class="input-icon">👤</span>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>"
                                placeholder="Enter your full name"
                            >
                        </div>
                        <small class="form-error"><?php echo $data['name_err'] ?? ''; ?></small>
                    </div>

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

                    <div class="form-row-auth">
                        <div class="form-group modern-group">
                            <label for="password">Password</label>
                            <div class="input-wrap">
                                <span class="input-icon">🔒</span>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="At least 6 characters"
                                >
                            </div>
                            <small class="form-error"><?php echo $data['password_err'] ?? ''; ?></small>
                        </div>

                        <div class="form-group modern-group">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-wrap">
                                <span class="input-icon">✅</span>
                                <input
                                    type="password"
                                    name="confirm_password"
                                    id="confirm_password"
                                    placeholder="Repeat your password"
                                >
                            </div>
                            <small class="form-error"><?php echo $data['confirm_password_err'] ?? ''; ?></small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg auth-submit-btn">Create Account</button>

                    <p class="auth-switch-modern">
                        Already have an account?
                        <a href="<?php echo URLROOT; ?>/users/login">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>