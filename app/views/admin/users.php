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
                <a href="<?php echo URLROOT; ?>/admin/users" class="admin-link active">Users</a>
                <a href="<?php echo URLROOT; ?>/admin/tasks" class="admin-link">Tasks</a>
                <a href="<?php echo URLROOT; ?>" class="admin-link">Main Site</a>
                <a href="<?php echo URLROOT; ?>/admin/logout" class="admin-link">Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <span class="section-label">Admin</span>
                    <h1>Manage Users</h1>
                    <p>Search and manage all registered users.</p>
                </div>
            </div>

            <?php flash('admin_message'); ?>

            <div class="admin-card">
                <form action="<?php echo URLROOT; ?>/admin/users" method="GET" class="admin-filter-bar">
                    <div class="command-search">
                        <span class="command-icon">⌕</span>
                        <input type="text" name="search" placeholder="Search by name, email, university, or course" value="<?php echo htmlspecialchars($data['search']); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="<?php echo URLROOT; ?>/admin/users" class="btn btn-outline">Reset</a>
                </form>

                <?php if (!empty($data['users'])) : ?>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>University</th>
                                    <th>Course</th>
                                    <th>Joined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['users'] as $user) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user->name); ?></td>
                                        <td><?php echo htmlspecialchars($user->email); ?></td>
                                        <td><?php echo !empty($user->university) ? htmlspecialchars($user->university) : '-'; ?></td>
                                        <td><?php echo !empty($user->course) ? htmlspecialchars($user->course) : '-'; ?></td>
                                        <td><?php echo htmlspecialchars($user->created_at); ?></td>
                                        <td>
                                            <form action="<?php echo URLROOT; ?>/admin/deleteUser/<?php echo $user->id; ?>" method="POST" onsubmit="return confirm('Delete this user?');">
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
                        <div class="empty-illustration">👥</div>
                        <h4>No matching users found</h4>
                        <p>Try another search term.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>