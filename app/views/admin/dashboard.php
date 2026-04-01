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
                <a href="<?php echo URLROOT; ?>/admin/logout" class="admin-link">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <span class="section-label">Admin Dashboard</span>
                    <h1>System Overview</h1>
                    <p>Monitor users, tasks, and overall platform activity.</p>
                </div>
            </div>

            <?php flash('admin_message'); ?>

            <div class="admin-stats-grid">
                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Total Users</span>
                        <span>👥</span>
                    </div>
                    <h2><?php echo $data['total_users']; ?></h2>
                    <p>Registered accounts</p>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Total Subjects</span>
                        <span>📚</span>
                    </div>
                    <h2><?php echo $data['total_subjects']; ?></h2>
                    <p>Subjects across the platform</p>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Total Tasks</span>
                        <span>📝</span>
                    </div>
                    <h2><?php echo $data['total_tasks']; ?></h2>
                    <p>All created tasks</p>
                </div>

                <div class="admin-stat-card">
                    <div class="admin-stat-top">
                        <span>Completed Tasks</span>
                        <span>✅</span>
                    </div>
                    <h2><?php echo $data['completed_tasks']; ?></h2>
                    <p>Finished tasks platform-wide</p>
                </div>
            </div>

            <div class="admin-grid">
                <div class="admin-card">
                    <div class="card-head">
                        <h3>Platform Activity</h3>
                        <span>📊</span>
                    </div>

                    <div class="admin-list">
                        <div class="admin-list-item">
                            <div>
                                <h4>Pending Tasks</h4>
                                <p>Tasks still waiting to be completed</p>
                            </div>
                            <strong><?php echo (int)$data['platform_activity']->pending_tasks; ?></strong>
                        </div>

                        <div class="admin-list-item">
                            <div>
                                <h4>In Progress Tasks</h4>
                                <p>Tasks currently being worked on</p>
                            </div>
                            <strong><?php echo (int)$data['platform_activity']->in_progress_tasks; ?></strong>
                        </div>

                        <div class="admin-list-item">
                            <div>
                                <h4>Total Estimated Hours</h4>
                                <p>Total planned academic workload</p>
                            </div>
                            <strong><?php echo htmlspecialchars($data['platform_activity']->total_estimated_hours); ?> hrs</strong>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="card-head">
                        <h3>Quick Access</h3>
                        <span>⚡</span>
                    </div>

                    <div class="admin-quick-links">
                        <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-outline">Manage Users</a>
                        <a href="<?php echo URLROOT; ?>/admin/tasks" class="btn btn-outline">Manage Tasks</a>
                        <a href="<?php echo URLROOT; ?>" class="btn btn-primary">Open Main Site</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>