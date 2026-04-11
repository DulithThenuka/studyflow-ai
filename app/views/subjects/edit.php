<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero form-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Subjects</span>
                    <h1>Edit subject</h1>
                    <p>Update your subject details so your study system stays clean and accurate.</p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Back to Subjects</a>
                </div>
            </div>

            <div class="modern-form-shell">
                <div class="modern-form-card">
                    <div class="panel-top">
                        <div>
                            <span class="section-label">Update</span>
                            <h3>Subject details</h3>
                            <p>Edit the fields below and save your changes.</p>
                        </div>
                    </div>

                    <form action="<?php echo URLROOT; ?>/subjects/edit/<?php echo $data['id']; ?>" method="POST" class="modern-form-v2">
                        <div class="form-grid two-col-grid">
                            <div class="form-group modern-field">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" name="subject_name" id="subject_name" value="<?php echo htmlspecialchars($data['subject_name']); ?>" placeholder="e.g. Database Systems">
                                <small class="form-error"><?php echo $data['subject_name_err']; ?></small>
                            </div>

                            <div class="form-group modern-field">
                                <label for="subject_code">Subject Code</label>
                                <input type="text" name="subject_code" id="subject_code" value="<?php echo htmlspecialchars($data['subject_code']); ?>" placeholder="e.g. SE2040">
                            </div>
                        </div>

                        <div class="form-group modern-field">
                            <label for="color">Subject Color</label>
                            <div class="color-input-wrap modern-color-wrap">
                                <input type="color" name="color" id="color" value="<?php echo htmlspecialchars($data['color']); ?>" class="color-picker">
                                <input type="text" value="<?php echo htmlspecialchars($data['color']); ?>" id="colorText" class="color-text" readonly>
                            </div>
                        </div>

                        <div class="form-group modern-field">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="5" placeholder="Add a short description about this subject"><?php echo htmlspecialchars($data['description']); ?></textarea>
                        </div>

                        <div class="form-actions modern-form-actions">
                            <button type="submit" class="btn btn-primary">Update Subject</button>
                            <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Cancel</a>
                        </div>
                    </form>
                </div>

                <div class="modern-side-info-card">
                    <span class="section-label">Tips</span>
                    <h3>Keep it easy to scan</h3>
                    <ul class="side-tip-list">
                        <li>Use short, recognizable names for faster navigation.</li>
                        <li>Keep the color consistent with how you mentally group modules.</li>
                        <li>Update the description if the scope of the subject changes.</li>
                        <li>Clean subject data makes tasks and planning easier to follow.</li>
                    </ul>
                </div>
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