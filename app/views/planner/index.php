<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero planner-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Planner</span>
                    <h1>Plan smarter, not harder</h1>
                    <p>
                        View recommended tasks, urgency levels, and study priorities
                        so you always know what to work on next.
                    </p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add Task</a>
                    <a href="<?php echo URLROOT; ?>/tasks" class="btn btn-outline">View Tasks</a>
                </div>
            </div>

            <?php if (!empty($data['overdueTasks'])) : ?>
                <div class="planner-warning modern-warning-box">
                    <strong>Overdue Warning:</strong>
                    <span>You have <?php echo count($data['overdueTasks']); ?> overdue task(s) that need immediate action.</span>
                </div>
            <?php endif; ?>

            <div class="page-panel modern-page-panel">
                <div class="panel-top">
                    <div>
                        <span class="section-label">Smart Recommendations</span>
                        <h3>Best tasks to work on now</h3>
                        <p>Your planner ranks tasks using urgency, deadline, priority, and estimated effort.</p>
                    </div>
                </div>

                <?php if (!empty($data['recommendedTasks'])) : ?>
                    <div class="planner-recommendation-list">
                        <?php foreach ($data['recommendedTasks'] as $task) : ?>
                            <div class="planner-recommendation-card">
                                <div class="planner-recommendation-main">
                                    <div class="planner-recommendation-head">
                                        <div class="planner-recommendation-title">
                                            <span class="subject-dot large-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                            <div>
                                                <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                                <p>
                                                    <?php echo htmlspecialchars($task->subject_name); ?>
                                                    <?php if (!empty($task->task_type)) : ?>
                                                        • <?php echo htmlspecialchars($task->task_type); ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="planner-badge-cluster">
                                            <span class="priority-pill <?php echo strtolower($task->priority); ?>">
                                                <?php echo htmlspecialchars($task->priority); ?>
                                            </span>
                                            <span class="planner-score-pill">
                                                Score: <?php echo (int) $task->score; ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="planner-recommendation-body">
                                        <p>
                                            <?php
                                            echo !empty($task->description)
                                                ? htmlspecialchars($task->description)
                                                : 'No description available for this recommendation.';
                                            ?>
                                        </p>
                                    </div>

                                    <div class="planner-recommendation-meta">
                                        <div class="meta-chip">
                                            <strong>Deadline:</strong>
                                            <span><?php echo !empty($task->deadline) ? htmlspecialchars($task->deadline) : 'No deadline'; ?></span>
                                        </div>
                                        <div class="meta-chip">
                                            <strong>Difficulty:</strong>
                                            <span><?php echo htmlspecialchars($task->difficulty); ?></span>
                                        </div>
                                        <div class="meta-chip">
                                            <strong>Estimated Hours:</strong>
                                            <span><?php echo htmlspecialchars($task->estimated_hours); ?> hrs</span>
                                        </div>
                                    </div>

                                    <?php if (!empty($task->recommendation_note)) : ?>
                                        <div class="planner-note-box">
                                            <strong>Why this matters now:</strong>
                                            <span><?php echo htmlspecialchars($task->recommendation_note); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="planner-recommendation-actions">
                                    <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->id; ?>" class="btn btn-outline btn-sm">Edit</a>

                                    <?php if ($task->status !== 'Completed') : ?>
                                        <form action="<?php echo URLROOT; ?>/tasks/complete/<?php echo $task->id; ?>" method="POST">
                                            <button type="submit" class="btn btn-success btn-sm">Complete</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">🧠</div>
                        <h4>No planner recommendations yet</h4>
                        <p>Add tasks with priority, deadline, and estimated hours to unlock smarter planning suggestions.</p>
                        <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add First Task</a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($data['overdueTasks'])) : ?>
                <div class="page-panel modern-page-panel">
                    <div class="panel-top">
                        <div>
                            <span class="section-label">Urgent</span>
                            <h3>Overdue tasks</h3>
                            <p>These tasks are already past their deadline and should be handled first.</p>
                        </div>
                    </div>

                    <div class="task-list-modern">
                        <?php foreach ($data['overdueTasks'] as $task) : ?>
                            <div class="task-card-modern overdue-task-card">
                                <div class="task-card-main">
                                    <div class="task-card-head">
                                        <div class="task-card-title-wrap">
                                            <span class="subject-dot large-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                            <div>
                                                <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                                <p class="task-card-subject"><?php echo htmlspecialchars($task->subject_name); ?></p>
                                            </div>
                                        </div>

                                        <div class="task-card-badges">
                                            <span class="priority-pill high">High</span>
                                            <span class="status-pill pending">Overdue</span>
                                        </div>
                                    </div>

                                    <div class="task-card-meta">
                                        <div class="meta-chip">
                                            <strong>Deadline:</strong>
                                            <span><?php echo htmlspecialchars($task->deadline); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="task-card-actions">
                                    <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->id; ?>" class="btn btn-outline btn-sm">Edit</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>