document.addEventListener('DOMContentLoaded', function () {
    const timeDisplay = document.getElementById('focusTime');
    const startBtn = document.getElementById('startTimerBtn');
    const pauseBtn = document.getElementById('pauseTimerBtn');
    const resetBtn = document.getElementById('resetTimerBtn');
    const modeButtons = document.querySelectorAll('.focus-mode-btn');
    const durationInput = document.getElementById('durationMinutes');
    const sessionTypeInput = document.getElementById('sessionType');

    let selectedMinutes = 25;
    let timeLeft = selectedMinutes * 60;
    let timer = null;
    let isRunning = false;

    function updateDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timeDisplay.textContent =
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
    }

    function startTimer() {
        if (isRunning) return;

        isRunning = true;
        timer = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft--;
                updateDisplay();
            } else {
                clearInterval(timer);
                isRunning = false;
                alert('Session complete!');
            }
        }, 1000);
    }

    function pauseTimer() {
        clearInterval(timer);
        isRunning = false;
    }

    function resetTimer() {
        pauseTimer();
        timeLeft = selectedMinutes * 60;
        updateDisplay();
    }

    modeButtons.forEach((btn) => {
        btn.addEventListener('click', function () {
            modeButtons.forEach((b) => b.classList.remove('active'));
            this.classList.add('active');

            selectedMinutes = parseInt(this.dataset.minutes, 10);
            const selectedType = this.dataset.type;

            durationInput.value = selectedMinutes;
            sessionTypeInput.value = selectedType;

            timeLeft = selectedMinutes * 60;
            updateDisplay();
            pauseTimer();
        });
    });

    if (startBtn) startBtn.addEventListener('click', startTimer);
    if (pauseBtn) pauseBtn.addEventListener('click', pauseTimer);
    if (resetBtn) resetBtn.addEventListener('click', resetTimer);

    updateDisplay();
});