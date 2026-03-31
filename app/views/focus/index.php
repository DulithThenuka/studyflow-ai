<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Focus Mode</span>
                    <h1>Deep Work Session</h1>
                    <p>Use the built-in timer to stay locked in and track study sessions.</p>
                </div>
            </div>

            <?php flash('focus_message'); ?>

            <div class="focus-grid">
                <div class="focus-main-card">
                    <div class="focus-timer-wrap">
                        <div class="focus-ring">
                            <div class="focus-time" id="focusTime">25:00</div>
                        </div>
                    </div>

                    <div class="focus-mode-switch">
                        <button class="focus-mode-btn active" data-minutes="25" data-type="Focus">Focus 25</button>
                        <button class="focus-mode-btn" data-minutes="5" data-type="Short Break">Short Break</button>
                        <button class="focus-mode-btn" data-minutes="15" data-type="Long Break">Long Break</button>
                    </div>

                    <form action="<?php echo URLROOT; ?>/focus/saveSession" method="POST" id="focusSessionForm">
                        <input type="hidden" name="duration_minutes" id="durationMinutes" value="25">
                        <input type="hidden" name="session_type" id="sessionType" value="Focus">

                        <div class="form-group">
                            <label for="task_id">Related Task</label>
                            <select name="task_id" id="task_id">
                                <option value="">No task selected</option>
                                <?php foreach ($data['tasks'] as $task) : ?>
                                    <option value="<?php echo $task->id; ?>">
                                        <?php echo htmlspecialchars($task->title . ' - ' . $task->subject_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="notes">Session Notes</label>
                            <textarea name="notes" id="notes" rows="3" placeholder="What did you study in this session?"></textarea>
                        </div>

                        <div class="focus-actions">
                            <button type="button" class="btn btn-primary" id="startTimerBtn">Start</button>
                            <button type="button" class="btn btn-outline" id="pauseTimerBtn">Pause</button>
                            <button type="button" class="btn btn-outline" id="resetTimerBtn">Reset</button>
                            <button type="submit" class="btn btn-success">Save Session</button>
                        </div>
                    </form>
                </div>

                <div class="focus-side-column">
                    <div class="focus-stat-card">
                        <h3><?php echo (int)$data['todayFocusMinutes']; ?> min</h3>
                        <p>Focus time today</p>
                    </div>

                    <div class="focus-stat-card">
                        <h3><?php echo count($data['recentSessions']); ?></h3>
                        <p>Recent sessions logged</p>
                    </div>

                    <div class="focus-history-card">
                        <div class="card-head">
                            <h3>Recent Sessions</h3>
                            <span>⏱</span>
                        </div>

                        <?php if (!empty($data['recentSessions'])) : ?>
                            <div class="focus-history-list">
                                <?php foreach ($data['recentSessions'] as $session) : ?>
                                    <div class="focus-history-item">
                                        <h4><?php echo htmlspecialchars($session->session_type); ?> • <?php echo (int)$session->duration_minutes; ?> min</h4>
                                        <p><?php echo !empty($session->title) ? htmlspecialchars($session->title) : 'No linked task'; ?></p>
                                        <small><?php echo htmlspecialchars($session->session_date); ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="empty-state">
                                <p>No sessions saved yet. Start your first focus session.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>

<script src="<?php echo URLROOT; ?>/js/focus-timer.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>