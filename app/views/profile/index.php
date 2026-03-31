<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$user = isset($data['user']) ? $data['user'] : null;
$imageName = (!empty($user->profile_image)) ? $user->profile_image : 'avatar-default.png';
$imagePath = URLROOT . '/uploads/profiles/' . $imageName;
?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Profile</span>
                    <h1>Your Profile</h1>
                    <p>Manage your account details, academic info, image, and password.</p>
                </div>
            </div>

            <?php flash('profile_msg'); ?>

            <div class="profile-grid">
                <div class="profile-card">
                    <div class="profile-avatar-wrap">
                        <img src="<?php echo $imagePath; ?>" alt="Profile Image" class="profile-avatar">
                    </div>
                    <h3><?php echo htmlspecialchars($user->name ?? 'User'); ?></h3>
                    <p><?php echo htmlspecialchars($user->email ?? ''); ?></p>

                    <div class="profile-meta-box">
                        <div>
                            <strong>University</strong>
                            <span><?php echo !empty($user->university) ? htmlspecialchars($user->university) : 'Not added'; ?></span>
                        </div>
                        <div>
                            <strong>Course</strong>
                            <span><?php echo !empty($user->course) ? htmlspecialchars($user->course) : 'Not added'; ?></span>
                        </div>
                    </div>
                </div>

                <div class="form-panel">
                    <form action="<?php echo URLROOT; ?>/profile/update" method="POST" enctype="multipart/form-data" class="modern-form">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user->name ?? ''); ?>">
                                <small class="form-error"><?php echo $data['name_err'] ?? ''; ?></small>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user->email ?? ''); ?>">
                                <small class="form-error"><?php echo $data['email_err'] ?? ''; ?></small>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="university">University</label>
                                <input type="text" name="university" id="university" value="<?php echo htmlspecialchars($user->university ?? ''); ?>" placeholder="Enter your university">
                            </div>

                            <div class="form-group">
                                <label for="course">Course</label>
                                <input type="text" name="course" id="course" value="<?php echo htmlspecialchars($user->course ?? ''); ?>" placeholder="Enter your course">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image" accept=".jpg,.jpeg,.png,.webp">
                            <small class="form-error"><?php echo $data['image_err'] ?? ''; ?></small>
                        </div>

                        <div class="profile-divider"></div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" placeholder="Leave blank to keep current password">
                                <small class="form-error"><?php echo $data['password_err'] ?? ''; ?></small>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat new password">
                                <small class="form-error"><?php echo $data['confirm_password_err'] ?? ''; ?></small>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>