<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$subjectLabels = [];
$subjectCompleted = [];
$weekLabels = [];
$weekMinutes = [];

if (!empty($data['subjectProgress'])) {
    foreach ($data['subjectProgress'] as $subject) {
        $subjectLabels[] = $subject->subject_name;
        $subjectCompleted[] = (int) $subject->completed_tasks;
    }
}

$daysMap = [];
for ($i = 6; $i >= 0; $i--) {
    $dateKey = date('Y-m-d', strtotime("-$i days"));
    $daysMap[$dateKey] = 0;
}

if (!empty($data['weeklyStudyMinutes'])) {
    foreach ($data['weeklyStudyMinutes'] as $row) {
        $daysMap[$row->session_date] = (int) $row->total_minutes;
    }
}

foreach ($daysMap as $date => $minutes) {
    $weekLabels[] = date('D', strtotime($date));
    $weekMinutes[] = $minutes;
}
?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Workspace</span>
                    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
                    <p>
                        Stay on top of tasks, focus sessions, deadlines, and subject progress
                        from one clean command center.
                    </p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/focus" class="btn btn-outline">Start Focus</a>
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add Task</a>
                </div>
            </div>

            <div class="command-bar modern-command-bar">
                <div class="command-search modern-command-search">
                    <span class="command-icon">⌕</span>
                    <input type="text" id="dashboardSearch" placeholder="Search tasks, planner, focus, profile..." />
                </div>
            </div>

            <div class="today-insight-banner">
                <div class="today-insight-icon">✨</div>
                <div>
                    <h3>Today’s insight</h3>
                    <p><?php echo htmlspecialchars($data['motivationMessage']); ?></p>
                </div>
            </div>

            <div class="stats-grid modern-stats-grid">
                <div class="dash-card stat-box modern-stat-box">
                    <div class="stat-top">
                        <span>Total Subjects</span>
                        <span class="stat-icon">📚</span>
                    </div>
                    <h2><?php echo (int) $data['totalSubjects']; ?></h2>
                    <p>All modules you are currently tracking</p>
                </div>

                <div class="dash-card stat-box modern-stat-box">
                    <div class="stat-top">
                        <span>Total Tasks</span>
                        <span class="stat-icon">📝</span>
                    </div>
                    <h2><?php echo (int) $data['totalTasks']; ?></h2>
                    <p>Assignments, revisions, and study goals</p>
                </div>

                <div class="dash-card stat-box modern-stat-box success-card">
                    <div class="stat-top">
                        <span>Completed</span>
                        <span class="stat-icon">✅</span>
                    </div>
                    <h2><?php echo (int) $data['completedTasks']; ?></h2>
                    <p>Finished tasks that pushed you forward</p>
                </div>

                <div class="dash-card stat-box modern-stat-box focus-card">
                    <div class="stat-top">
                        <span>Focus Today</span>
                        <span class="stat-icon">⏱</span>
                    </div>
                    <h2><?php echo (int) $data['studyMinutesToday']; ?> min</h2>
                    <p>Total deep work minutes recorded today</p>
                </div>
            </div>

            <div class="dashboard-priority-grid">
                <?php if (!empty($data['bestTaskForToday'])) : ?>
                    <div class="dashboard-alert-card best-task-card modern-alert-card">
                        <div class="card-head">
                            <h3>Best Task for Today</h3>
                            <span>🧠</span>
                        </div>
                        <h4><?php echo htmlspecialchars($data['bestTaskForToday']->title); ?></h4>
                        <p>
                            <?php echo htmlspecialchars($data['bestTaskForToday']->subject_name); ?>
                            • <?php echo htmlspecialchars($data['bestTaskForToday']->priority); ?> Priority
                        </p>
                        <small><?php echo htmlspecialchars($data['bestTaskForToday']->recommendation_note); ?></small>
                    </div>
                <?php endif; ?>

                <div class="dashboard-alert-card streak-card modern-alert-card">
                    <div class="card-head">
                        <h3>Study Streak</h3>
                        <span>🔥</span>
                    </div>
                    <h4><?php echo (int) $data['studyStreak']->current_streak; ?> day streak</h4>
                    <p>Longest streak: <?php echo (int) $data['studyStreak']->longest_streak; ?> days</p>
                    <small>Consistency beats intensity. Keep the chain alive.</small>
                </div>

                <div class="dashboard-alert-card modern-alert-card snapshot-card">
                    <div class="card-head">
                        <h3>Smart Snapshot</h3>
                        <span>📌</span>
                    </div>
                    <ul class="snapshot-list">
                        <li><strong><?php echo (int) $data['pendingTasks']; ?></strong> pending tasks right now</li>
                        <li><strong><?php echo count($data['upcomingTasks']); ?></strong> upcoming deadlines visible</li>
                        <li><strong><?php echo (int) $data['totalSubjects']; ?></strong> active subjects in your workspace</li>
                    </ul>
                </div>
            </div>

            <?php if (!empty($data['overdueTasks'])) : ?>
                <div class="planner-warning modern-warning-box">
                    <strong>Overdue Warning:</strong>
                    <span>You have <?php echo count($data['overdueTasks']); ?> overdue task(s) that need attention now.</span>
                </div>
            <?php endif; ?>

            <div class="dashboard-grid modern-progress-grid">
                <div class="dash-card progress-card modern-progress-card">
                    <div class="card-head">
                        <h3>Overall Progress</h3>
                        <span><?php echo (int) $data['completionRate']; ?>%</span>
                    </div>

                    <p class="muted-text">Your task completion rate across the whole workspace.</p>

                    <div class="dashboard-progress">
                        <div class="dashboard-progress-fill" style="width: <?php echo (int) $data['completionRate']; ?>%;"></div>
                    </div>

                    <div class="progress-meta">
                        <div>
                            <strong><?php echo (int) $data['completedTasks']; ?></strong>
                            <span>Completed</span>
                        </div>
                        <div>
                            <strong><?php echo (int) $data['pendingTasks']; ?></strong>
                            <span>Pending</span>
                        </div>
                    </div>
                </div>

                <div class="dash-card modern-donut-card">
                    <div class="card-head">
                        <h3>Task Completion Ratio</h3>
                        <span>🍩</span>
                    </div>
                    <canvas id="completionDonutChart"></canvas>
                </div>
            </div>

            <?php if (!empty($data['upcomingAlerts'])) : ?>
                <div class="dashboard-reminder-box modern-reminder-box">
                    <div class="card-head">
                        <h3>Upcoming Deadline Alerts</h3>
                        <span>⏰</span>
                    </div>

                    <div class="task-list">
                        <?php foreach ($data['upcomingAlerts'] as $task) : ?>
                            <div class="task-row modern-task-row">
                                <div class="task-left">
                                    <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                    <div>
                                        <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                        <p>
                                            <?php echo htmlspecialchars($task->subject_name); ?>
                                            • Due <?php echo htmlspecialchars($task->deadline); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="task-right">
                                    <span class="deadline-pill"><?php echo htmlspecialchars($task->deadline); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="dashboard-chart-grid modern-chart-grid">
                <div class="dash-card chart-card modern-chart-card">
                    <div class="card-head">
                        <h3>Focus Minutes (Last 7 Days)</h3>
                        <span>📈</span>
                    </div>
                    <canvas id="weeklyFocusChart"></canvas>
                </div>

                <div class="dash-card chart-card modern-chart-card">
                    <div class="card-head">
                        <h3>Completed Tasks by Subject</h3>
                        <span>📊</span>
                    </div>
                    <canvas id="subjectProgressChart"></canvas>
                </div>
            </div>

            <div class="dashboard-grid two-large modern-lists-grid">
                <div class="dash-card modern-list-card">
                    <div class="card-head">
                        <h3>Upcoming Deadlines</h3>
                        <span>📅</span>
                    </div>

                    <?php if (!empty($data['upcomingTasks'])) : ?>
                        <div class="task-list">
                            <?php foreach ($data['upcomingTasks'] as $task) : ?>
                                <div class="task-row modern-task-row">
                                    <div class="task-left">
                                        <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                        <div>
                                            <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                            <p>
                                                <?php echo htmlspecialchars($task->subject_name); ?>
                                                • <?php echo htmlspecialchars($task->priority); ?> Priority
                                            </p>
                                        </div>
                                    </div>
                                    <div class="task-right">
                                        <span class="deadline-pill"><?php echo htmlspecialchars($task->deadline); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="premium-empty-state">
                            <div class="empty-illustration">📅</div>
                            <h4>No deadlines yet</h4>
                            <p>Add tasks with deadlines and they will appear here in priority order.</p>
                            <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Create Task</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="dash-card modern-list-card">
                    <div class="card-head">
                        <h3>Recent Tasks</h3>
                        <span>🚀</span>
                    </div>

                    <?php if (!empty($data['recentTasks'])) : ?>
                        <div class="task-list">
                            <?php foreach ($data['recentTasks'] as $task) : ?>
                                <div class="task-row modern-task-row">
                                    <div class="task-left">
                                        <span class="subject-dot" style="background: <?php echo htmlspecialchars($task->color); ?>;"></span>
                                        <div>
                                            <h4><?php echo htmlspecialchars($task->title); ?></h4>
                                            <p>
                                                <?php echo htmlspecialchars($task->subject_name); ?>
                                                • <?php echo htmlspecialchars($task->status); ?>
                                            </p>
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
                        <div class="premium-empty-state">
                            <div class="empty-illustration">📝</div>
                            <h4>No tasks created yet</h4>
                            <p>Create your first task and let StudyFlow AI start tracking your workload.</p>
                            <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Add Task</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</section>

