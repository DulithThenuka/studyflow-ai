<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$totalTasks = !empty($data['tasks']) ? count($data['tasks']) : 0;
$completedCount = 0;
$pendingCount = 0;
$inProgressCount = 0;
$highPriorityCount = 0;

if (!empty($data['tasks'])) {
    foreach ($data['tasks'] as $task) {
        if ($task->status === 'Completed') {
            $completedCount++;
        } elseif ($task->status === 'In Progress') {
            $inProgressCount++;
        } else {
            $pendingCount++;
        }

        if ($task->priority === 'High') {
            $highPriorityCount++;
        }
    }
}
?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero tasks-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Tasks</span>
                    <h1>Manage your study tasks with clarity</h1>
                    <p>
                        Track assignments, exams, quizzes, revisions, and deadlines in one clean workspace.
                    </p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add Task</a>
                    <a href="<?php echo URLROOT; ?>/planner" class="btn btn-outline">Open Planner</a>
                </div>
            </div>

            <?php flash('task_message'); ?>

            <div class="stats-grid modern-stats-grid compact-stats-grid">
                <div class="dash-card stat-box modern-stat-box">
                    <div class="stat-top">
                        <span>Total Tasks</span>
                        <span class="stat-icon">📝</span>
                    </div>
                    <h2><?php echo $totalTasks; ?></h2>
                    <p>Everything currently in your task system</p>
                </div>

                <div class="dash-card stat-box modern-stat-box success-card">
                    <div class="stat-top">
                        <span>Completed</span>
                        <span class="stat-icon">✅</span>
                    </div>
                    <h2><?php echo $completedCount; ?></h2>
                    <p>Tasks you have already finished</p>
                </div>

                <div class="dash-card stat-box modern-stat-box focus-card">
                    <div class="stat-top">
                        <span>In Progress</span>
                        <span class="stat-icon">🚀</span>
                    </div>
                    <h2><?php echo $inProgressCount; ?></h2>
                    <p>Tasks actively being worked on</p>
                </div>

                <div class="dash-card stat-box modern-stat-box warning-card">
                    <div class="stat-top">
                        <span>High Priority</span>
                        <span class="stat-icon">⚠</span>
                    </div>
                    <h2><?php echo $highPriorityCount; ?></h2>
                    <p>Important tasks needing attention</p>
                </div>
            </div>

            <div class="page-panel modern-page-panel">
                <div class="panel-top">
                    <div>
                        <span class="section-label">Task List</span>
                        <h3>Your tasks</h3>
                        <p>Review, update, complete, or delete tasks from here.</p>
                    </div>
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Create New Task</a>
                </div>

                <?php if (!empty($data['tasks'])) : ?>
                    <div class="task-list-modern">
                        <?php foreach ($data['tasks'] as $task) : ?>
                            <div class="task-card-modern">
                                <div class="task-card-main">
                                    <div class="task-card-head">
                                        <div class="task-card-title-wrap">
                                            <span class="subject-dot large-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                            <div>
                                                <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                                <p class="task-card-subject">
                                                    <?php echo htmlspecialchars($task->subject_name); ?>
                                                    <?php if (!empty($task->task_type)) : ?>
                                                        • <?php echo htmlspecialchars($task->task_type); ?>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="task-card-badges">
                                            <span class="priority-pill <?php echo strtolower($task->priority); ?>">
                                                <?php echo htmlspecialchars($task->priority); ?>
                                            </span>

                                            <span class="status-pill <?php echo strtolower(str_replace(' ', '-', $task->status)); ?>">
                                                <?php echo htmlspecialchars($task->status); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="task-card-body">
                                        <p>
                                            <?php
                                            echo !empty($task->description)
                                                ? htmlspecialchars($task->description)
                                                : 'No description added for this task yet.';
                                            ?>
                                        </p>
                                    </div>

                                    <div class="task-card-meta">
                                        <div class="meta-chip">
                                            <strong>Deadline:</strong>
                                            <span><?php echo !empty($task->deadline) ? htmlspecialchars($task->deadline) : 'No date'; ?></span>
                                        </div>

                                        <div class="meta-chip">
                                            <strong>Hours:</strong>
                                            <span><?php echo htmlspecialchars($task->estimated_hours); ?> hrs</span>
                                        </div>

                                        <div class="meta-chip">
                                            <strong>Score:</strong>
                                            <span><?php echo (int) $task->score; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="task-card-actions">
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
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">📝</div>
                        <h4>No tasks yet</h4>
                        <p>Create your first task and let StudyFlow AI organize your study workload more clearly.</p>
                        <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Create First Task</a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>