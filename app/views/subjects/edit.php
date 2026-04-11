<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Subjects</span>
                    <h1>Edit Subject</h1>
                    <p>Update your subject details and keep everything organized.</p>
                </div>

                <div class="topbar-actions">
                    <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Back to Subjects</a>
                </div>
            </div>

            <div class="form-panel">
                <form action="<?php echo URLROOT; ?>/subjects/edit/<?php echo $data['id']; ?>" method="POST" class="modern-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="subject_name">Subject Name</label>
                            <input type="text" name="subject_name" id="subject_name" value="<?php echo $data['subject_name']; ?>" placeholder="e.g. Database Systems">
                            <small class="form-error"><?php echo $data['subject_name_err']; ?></small>
                        </div>

                        <div class="form-group">
                            <label for="subject_code">Subject Code</label>
                            <input type="text" name="subject_code" id="subject_code" value="<?php echo $data['subject_code']; ?>" placeholder="e.g. SE2040">
                        </div>
                    </div>

                    <div class="form-group color-group">
                        <label for="color">Subject Color</label>
                        <div class="color-input-wrap">
                            <input type="color" name="color" id="color" value="<?php echo $data['color']; ?>" class="color-picker">
                            <input type="text" value="<?php echo $data['color']; ?>" id="colorText" class="color-text" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="5" placeholder="Add a short description about this subject"><?php echo $data['description']; ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Subject</button>
                        <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const colorInput = document.getElementById('color');
    const colorText = document.getElementById('colorText');

    if (colorInput && colorText) {
        colorInput.addEventListener('input', function () {
            colorText.value = colorInput.value;
        });
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>