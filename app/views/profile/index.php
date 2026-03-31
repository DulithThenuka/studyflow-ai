<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <h1>Your Profile</h1>

            <?php flash('profile_msg'); ?>

            <form action="<?php echo URLROOT; ?>/profile/update" method="POST" class="modern-form">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $data['user']->name; ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $data['user']->email; ?>">
                </div>

                <button class="btn btn-primary">Update Profile</button>
            </form>
        </main>
    </div>
</section>