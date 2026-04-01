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
                <a href="<?php echo URLROOT; ?>/admin/logout" class="admin-link">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <span class="section-label">Admin</span>
                    <h1>Manage Tasks</h1>
                    <p>Search, filter, and moderate platform tasks.</p>
                </div>
            </div>

            <?php flash('admin_message'); ?>

            <div class="admin-card">
                <form action="<?php echo URLROOT; ?>/admin/tasks" method="GET" class="admin-filter-bar">
                    <div class="command-search">
                        <span class="command-icon">⌕</span>
                        <input type="text" name="search" placeholder="Search by task, user, or type" value="<?php echo htmlspecialchars($data['search']); ?>">
                    </div>

                    <select name="status" class="admin-select">
                        <option value="">All Statuses</option>
                        <option value="Pending" <?php echo ($data['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="In Progress" <?php echo ($data['status'] === 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                        <option value="Completed" <?php echo ($data['status'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?php echo URLROOT; ?>/admin/tasks" class="btn btn-outline">Reset</a>
                </form>

                <?php if (!empty($data['tasks'])) : ?>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Type</th>
                                    <th>Deadline</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['tasks'] as $task) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($task->title); ?></td>
                                        <td><?php echo htmlspecialchars($task->user_name); ?></td>
                                        <td><?php echo htmlspecialchars($task->status); ?></td>
                                        <td><?php echo htmlspecialchars($task->priority); ?></td>
                                        <td><?php echo htmlspecialchars($task->task_type); ?></td>
                                        <td><?php echo !empty($task->deadline) ? htmlspecialchars($task->deadline) : '-'; ?></td>
                                        <td>
                                            <form action="<?php echo URLROOT; ?>/admin/deleteTask/<?php echo $task->id; ?>" method="POST" onsubmit="return confirm('Delete this task?');">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">📝</div>
                        <h4>No matching tasks found</h4>
                        <p>Try a different search or status filter.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>