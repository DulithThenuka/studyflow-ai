<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page dashboard-page-modern">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main modern-dashboard-main">
            <div class="dashboard-hero page-hero focus-hero-modern">
                <div class="dashboard-hero-copy">
                    <span class="section-label">Focus Mode</span>
                    <h1>Protect your deep work time</h1>
                    <p>
                        Start a focused study session, reduce distraction,
                        and build your consistency one session at a time.
                    </p>
                </div>

                <div class="dashboard-hero-actions">
                    <a href="<?php echo URLROOT; ?>/progress" class="btn btn-outline">View Progress</a>
                </div>
            </div>

            <?php flash('focus_message'); ?>

            <div class="focus-layout-modern">
                <div class="focus-main-card">
                    <span class="section-label">Session Timer</span>
                    <h3>Stay locked in</h3>
                    <p>Choose your study duration and start a distraction-free work session.</p>

                    <div class="focus-timer-ring">
                        <div class="focus-timer-content">
                            <span id="sessionLabel">Ready</span>
                            <h2 id="timerDisplay">25:00</h2>
                            <p id="focusStatusText">Pick a duration and start your session</p>
                        </div>
                    </div>

                    <div class="focus-duration-pills">
                        <button type="button" class="duration-pill active" data-minutes="25">25 min</button>
                        <button type="button" class="duration-pill" data-minutes="45">45 min</button>
                        <button type="button" class="duration-pill" data-minutes="60">60 min</button>
                        <button type="button" class="duration-pill" data-minutes="90">90 min</button>
                    </div>

                    <div class="focus-actions-modern">
                        <button id="startFocusBtn" class="btn btn-primary">Start Session</button>
                        <button id="pauseFocusBtn" class="btn btn-outline" disabled>Pause</button>
                        <button id="resetFocusBtn" class="btn btn-danger">Reset</button>
                    </div>
                </div>

                <div class="focus-side-column">
                    <div class="modern-side-info-card">
                        <span class="section-label">Today</span>
                        <h3>Focus summary</h3>

                        <div class="focus-stat-stack">
                            <div class="focus-mini-stat">
                                <strong><?php echo (int) ($data['todayMinutes'] ?? 0); ?> min</strong>
                                <span>Focused today</span>
                            </div>

                            <div class="focus-mini-stat">
                                <strong><?php echo (int) ($data['todaySessions'] ?? 0); ?></strong>
                                <span>Sessions completed</span>
                            </div>

                            <div class="focus-mini-stat">
                                <strong><?php echo (int) ($data['currentStreak'] ?? 0); ?></strong>
                                <span>Current streak</span>
                            </div>
                        </div>
                    </div>

                    <div class="modern-side-info-card">
                        <span class="section-label">Tips</span>
                        <h3>Study better with focus mode</h3>
                        <ul class="side-tip-list">
                            <li>Work in short intense blocks instead of multitasking.</li>
                            <li>Keep your phone away during active study sessions.</li>
                            <li>Use 25–45 minute sessions for harder subjects.</li>
                            <li>Record sessions consistently to build visible progress.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <form id="focusSessionForm" action="<?php echo URLROOT; ?>/focus/save" method="POST" style="display:none;">
                <input type="hidden" name="duration_minutes" id="durationMinutesInput" value="25">
                <input type="hidden" name="completed" id="completedInput" value="1">
            </form>
        </main>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const timerDisplay = document.getElementById('timerDisplay');
    const statusText = document.getElementById('focusStatusText');
    const sessionLabel = document.getElementById('sessionLabel');
    const durationInput = document.getElementById('durationMinutesInput');
    const sessionForm = document.getElementById('focusSessionForm');

    const startBtn = document.getElementById('startFocusBtn');
    const pauseBtn = document.getElementById('pauseFocusBtn');
    const resetBtn = document.getElementById('resetFocusBtn');

    const durationButtons = document.querySelectorAll('.duration-pill');

    let selectedMinutes = 25;
    let totalSeconds = selectedMinutes * 60;
    let currentSeconds = totalSeconds;
    let timer = null;
    let running = false;
    let paused = false;

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60).toString().padStart(2, '0');
        const secs = (seconds % 60).toString().padStart(2, '0');
        return mins + ':' + secs;
    }

    function updateDisplay() {
        timerDisplay.textContent = formatTime(currentSeconds);
    }

    function resetStateText() {
        sessionLabel.textContent = 'Ready';
        statusText.textContent = 'Pick a duration and start your session';
    }

    durationButtons.forEach((btn) => {
        btn.addEventListener('click', function () {
            if (running) return;

            durationButtons.forEach((b) => b.classList.remove('active'));
            btn.classList.add('active');

            selectedMinutes = parseInt(btn.dataset.minutes, 10);
            totalSeconds = selectedMinutes * 60;
            currentSeconds = totalSeconds;
            durationInput.value = selectedMinutes;
            updateDisplay();
            resetStateText();
        });
    });

    startBtn.addEventListener('click', function () {
        if (!running) {
            running = true;
            paused = false;
            sessionLabel.textContent = 'Focus Session';
            statusText.textContent = 'Stay focused. Your session is running.';
            pauseBtn.disabled = false;

            timer = setInterval(() => {
                currentSeconds--;
                updateDisplay();

                if (currentSeconds <= 0) {
                    clearInterval(timer);
                    running = false;
                    paused = false;
                    sessionLabel.textContent = 'Completed';
                    statusText.textContent = 'Great work. Your focus session is complete.';
                    pauseBtn.disabled = true;

                    setTimeout(() => {
                        sessionForm.submit();
                    }, 900);
                }
            }, 1000);
        } else if (paused) {
            paused = false;
            statusText.textContent = 'Session resumed. Keep going.';
            timer = setInterval(() => {
                currentSeconds--;
                updateDisplay();

                if (currentSeconds <= 0) {
                    clearInterval(timer);
                    running = false;
                    paused = false;
                    sessionLabel.textContent = 'Completed';
                    statusText.textContent = 'Great work. Your focus session is complete.';
                    pauseBtn.disabled = true;

                    setTimeout(() => {
                        sessionForm.submit();
                    }, 900);
                }
            }, 1000);
        }
    });

    pauseBtn.addEventListener('click', function () {
        if (running && !paused) {
            clearInterval(timer);
            paused = true;
            statusText.textContent = 'Session paused. Continue when ready.';
        }
    });

    resetBtn.addEventListener('click', function () {
        clearInterval(timer);
        running = false;
        paused = false;
        currentSeconds = totalSeconds;
        updateDisplay();
        resetStateText();
        pauseBtn.disabled = true;
    });

    updateDisplay();
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>