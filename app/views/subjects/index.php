<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Subjects</span>
                    <h1>Manage Your Subjects</h1>
                    <p>Organize your academic modules with colors and details.</p>
                </div>

                <div class="topbar-actions">
                    <a href="<?php echo URLROOT; ?>/subjects/add" class="btn btn-primary">Add Subject</a>
                </div>
            </div>

            <?php flash('subject_message'); ?>

            <div class="page-panel">
                <div class="card-head">
                    <h3>Your Subject List</h3>
                    <span>📚</span>
                </div>

                <?php if (!empty($data['subjects'])) : ?>
                    <div class="subjects-grid">
                        <?php foreach ($data['subjects'] as $subject) : ?>
                            <div class="subject-card-pro">
                                <div class="subject-card-top">
                                    <div class="subject-badge-wrap">
                                        <span class="subject-color-large" style="background: <?php echo htmlspecialchars($subject->color); ?>;"></span>
                                        <div>
                                            <h3><?php echo htmlspecialchars($subject->subject_name); ?></h3>
                                            <p><?php echo !empty($subject->subject_code) ? htmlspecialchars($subject->subject_code) : 'No code added'; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="subject-card-body">
                                    <p>
                                        <?php
                                        echo !empty($subject->description)
                                            ? htmlspecialchars($subject->description)
                                            : 'No description added for this subject yet.';
                                        ?>
                                    </p>
                                </div>

                                <div class="subject-card-footer">
                                    <a href="<?php echo URLROOT; ?>/subjects/edit/<?php echo $subject->id; ?>" class="btn btn-outline">Edit</a>

                                    <form action="<?php echo URLROOT; ?>/subjects/delete/<?php echo $subject->id; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <p>You have not added any subjects yet. Start by creating your first subject.</p>
                        <div style="margin-top: 16px;">
                            <a href="<?php echo URLROOT; ?>/subjects/add" class="btn btn-primary">Create First Subject</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>