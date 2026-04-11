<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Tasks</span>
                    <h1>Manage Your Tasks</h1>
                    <p>Track assignments, exams, revisions, and everything important.</p>
                </div>

                <div class="topbar-actions">
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add Task</a>
                </div>
            </div>

            <?php flash('task_message'); ?>

            <div class="page-panel">
                <div class="card-head">
                    <h3>Your Task List</h3>
                    <span>📝</span>
                </div>

                <?php if (!empty($data['tasks'])) : ?>
                    <div class="task-table-wrap">
                        <div class="task-table">
                            <div class="task-table-head">
                                <div>Task</div>
                                <div>Subject</div>
                                <div>Type</div>
                                <div>Priority</div>
                                <div>Status</div>
                                <div>Deadline</div>
                                <div>Actions</div>
                            </div>

                            <?php foreach ($data['tasks'] as $task) : ?>
                                <div class="task-table-row">
                                    <div class="task-col-main">
                                        <div class="task-main-block">
                                            <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                            <p>
                                                <?php echo !empty($task->description) ? htmlspecialchars($task->description) : 'No description'; ?>
                                            </p>
                                            <small>Score: <?php echo (int)$task->score; ?> • <?php echo htmlspecialchars($task->estimated_hours); ?> hrs</small>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="subject-chip">
                                            <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                            <?php echo htmlspecialchars($task->subject_name); ?>
                                        </span>
                                    </div>

                                    <div><?php echo htmlspecialchars($task->task_type); ?></div>

                                    <div>
                                        <span class="priority-pill <?php echo strtolower($task->priority); ?>">
                                            <?php echo htmlspecialchars($task->priority); ?>
                                        </span>
                                    </div>

                                    <div>
                                        <span class="status-pill <?php echo strtolower(str_replace(' ', '-', $task->status)); ?>">
                                            <?php echo htmlspecialchars($task->status); ?>
                                        </span>
                                    </div>

                                    <div>
                                        <?php echo !empty($task->deadline) ? htmlspecialchars($task->deadline) : 'No date'; ?>
                                    </div>

                                    <div>
                                        <div class="table-actions">
                                            <a href="<?php echo URLROOT; ?>/tasks/edit/<?php echo $task->id; ?>" class="btn btn-outline btn-sm">Edit</a>

                                            <?php if ($task->status !== 'Completed') : ?>
                                                <form action="<?php echo URLROOT; ?>/tasks/complete/<?php echo $task->id; ?>" method="POST">
                                                    <button type="submit" class="btn btn-success btn-sm">Complete</button>
                                                </form>
                                            <?php endif; ?>

                                            <form action="<?php echo URLROOT; ?>/tasks/delete/<?php echo $task->id; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <p>You have not added any tasks yet. Create your first task and let StudyFlow AI rank it smartly.</p>
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