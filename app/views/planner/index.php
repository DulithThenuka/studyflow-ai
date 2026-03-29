<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Smart Planner</span>
                    <h1>Your AI Study Recommendations</h1>
                    <p>StudyFlow AI ranks your tasks using deadline, priority, difficulty, and workload.</p>
                </div>

                <div class="topbar-actions">
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add Task</a>
                </div>
            </div>

            <?php if (!empty($data['burnoutWarning'])) : ?>
                <div class="planner-warning">
                    <strong>Burnout Warning:</strong>
                    <span><?php echo htmlspecialchars($data['burnoutWarning']); ?></span>
                </div>
            <?php endif; ?>

            <div class="planner-summary-grid">
                <div class="planner-summary-card">
                    <h3><?php echo (int)($data['plannerSummary']->total_active ?? 0); ?></h3>
                    <p>Active Tasks</p>
                </div>

                <div class="planner-summary-card">
                    <h3><?php echo htmlspecialchars($data['plannerSummary']->total_hours ?? 0); ?> hrs</h3>
                    <p>Total Estimated Hours</p>
                </div>

                <div class="planner-summary-card">
                    <h3><?php echo (int)($data['plannerSummary']->high_priority_count ?? 0); ?></h3>
                    <p>High Priority Tasks</p>
                </div>

                <div class="planner-summary-card">
                    <h3><?php echo (int)($data['plannerSummary']->urgent_count ?? 0); ?></h3>
                    <p>Urgent Deadlines</p>
                </div>
            </div>

            <div class="page-panel">
                <div class="card-head">
                    <h3>Recommended Study Order</h3>
                    <span>🧠</span>
                </div>

                <?php if (!empty($data['recommendedTasks'])) : ?>
                    <div class="planner-list">
                        <?php $rank = 1; ?>
                        <?php foreach ($data['recommendedTasks'] as $task) : ?>
                            <div class="planner-card">
                                <div class="planner-rank"><?php echo $rank; ?></div>

                                <div class="planner-main">
                                    <div class="planner-main-top">
                                        <div>
                                            <h3><?php echo htmlspecialchars($task->title); ?></h3>
                                            <p class="planner-subject">
                                                <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                                <?php echo htmlspecialchars($task->subject_name); ?>
                                            </p>
                                        </div>

                                        <div class="planner-score">
                                            Score: <?php echo (int)$task->score; ?>
                                        </div>
                                    </div>

                                    <p class="planner-note">
                                        <?php echo htmlspecialchars($task->recommendation_note); ?>
                                    </p>

                                    <div class="planner-meta">
                                        <span class="priority-pill <?php echo strtolower($task->priority); ?>">
                                            <?php echo htmlspecialchars($task->priority); ?> Priority
                                        </span>

                                        <span class="status-pill <?php echo strtolower(str_replace(' ', '-', $task->status)); ?>">
                                            <?php echo htmlspecialchars($task->status); ?>
                                        </span>

                                        <span class="planner-chip">
                                            <?php echo htmlspecialchars($task->difficulty); ?> Difficulty
                                        </span>

                                        <span class="planner-chip">
                                            <?php echo htmlspecialchars($task->estimated_hours); ?> hrs
                                        </span>

                                        <span class="planner-chip">
                                            <?php echo !empty($task->deadline) ? htmlspecialchars($task->deadline) : 'No deadline'; ?>
                                        </span>
                                    </div>

                                    <div class="planner-actions">
                                        <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->id; ?>" class="btn btn-outline btn-sm">Edit Task</a>
                                    </div>
                                </div>
                            </div>
                            <?php $rank++; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <p>No active tasks yet. Add tasks first and StudyFlow AI will recommend what to study first.</p>
                        <div style="margin-top: 16px;">
                            <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Create First Task</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>