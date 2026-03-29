<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Dashboard</span>
                    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
                    <p>Your smart study command center is ready.</p>
                </div>

                <div class="topbar-actions">
                    <a href="<?php echo URLROOT; ?>/subjects" class="btn btn-outline">Manage Subjects</a>
                    <a href="<?php echo URLROOT; ?>/tasks" class="btn btn-primary">Manage Tasks</a>
                </div>
            </div>

            <div class="motivation-banner">
                <div class="motivation-icon">✨</div>
                <div>
                    <h3>Motivation for today</h3>
                    <p><?php echo htmlspecialchars($data['motivationMessage']); ?></p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Total Subjects</span>
                        <span>📚</span>
                    </div>
                    <h2><?php echo $data['totalSubjects']; ?></h2>
                    <p>Your active study modules</p>
                </div>

                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Total Tasks</span>
                        <span>📝</span>
                    </div>
                    <h2><?php echo $data['totalTasks']; ?></h2>
                    <p>All assignments, exams, and revisions</p>
                </div>

                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Completed</span>
                        <span>✅</span>
                    </div>
                    <h2><?php echo $data['completedTasks']; ?></h2>
                    <p>Tasks you have already finished</p>
                </div>

                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Today’s Focus</span>
                        <span>⏱</span>
                    </div>
                    <h2><?php echo $data['studyMinutesToday']; ?> min</h2>
                    <p>Total focus minutes recorded today</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="dash-card progress-card">
                    <div class="card-head">
                        <h3>Study Progress</h3>
                        <span><?php echo $data['completionRate']; ?>%</span>
                    </div>

                    <p class="muted-text">Your overall task completion progress</p>

                    <div class="dashboard-progress">
                        <div class="dashboard-progress-fill" style="width: <?php echo $data['completionRate']; ?>%;"></div>
                    </div>

                    <div class="progress-meta">
                        <div>
                            <strong><?php echo $data['completedTasks']; ?></strong>
                            <span>Completed</span>
                        </div>
                        <div>
                            <strong><?php echo $data['pendingTasks']; ?></strong>
                            <span>Pending</span>
                        </div>
                    </div>
                </div>

                <div class="dash-card quick-card">
                    <div class="card-head">
                        <h3>Quick Insight</h3>
                        <span>🧠</span>
                    </div>

                    <div class="insight-list">
                        <div class="insight-item">
                            <strong><?php echo $data['pendingTasks']; ?></strong>
                            <p>tasks still need your attention</p>
                        </div>
                        <div class="insight-item">
                            <strong><?php echo count($data['upcomingTasks']); ?></strong>
                            <p>upcoming deadlines are currently visible</p>
                        </div>
                        <div class="insight-item">
                            <strong><?php echo $data['completionRate']; ?>%</strong>
                            <p>completion rate so far</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid two-large">
                <div class="dash-card">
                    <div class="card-head">
                        <h3>Upcoming Deadlines</h3>
                        <span>📅</span>
                    </div>

                    <?php if (!empty($data['upcomingTasks'])) : ?>
                        <div class="task-list">
                            <?php foreach ($data['upcomingTasks'] as $task) : ?>
                                <div class="task-row">
                                    <div class="task-left">
                                        <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                        <div>
                                            <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                            <p><?php echo htmlspecialchars($task->subject_name); ?> • <?php echo htmlspecialchars($task->priority); ?> Priority</p>
                                        </div>
                                    </div>
                                    <div class="task-right">
                                        <span class="deadline-pill"><?php echo htmlspecialchars($task->deadline); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="empty-state">
                            <p>No upcoming deadlines yet. Add tasks to start planning smarter.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="dash-card">
                    <div class="card-head">
                        <h3>Recent Tasks</h3>
                        <span>🚀</span>
                    </div>

                    <?php if (!empty($data['recentTasks'])) : ?>
                        <div class="task-list">
                            <?php foreach ($data['recentTasks'] as $task) : ?>
                                <div class="task-row">
                                    <div class="task-left">
                                        <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                        <div>
                                            <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                            <p><?php echo htmlspecialchars($task->subject_name); ?> • <?php echo htmlspecialchars($task->status); ?></p>
                                        </div>
                                    </div>
                                    <div class="task-right">
                                        <span class="status-pill <?php echo strtolower(str_replace(' ', '-', $task->status)); ?>">
                                            <?php echo htmlspecialchars($task->status); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="empty-state">
                            <p>No tasks yet. Start by creating a subject and adding your first task.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>