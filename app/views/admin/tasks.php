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
                <a href="<?php echo URLROOT; ?>/admin/dashboard" class="admin-link">Overview</a>
                <a href="<?php echo URLROOT; ?>/admin/users" class="admin-link">Users</a>
                <a href="<?php echo URLROOT; ?>/admin/tasks" class="admin-link active">Tasks</a>
                <a href="<?php echo URLROOT; ?>" class="admin-link">Main Site</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <span class="section-label">Admin</span>
                    <h1>Manage Tasks</h1>
                    <p>Monitor user-created tasks and their current statuses.</p>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-head">
                    <h3>All Tasks</h3>
                </div>

                <?php if (!empty($data['tasks'])) : ?>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Deadline</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['tasks'] as $task) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($task->title); ?></td>
                                        <td><?php echo htmlspecialchars($task->user_name); ?></td>
                                        <td><?php echo htmlspecialchars($task->status); ?></td>
                                        <td><?php echo htmlspecialchars($task->priority); ?></td>
                                        <td><?php echo !empty($task->deadline) ? htmlspecialchars($task->deadline) : '-'; ?></td>
                                        <td><?php echo htmlspecialchars($task->created_at); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">📝</div>
                        <h4>No tasks found</h4>
                        <p>Tasks will appear here once users begin using the app.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>