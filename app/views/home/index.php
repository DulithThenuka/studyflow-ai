<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<section class="saas-hero">
    <div class="saas-hero-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="grid-glow"></div>
    </div>

    <div class="container saas-hero-container">
        <div class="saas-hero-text reveal active">
            <span class="badge">Student Productivity SaaS</span>
            <h1>Study smarter with a beautiful AI-powered academic workspace.</h1>
            <p>
                StudyFlow AI helps students plan tasks, prioritize deadlines, run focus sessions,
                and visualize study progress from one premium dashboard.
            </p>

            <div class="hero-buttons">
                <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary btn-lg">Start Free</a>
                <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline btn-lg">Live Dashboard</a>
            </div>

            <div class="saas-hero-proof">
                <div><strong>Smart</strong><span> task scoring</span></div>
                <div><strong>Focus</strong><span> session mode</span></div>
                <div><strong>Insight</strong><span> analytics & charts</span></div>
            </div>
        </div>

        <div class="saas-hero-ui reveal active">
            <div class="saas-window">
                <div class="saas-window-top">
                    <span></span><span></span><span></span>
                </div>

                <div class="saas-window-body">
                    <div class="saas-preview-sidebar">
                        <div class="preview-logo">SF</div>
                        <div class="preview-nav-item active"></div>
                        <div class="preview-nav-item"></div>
                        <div class="preview-nav-item"></div>
                        <div class="preview-nav-item"></div>
                    </div>

                    <div class="saas-preview-main">
                        <div class="preview-header-card"></div>
                        <div class="preview-stats-row">
                            <div class="preview-mini-card"></div>
                            <div class="preview-mini-card"></div>
                            <div class="preview-mini-card"></div>
                        </div>
                        <div class="preview-chart-card"></div>
                        <div class="preview-list-row">
                            <div class="preview-list-card"></div>
                            <div class="preview-list-card"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="saas-logo-strip">
    <div class="container saas-logo-strip-inner">
        <span>Smart planning</span>
        <span>Focus tracking</span>
        <span>Progress insights</span>
        <span>Student workflow</span>
        <span>Premium dashboard</span>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading reveal active">
            <span class="section-label">Why StudyFlow AI</span>
            <h2>Your all-in-one academic operating system</h2>
            <p>
                More than a normal student project — this is a polished SaaS-style experience for planning and performance.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal active">
                <div class="feature-icon">🧠</div>
                <h3>AI-style Smart Planner</h3>
                <p>Rank study tasks automatically based on urgency, difficulty, and effort.</p>
            </div>

            <div class="feature-card reveal active">
                <div class="feature-icon">⏱</div>
                <h3>Built-in Focus Sessions</h3>
                <p>Stay locked in with timer-based study sessions and save your deep work history.</p>
            </div>

            <div class="feature-card reveal active">
                <div class="feature-icon">📊</div>
                <h3>Analytics Dashboard</h3>
                <p>Visualize progress, compare subjects, and understand how your workload is changing.</p>
            </div>

            <div class="feature-card reveal active">
                <div class="feature-icon">📚</div>
                <h3>Subject Workspaces</h3>
                <p>Organize modules, color-code subjects, and keep everything clean and structured.</p>
            </div>

            <div class="feature-card reveal active">
                <div class="feature-icon">🚀</div>
                <h3>Premium User Experience</h3>
                <p>Enjoy a modern glassmorphism interface built to feel like a real startup product.</p>
            </div>

            <div class="feature-card reveal active">
                <div class="feature-icon">🔥</div>
                <h3>Momentum Tracking</h3>
                <p>Build consistent progress through visibility, focus time, and completion insights.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container two-col">
        <div class="content-block reveal active">
            <span class="section-label">Built for real students</span>
            <h2>From deadline chaos to a calm study workflow</h2>
            <p>
                StudyFlow AI transforms scattered academic tasks into one structured workspace where students can
                see what matters, focus deeply, and improve week by week.
            </p>
            <ul class="custom-list">
                <li>Track assignments, quizzes, revisions, and exams</li>
                <li>Use AI-style scoring to decide what to study first</li>
                <li>Measure focus time and study progress visually</li>
                <li>Keep subjects, deadlines, and sessions in one dashboard</li>
            </ul>
        </div>

        <div class="info-panel reveal active">
            <div class="info-widget">
                <div class="widget-top">
                    <span class="widget-dot"></span>
                    <span>Today’s Recommendation</span>
                </div>
                <h3>Database Revision</h3>
                <p>Recommended because the deadline is near, difficulty is high, and the task is still pending.</p>
                <div class="widget-tags">
                    <span>Urgent</span>
                    <span>High Priority</span>
                    <span>2 Hours</span>
                </div>
            </div>

            <div class="info-widget small">
                <h4>Weekly Completion</h4>
                <div class="progress-bar">
                    <div class="progress-fill fill-72"></div>
                </div>
                <p>72% of weekly targets completed inside the workspace.</p>
            </div>
        </div>
    </div>
</section>

<section class="section cta-section">
    <div class="container cta-box reveal active">
        <span class="section-label">Get Started</span>
        <h2>Turn your study system into a real workflow</h2>
        <p>
            Join StudyFlow AI and manage subjects, tasks, focus sessions, and progress inside one modern platform.
        </p>
        <div class="hero-buttons center">
            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary btn-lg">Create Account</a>
            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline btn-lg">Login</a>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>