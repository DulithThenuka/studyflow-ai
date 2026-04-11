<?php require APPROOT . '/views/inc/header.php'; ?>

<?php $totalSubjects = !empty($data['subjects']) ? count($data['subjects']) : 0; ?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero subjects-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Subjects</span>
                    <h1>Organize your academic modules</h1>
                    <p>Keep every subject cleanly grouped with names, codes, colors, and descriptions.</p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/subjects/add" class="btn btn-primary">Add Subject</a>
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-outline">Add Task</a>
                </div>
            </div>

            <?php flash('subject_message'); ?>

            <div class="stats-grid modern-stats-grid compact-stats-grid">
                <div class="dash-card stat-box modern-stat-box">
                    <div class="stat-top">
                        <span>Total Subjects</span>
                        <span class="stat-icon">📚</span>
                    </div>
                    <h2><?php echo $totalSubjects; ?></h2>
                    <p>Subjects currently in your workspace</p>
                </div>

                <div class="dash-card stat-box modern-stat-box focus-card">
                    <div class="stat-top">
                        <span>Color Tagged</span>
                        <span class="stat-icon">🎨</span>
                    </div>
                    <h2><?php echo $totalSubjects; ?></h2>
                    <p>Each subject can have its own identity</p>
                </div>
            </div>

            <div class="page-panel modern-page-panel">
                <div class="panel-top">
                    <div>
                        <span class="section-label">Subject List</span>
                        <h3>Your subjects</h3>
                        <p>Manage the modules that structure your study system.</p>
                    </div>
                    <a href="<?php echo URLROOT; ?>/subjects/add" class="btn btn-primary">Create New Subject</a>
                </div>

                <?php if (!empty($data['subjects'])) : ?>
                    <div class="subjects-grid-modern">
                        <?php foreach ($data['subjects'] as $subject) : ?>
                            <div class="subject-card-modern">
                                <div class="subject-card-modern-top">
                                    <div class="subject-card-modern-badge">
                                        <span class="subject-color-large" style="background: <?php echo htmlspecialchars($subject->color); ?>;"></span>
                                        <div>
                                            <h3><?php echo htmlspecialchars($subject->subject_name); ?></h3>
                                            <p><?php echo !empty($subject->subject_code) ? htmlspecialchars($subject->subject_code) : 'No code added'; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="subject-card-modern-body">
                                    <p>
                                        <?php
                                        echo !empty($subject->description)
                                            ? htmlspecialchars($subject->description)
                                            : 'No description added for this subject yet.';
                                        ?>
                                    </p>
                                </div>

                                <div class="subject-card-modern-footer">
                                    <a href="<?php echo URLROOT; ?>/subjects/edit/<?php echo $subject->id; ?>" class="btn btn-outline btn-sm">Edit</a>

                                    <form action="<?php echo URLROOT; ?>/subjects/delete/<?php echo $subject->id; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">📚</div>
                        <h4>No subjects yet</h4>
                        <p>Create your first subject to start organizing tasks, deadlines, and study planning properly.</p>
                        <a href="<?php echo URLROOT; ?>/subjects/add" class="btn btn-primary">Create First Subject</a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>