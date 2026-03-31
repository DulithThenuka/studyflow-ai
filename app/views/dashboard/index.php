<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$subjectLabels = [];
$subjectCompleted = [];
$weekLabels = [];
$weekMinutes = [];

if (!empty($data['subjectProgress'])) {
    foreach ($data['subjectProgress'] as $subject) {
        $subjectLabels[] = $subject->subject_name;
        $subjectCompleted[] = (int)$subject->completed_tasks;
    }
}

$daysMap = [];
for ($i = 6; $i >= 0; $i--) {
    $dateKey = date('Y-m-d', strtotime("-$i days"));
    $daysMap[$dateKey] = 0;
}
if (!empty($data['weeklyStudyMinutes'])) {
    foreach ($data['weeklyStudyMinutes'] as $row) {
        $daysMap[$row->session_date] = (int)$row->total_minutes;
    }
}
foreach ($daysMap as $date => $minutes) {
    $weekLabels[] = date('D', strtotime($date));
    $weekMinutes[] = $minutes;
}
?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="command-bar">
                <div class="command-search">
                    <span class="command-icon">⌕</span>
                    <input type="text" id="dashboardSearch" placeholder="Quick search pages, tasks, features..." />
                </div>
                <div class="command-actions">
                    <a href="<?php echo URLROOT; ?>/focus" class="btn btn-outline">Start Focus</a>
                    <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">New Task</a>
                </div>
            </div>

            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Workspace</span>
                    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
                    <p>Here’s your command center for tasks, focus time, deadlines, and academic momentum.</p>
                </div>
            </div>

            <div class="motivation-banner">
                <div class="motivation-icon">✨</div>
                <div>
                    <h3>Today’s insight</h3>
                    <p><?php echo htmlspecialchars($data['motivationMessage']); ?></p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Total Subjects</span>
                        <span class="stat-icon">📚</span>
                    </div>
                    <h2><?php echo $data['totalSubjects']; ?></h2>
                    <p>Your active modules and learning areas</p>
                </div>

                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Total Tasks</span>
                        <span class="stat-icon">📝</span>
                    </div>
                    <h2><?php echo $data['totalTasks']; ?></h2>
                    <p>Assignments, revisions, exams, and more</p>
                </div>

                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Completed</span>
                        <span class="stat-icon">✅</span>
                    </div>
                    <h2><?php echo $data['completedTasks']; ?></h2>
                    <p>Finished work you already pushed through</p>
                </div>

                <div class="dash-card stat-box">
                    <div class="stat-top">
                        <span>Focus Today</span>
                        <span class="stat-icon">⏱</span>
                    </div>
                    <h2><?php echo $data['studyMinutesToday']; ?> min</h2>
                    <p>Total deep work minutes recorded today</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="dash-card progress-card">
                    <div class="card-head">
                        <h3>Overall Progress</h3>
                        <span><?php echo $data['completionRate']; ?>%</span>
                    </div>

                    <p class="muted-text">Your current completion rate across all tasks.</p>

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
                        <h3>Smart Snapshot</h3>
                        <span>🧠</span>
                    </div>

                    <div class="insight-list">
                        <div class="insight-item">
                            <strong><?php echo $data['pendingTasks']; ?></strong>
                            <p>tasks still need your attention</p>
                        </div>
                        <div class="insight-item">
                            <strong><?php echo count($data['upcomingTasks']); ?></strong>
                            <p>upcoming deadlines visible now</p>
                        </div>
                        <div class="insight-item">
                            <strong><?php echo $data['totalSubjects']; ?></strong>
                            <p>subjects currently tracked</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-chart-grid">
                <div class="dash-card chart-card">
                    <div class="card-head">
                        <h3>Focus Minutes (Last 7 Days)</h3>
                        <span>📈</span>
                    </div>
                    <canvas id="weeklyFocusChart"></canvas>
                </div>

                <div class="dash-card chart-card">
                    <div class="card-head">
                        <h3>Completed Tasks by Subject</h3>
                        <span>📊</span>
                    </div>
                    <canvas id="subjectProgressChart"></canvas>
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
                        <div class="premium-empty-state">
                            <div class="empty-illustration">📅</div>
                            <h4>No deadlines yet</h4>
                            <p>Add tasks with deadlines and they’ll appear here in priority order.</p>
                            <a href="<?php echo URLROOT; ?>/tasks/add" class="btn btn-primary">Create Task</a>
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
                    borderWidth: 2,
                    tension: 0.35,
                    fill: true
                }]
            },
            options: {
                responsive: true,
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
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>