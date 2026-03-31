<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$subjectLabels = [];
$subjectTotals = [];
$subjectCompleted = [];

if (!empty($data['subjectProgress'])) {
    foreach ($data['subjectProgress'] as $subject) {
        $subjectLabels[] = $subject->subject_name;
        $subjectTotals[] = (int)$subject->total_tasks;
        $subjectCompleted[] = (int)$subject->completed_tasks;
    }
}
?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="command-bar">
                <div class="command-search">
                    <span class="command-icon">⌕</span>
                    <input type="text" placeholder="Search analytics, sessions, subjects..." />
                </div>
            </div>

            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Progress</span>
                    <h1>Your Study Analytics</h1>
                    <p>Track subject performance, completion rates, and recent deep work history.</p>
                </div>
            </div>

            <div class="progress-summary-grid">
                <div class="progress-summary-card">
                    <h3><?php echo (int)($data['overallStats']->total_tasks ?? 0); ?></h3>
                    <p>Total Tasks</p>
                </div>

                <div class="progress-summary-card">
                    <h3><?php echo (int)($data['overallStats']->completed_tasks ?? 0); ?></h3>
                    <p>Completed Tasks</p>
                </div>

                <div class="progress-summary-card">
                    <h3><?php echo (int)($data['overallStats']->pending_tasks ?? 0); ?></h3>
                    <p>Pending Tasks</p>
                </div>

                <div class="progress-summary-card">
                    <h3><?php echo (int)$data['weeklyStudyMinutes']; ?> min</h3>
                    <p>Last 7 Days Focus</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="dash-card progress-highlight-card">
                    <div class="card-head">
                        <h3>Overall Completion</h3>
                        <span><?php echo (int)$data['completionRate']; ?>%</span>
                    </div>

                    <p class="muted-text">Your completed work percentage across the full study system.</p>

                    <div class="dashboard-progress">
                        <div class="dashboard-progress-fill" style="width: <?php echo (int)$data['completionRate']; ?>%;"></div>
                    </div>

                    <div class="progress-highlight-meta">
                        <div>
                            <strong><?php echo htmlspecialchars($data['overallStats']->total_estimated_hours ?? 0); ?> hrs</strong>
                            <span>Total planned hours</span>
                        </div>
                        <div>
                            <strong><?php echo (int)$data['weeklyStudyMinutes']; ?> min</strong>
                            <span>Focus this week</span>
                        </div>
                    </div>
                </div>

                <div class="dash-card progress-tip-card">
                    <div class="card-head">
                        <h3>Insight Panel</h3>
                        <span>📈</span>
                    </div>

                    <div class="insight-list">
                        <div class="insight-item">
                            <strong><?php echo (int)$data['completionRate']; ?>%</strong>
                            <p>of all tasks are completed</p>
                        </div>
                        <div class="insight-item">
                            <strong><?php echo count($data['subjectProgress']); ?></strong>
                            <p>subjects are being tracked</p>
                        </div>
                        <div class="insight-item">
                            <strong><?php echo count($data['recentSessions']); ?></strong>
                            <p>recent focus sessions logged</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-chart-grid">
                <div class="dash-card chart-card">
                    <div class="card-head">
                        <h3>Subject Task Comparison</h3>
                        <span>📊</span>
                    </div>
                    <canvas id="progressSubjectChart"></canvas>
                </div>
            </div>

            <div class="page-panel">
                <div class="card-head">
                    <h3>Subject-wise Progress</h3>
                    <span>📚</span>
                </div>

                <?php if (!empty($data['subjectProgress'])) : ?>
                    <div class="subject-progress-list">
                        <?php foreach ($data['subjectProgress'] as $subject) : ?>
                            <?php
                                $total = (int)$subject->total_tasks;
                                $completed = (int)$subject->completed_tasks;
                                $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
                            ?>
                            <div class="subject-progress-card">
                                <div class="subject-progress-top">
                                    <div class="subject-progress-title">
                                        <span class="subject-dot" style="background: <?php echo htmlspecialchars($subject->color); ?>;"></span>
                                        <div>
                                            <h4><?php echo htmlspecialchars($subject->subject_name); ?></h4>
                                            <p><?php echo $completed; ?> of <?php echo $total; ?> tasks completed</p>
                                        </div>
                                    </div>

                                    <div class="subject-progress-percent">
                                        <?php echo $percent; ?>%
                                    </div>
                                </div>

                                <div class="dashboard-progress">
                                    <div class="dashboard-progress-fill" style="width: <?php echo $percent; ?>%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">📚</div>
                        <h4>No subject analytics yet</h4>
                        <p>Add subjects and tasks to unlock progress tracking insights.</p>
                        <a href="<?php echo URLROOT; ?>/subjects/add" class="btn btn-primary">Add Subject</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="page-panel" style="margin-top: 20px;">
                <div class="card-head">
                    <h3>Recent Focus Sessions</h3>
                    <span>⏱</span>
                </div>

                <?php if (!empty($data['recentSessions'])) : ?>
                    <div class="progress-session-list">
                        <?php foreach ($data['recentSessions'] as $session) : ?>
                            <div class="progress-session-item">
                                <div>
                                    <h4><?php echo htmlspecialchars($session->session_type); ?> • <?php echo (int)$session->duration_minutes; ?> min</h4>
                                    <p><?php echo !empty($session->title) ? htmlspecialchars($session->title) : 'No linked task'; ?></p>
                                </div>
                                <small><?php echo htmlspecialchars($session->session_date); ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="premium-empty-state">
                        <div class="empty-illustration">⏱</div>
                        <h4>No focus sessions yet</h4>
                        <p>Use Focus Mode to start building a deep work history.</p>
                        <a href="<?php echo URLROOT; ?>/focus" class="btn btn-primary">Open Focus Mode</a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</section>

<script>
const progressSubjectLabels = <?php echo json_encode($subjectLabels); ?>;
const progressSubjectTotals = <?php echo json_encode($subjectTotals); ?>;
const progressSubjectCompleted = <?php echo json_encode($subjectCompleted); ?>;

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('progressSubjectChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: progressSubjectLabels,
                datasets: [
                    {
                        label: 'Total Tasks',
                        data: progressSubjectTotals,
                        borderWidth: 1
                    },
                    {
                        label: 'Completed Tasks',
                        data: progressSubjectCompleted,
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>