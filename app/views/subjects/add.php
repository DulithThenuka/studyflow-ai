<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero form-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Subjects</span>
                    <h1>Add a new subject</h1>
                    <p>Create a subject to group your study tasks and make the workspace easier to manage.</p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Back to Subjects</a>
                </div>
            </div>

            <div class="modern-form-shell">
                <div class="modern-form-card">
                    <div class="panel-top">
                        <div>
                            <span class="section-label">Create</span>
                            <h3>Subject details</h3>
                            <p>Fill in the basic details for your new subject.</p>
                        </div>
                    </div>

                    <form action="<?php echo URLROOT; ?>/subjects/add" method="POST" class="modern-form-v2">
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
                            <button type="submit" class="btn btn-primary">Save Subject</button>
                            <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Cancel</a>
                        </div>
                    </form>
                </div>

                <div class="modern-side-info-card">
                    <span class="section-label">Tips</span>
                    <h3>Build a cleaner structure</h3>
                    <ul class="side-tip-list">
                        <li>Use clear subject names so tasks are easier to group.</li>
                        <li>Add the official code if your university uses one.</li>
                        <li>Choose different colors to scan subjects faster.</li>
                        <li>A short description can help remind you what the subject covers.</li>
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