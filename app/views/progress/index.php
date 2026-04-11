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

if (!empty($data['weeklyStudyMinutes'])) {
    foreach ($data['weeklyStudyMinutes'] as $row) {
        $weekLabels[] = $row->session_date;
        $weekMinutes[] = (int) $row->total_minutes;
    }
}
?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero progress-hero">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Progress</span>
                    <h1>See your growth clearly</h1>
                    <p>
                        Review study sessions, task completion, subject performance,
                        and long-term momentum from one analytics page.
                    </p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/focus" class="btn btn-primary">Start Focus</a>
                    <a href="<?php echo URLROOT; ?>/planner" class="btn btn-outline">Open Planner</a>
                </div>
            </div>

            <div class="stats-grid modern-stats-grid compact-stats-grid">
                <div class="dash-card stat-box modern-stat-box">
                    <div class="stat-top">
                        <span>Total Study Minutes</span>
                        <span class="stat-icon">⏱</span>
                    </div>
                    <h2><?php echo (int) ($data['totalStudyMinutes'] ?? 0); ?></h2>
                    <p>All focus minutes recorded so far</p>
                </div>

                <div class="dash-card stat-box modern-stat-box success-card">
                    <div class="stat-top">
                        <span>Completed Tasks</span>
                        <span class="stat-icon">✅</span>
                    </div>
                    <h2><?php echo (int) ($data['completedTasks'] ?? 0); ?></h2>
                    <p>Total finished work across your system</p>
                </div>

                <div class="dash-card stat-box modern-stat-box focus-card">
                    <div class="stat-top">
                        <span>Current Streak</span>
                        <span class="stat-icon">🔥</span>
                    </div>
                    <h2><?php echo (int) ($data['studyStreak']->current_streak ?? 0); ?></h2>
                    <p>How many days you have kept going</p>
                </div>

                <div class="dash-card stat-box modern-stat-box">
                    <div class="stat-top">
                        <span>Longest Streak</span>
                        <span class="stat-icon">🏆</span>
                    </div>
                    <h2><?php echo (int) ($data['studyStreak']->longest_streak ?? 0); ?></h2>
                    <p>Your strongest consistency record</p>
                </div>
            </div>

            <div class="dashboard-chart-grid modern-chart-grid">
                <div class="dash-card chart-card modern-chart-card">
                    <div class="card-head">
                        <h3>Focus Minutes Over Time</h3>
                        <span>📈</span>
                    </div>
                    <canvas id="progressFocusChart"></canvas>
                </div>

                <div class="dash-card chart-card modern-chart-card">
                    <div class="card-head">
                        <h3>Completed Tasks by Subject</h3>
                        <span>📊</span>
                    </div>
                    <canvas id="progressSubjectChart"></canvas>
                </div>
            </div>

            <div class="dashboard-grid modern-progress-grid">
                <div class="dash-card progress-card modern-progress-card">
                    <div class="card-head">
                        <h3>Task Completion Rate</h3>
                        <span><?php echo (int) ($data['completionRate'] ?? 0); ?>%</span>
                    </div>

                    <p class="muted-text">A simple view of how much of your workload you are finishing.</p>

                    <div class="dashboard-progress">
                        <div class="dashboard-progress-fill" style="width: <?php echo (int) ($data['completionRate'] ?? 0); ?>%;"></div>
                    </div>

                    <div class="progress-meta">
                        <div>
                            <strong><?php echo (int) ($data['completedTasks'] ?? 0); ?></strong>
                            <span>Completed</span>
                        </div>
                        <div>
                            <strong><?php echo (int) ($data['pendingTasks'] ?? 0); ?></strong>
                            <span>Pending</span>
                        </div>
                    </div>
                </div>

                <div class="dash-card modern-donut-card">
                    <div class="card-head">
                        <h3>Completion Split</h3>
                        <span>🍩</span>
                    </div>
                    <canvas id="progressDonutChart"></canvas>
                </div>
            </div>

            <div class="page-panel modern-page-panel">
                <div class="panel-top">
                    <div>
                        <span class="section-label">Momentum</span>
                        <h3>Consistency summary</h3>
                        <p>Streaks and study minutes help you see whether your system is improving over time.</p>
                    </div>
                </div>

                <div class="progress-summary-grid">
                    <div class="progress-summary-card">
                        <strong><?php echo (int) ($data['todayMinutes'] ?? 0); ?> min</strong>
                        <span>Focused today</span>
                    </div>

                    <div class="progress-summary-card">
                        <strong><?php echo (int) ($data['todaySessions'] ?? 0); ?></strong>
                        <span>Sessions today</span>
                    </div>

                    <div class="progress-summary-card">
                        <strong><?php echo (int) ($data['studyStreak']->current_streak ?? 0); ?></strong>
                        <span>Current streak</span>
                    </div>

                    <div class="progress-summary-card">
                        <strong><?php echo (int) ($data['studyStreak']->longest_streak ?? 0); ?></strong>
                        <span>Best streak</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>

<script>
const progressWeekLabels = <?php echo json_encode($weekLabels); ?>;
const progressWeekMinutes = <?php echo json_encode($weekMinutes); ?>;
const progressSubjectLabels = <?php echo json_encode($subjectLabels); ?>;
const progressSubjectData = <?php echo json_encode($subjectCompleted); ?>;
const progressCompleted = <?php echo (int) ($data['completedTasks'] ?? 0); ?>;
const progressPending = <?php echo (int) ($data['pendingTasks'] ?? 0); ?>;

document.addEventListener('DOMContentLoaded', function () {
    const focusChart = document.getElementById('progressFocusChart');
    if (focusChart) {
        new Chart(focusChart, {
            type: 'line',
            data: {
                labels: progressWeekLabels,
                datasets: [{
                    label: 'Focus Minutes',
                    data: progressWeekMinutes,
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

    const subjectChart = document.getElementById('progressSubjectChart');
    if (subjectChart) {
        new Chart(subjectChart, {
            type: 'bar',
            data: {
                labels: progressSubjectLabels,
                datasets: [{
                    label: 'Completed Tasks',
                    data: progressSubjectData,
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

    const donutChart = document.getElementById('progressDonutChart');
    if (donutChart) {
        new Chart(donutChart, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending'],
                datasets: [{
                    data: [progressCompleted, progressPending],
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