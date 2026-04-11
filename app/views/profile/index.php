<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$user = $data['user'] ?? null;
$profileImage = !empty($user->profile_image)
    ? URLROOT . '/uploads/profiles/' . $user->profile_image
    : URLROOT . '/img/avatar-default.png';
?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero profile-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Profile</span>
                    <h1>Your personal study identity</h1>
                    <p>
                        Update your information, profile photo, and password
                        so your workspace stays personal and up to date.
                    </p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-outline">Back to Dashboard</a>
                </div>
            </div>

            <?php flash('profile_msg'); ?>

            <div class="profile-layout-modern">
                <div class="profile-side-card">
                    <div class="profile-avatar-wrap">
                        <img src="<?php echo $profileImage; ?>" alt="Profile Image" class="profile-avatar-modern">
                    </div>

                    <h3><?php echo htmlspecialchars($user->name ?? 'Student'); ?></h3>
                    <p><?php echo htmlspecialchars($user->email ?? ''); ?></p>

                    <div class="profile-mini-info">
                        <div class="profile-mini-info-item">
                            <strong><?php echo !empty($user->university) ? htmlspecialchars($user->university) : 'Not added'; ?></strong>
                            <span>University</span>
                        </div>

                        <div class="profile-mini-info-item">
                            <strong><?php echo !empty($user->course) ? htmlspecialchars($user->course) : 'Not added'; ?></strong>
                            <span>Course</span>
                        </div>
                    </div>
                </div>

                <div class="modern-form-card">
                    <div class="panel-top">
                        <div>
                            <span class="section-label">Update</span>
                            <h3>Profile settings</h3>
                            <p>Edit your account details below and save the changes.</p>
                        </div>
                    </div>

                    <form action="<?php echo URLROOT; ?>/profile/update" method="POST" enctype="multipart/form-data" class="modern-form-v2">
                        <div class="form-grid two-col-grid">
                            <div class="form-group modern-field">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($data['name'] ?? ($user->name ?? '')); ?>" placeholder="Enter your name">
                                <small class="form-error"><?php echo $data['name_err'] ?? ''; ?></small>
                            </div>

                            <div class="form-group modern-field">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['email'] ?? ($user->email ?? '')); ?>" placeholder="Enter your email">
                                <small class="form-error"><?php echo $data['email_err'] ?? ''; ?></small>
                            </div>
                        </div>

                        <div class="form-grid two-col-grid">
                            <div class="form-group modern-field">
                                <label for="university">University</label>
                                <input type="text" name="university" id="university" value="<?php echo htmlspecialchars($data['university'] ?? ($user->university ?? '')); ?>" placeholder="Enter your university">
                            </div>

                            <div class="form-group modern-field">
                                <label for="course">Course</label>
                                <input type="text" name="course" id="course" value="<?php echo htmlspecialchars($data['course'] ?? ($user->course ?? '')); ?>" placeholder="Enter your course">
                            </div>
                        </div>

                        <div class="form-group modern-field">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image" accept=".jpg,.jpeg,.png,.webp">
                            <small class="form-error"><?php echo $data['image_err'] ?? ''; ?></small>
                        </div>

                        <div class="form-grid two-col-grid">
                            <div class="form-group modern-field">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" placeholder="Enter new password">
                                <small class="form-error"><?php echo $data['password_err'] ?? ''; ?></small>
                            </div>

                            <div class="form-group modern-field">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm new password">
                                <small class="form-error"><?php echo $data['confirm_password_err'] ?? ''; ?></small>
                            </div>
                        </div>

                        <div class="form-actions modern-form-actions">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-outline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>