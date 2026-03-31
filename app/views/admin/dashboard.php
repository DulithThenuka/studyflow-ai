<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <div class="admin-logo">SF</div>
                <div>
                    <h3>StudyFlow AI</h3>
                    <p>Admin Console</p>
                </div>
            </div>

            <nav class="admin-nav">
                <a href="<?php echo URLROOT; ?>/admin/dashboard" class="admin-link active">Overview</a>
                <a href="<?php echo URLROOT; ?>/admin/users" class="admin-link">Users</a>
                <a href="<?php echo URLROOT; ?>/admin/tasks" class="admin-link">Tasks</a>
                <a href="<?php echo URLROOT; ?>" class="admin-link">Main Site</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <span class="section-label">Admin Dashboard</span>
                    <h1>System Overview</h1>
                    <p>Monitor platform growth, users, tasks, and completion performance.</p>
                </div>
            </div>

            <div class="admin-stats-grid">
                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Total Users</span>
                        <span>👥</span>
                    </div>
                    <h2><?php echo $data['total_users']; ?></h2>
                    <p>Registered student accounts</p>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Total Subjects</span>
                        <span>📚</span>
                    </div>
                    <h2><?php echo $data['total_subjects']; ?></h2>
                    <p>Subjects created in the system</p>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Total Tasks</span>
                        <span>📝</span>
                    </div>
                    <h2><?php echo $data['total_tasks']; ?></h2>
                    <p>All tasks from all users</p>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Completed Tasks</span>
                        <span>✅</span>
                    </div>
                    <h2><?php echo $data['completed_tasks']; ?></h2>
                    <p>Total completed tasks in platform</p>
                </div>
            </div>

            <div class="admin-grid">
                <div class="admin-card">
                    <div class="card-head">
                        <h3>Recent Users</h3>
                        <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-outline btn-sm">View All</a>
                    </div>

                    <?php if (!empty($data['users'])) : ?>
                        <div class="admin-list">
                            <?php foreach (array_slice($data['users'], 0, 5) as $user) : ?>
                                <div class="admin-list-item">
                                    <div>
                                        <h4><?php echo htmlspecialchars($user->name); ?></h4>
                                        <p><?php echo htmlspecialchars($user->email); ?></p>
                                    </div>
                                    <small><?php echo htmlspecialchars($user->created_at); ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="premium-empty-state">
                            <div class="empty-illustration">👥</div>
                            <h4>No users yet</h4>
                            <p>User accounts will appear here when students register.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="admin-card">
                    <div class="card-head">
                        <h3>Recent Tasks</h3>
                        <a href="<?php echo URLROOT; ?>/admin/tasks" class="btn btn-outline btn-sm">View All</a>
                    </div>

                    <?php if (!empty($data['tasks'])) : ?>
                        <div class="admin-list">
                            <?php foreach (array_slice($data['tasks'], 0, 5) as $task) : ?>
                                <div class="admin-list-item">
                                    <div>
                                        <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                        <p><?php echo htmlspecialchars($task->user_name); ?> • <?php echo htmlspecialchars($task->status); ?></p>
                                    </div>
                                    <small><?php echo htmlspecialchars($task->created_at); ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="premium-empty-state">
                            <div class="empty-illustration">📝</div>
                            <h4>No tasks yet</h4>
                            <p>Tasks created by users will appear here.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>