<script>
const weeklyFocusLabels = <?php echo json_encode($weekLabels); ?>;
const weeklyFocusData = <?php echo json_encode($weekMinutes); ?>;
const subjectProgressLabels = <?php echo json_encode($subjectLabels); ?>;
const subjectProgressData = <?php echo json_encode($subjectCompleted); ?>;
const completedTasks = <?php echo (int) $data['completedTasks']; ?>;
const pendingTasks = <?php echo (int) $data['pendingTasks']; ?>;

document.addEventListener('DOMContentLoaded', function () {
    const focusCtx = document.getElementById('weeklyFocusChart');
    if (focusCtx) {
        new Chart(focusCtx, {
            type: 'line',
            data: {
                labels: weeklyFocusLabels,
                datasets: [{
                    label: 'Focus Minutes',
                    data: weeklyFocusData,
                    borderWidth: 3,
                    tension: 0.35,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    const subjectCtx = document.getElementById('subjectProgressChart');
    if (subjectCtx) {
        new Chart(subjectCtx, {
            type: 'bar',
            data: {
                labels: subjectProgressLabels,
                datasets: [{
                    label: 'Completed Tasks',
                    data: subjectProgressData,
                    borderWidth: 1,
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    const donutCanvas = document.getElementById('completionDonutChart');
    if (donutCanvas) {
        new Chart(donutCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    data: [completedTasks, pendingTasks],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '68%'
            }
        });
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>