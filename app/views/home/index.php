<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<section class="hero">
    <div class="hero-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="grid-glow"></div>
    </div>

    <div class="container hero-container">
        <div class="hero-text reveal">
            <div class="badge">Smart Student Productivity Platform</div>
            <h1>Plan Smarter.<br>Study Better.<br><span>Achieve More.</span></h1>
            <p>
                StudyFlow AI helps students organize subjects, manage deadlines, track progress,
                and get intelligent study recommendations through a beautiful and modern experience.
            </p>

            <div class="hero-buttons">
                <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary btn-lg">Start Free</a>
                <a href="#features" class="btn btn-glass btn-lg">Explore Features</a>
            </div>

            <div class="hero-stats">
                <div class="stat-card">
                    <h3>Smart</h3>
                    <p>task ranking</p>
                </div>
                <div class="stat-card">
                    <h3>Focus</h3>
                    <p>session timer</p>
                </div>
                <div class="stat-card">
                    <h3>Track</h3>
                    <p>your progress</p>
                </div>
            </div>
        </div>

        <div class="hero-visual reveal delay-1">
            <div class="dashboard-mockup">
                <div class="mockup-topbar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="mockup-body">
                    <aside class="mockup-sidebar">
                        <div class="mock-logo">SF</div>
                        <div class="mock-menu-item active"></div>
                        <div class="mock-menu-item"></div>
                        <div class="mock-menu-item"></div>
                        <div class="mock-menu-item"></div>
                    </aside>

                    <main class="mockup-main">
                        <div class="mock-row">
                            <div class="mock-card large">
                                <div class="mock-title"></div>
                                <div class="mock-line wide"></div>
                                <div class="mock-line"></div>
                                <div class="progress-bar">
                                    <div class="progress-fill"></div>
                                </div>
                            </div>
                            <div class="mock-card side">
                                <div class="mock-circle"></div>
                                <div class="mock-line"></div>
                                <div class="mock-line short"></div>
                            </div>
                        </div>

                        <div class="mock-row">
                            <div class="mock-card">
                                <div class="mock-line wide"></div>
                                <div class="mock-line"></div>
                                <div class="mock-line short"></div>
                            </div>
                            <div class="mock-card">
                                <div class="mock-line wide"></div>
                                <div class="mock-line"></div>
                                <div class="mock-line short"></div>
                            </div>
                            <div class="mock-card">
                                <div class="mock-line wide"></div>
                                <div class="mock-line"></div>
                                <div class="mock-line short"></div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-strip">
    <div class="container feature-strip-grid reveal">
        <div class="mini-feature">
            <h4>Deadline Intelligence</h4>
            <p>Know what needs attention first.</p>
        </div>
        <div class="mini-feature">
            <h4>Focus Sessions</h4>
            <p>Stay locked in with timer mode.</p>
        </div>
        <div class="mini-feature">
            <h4>Progress Insights</h4>
            <p>Turn effort into visible growth.</p>
        </div>
    </div>
</section>

<section class="section" id="features">
    <div class="container">
        <div class="section-heading reveal">
            <span class="section-label">Features</span>
            <h2>Everything students need in one smart platform</h2>
            <p>
                Built to feel like a real premium product, not a basic student CRUD project.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon">📚</div>
                <h3>Subject Management</h3>
                <p>Create subjects, organize modules, and keep your academic life neatly structured.</p>
            </div>

            <div class="feature-card reveal delay-1">
                <div class="feature-icon">🧠</div>
                <h3>Smart Planner</h3>
                <p>Tasks are ranked by urgency, priority, difficulty, and progress to suggest what to study first.</p>
            </div>

            <div class="feature-card reveal delay-2">
                <div class="feature-icon">⏱</div>
                <h3>Focus Mode</h3>
                <p>Use a modern built-in timer for deep work sessions, short breaks, and better consistency.</p>
            </div>

            <div class="feature-card reveal">
                <div class="feature-icon">📈</div>
                <h3>Progress Tracking</h3>
                <p>Visualize completed work, pending tasks, and personal study momentum over time.</p>
            </div>

            <div class="feature-card reveal delay-1">
                <div class="feature-icon">🔥</div>
                <h3>Study Streaks</h3>
                <p>Stay motivated by building consistent habits and protecting your current streak.</p>
            </div>

            <div class="feature-card reveal delay-2">
                <div class="feature-icon">✨</div>
                <h3>Motivation System</h3>
                <p>Small encouragements and intelligent reminders make the whole experience feel alive.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container two-col">
        <div class="content-block reveal">
            <span class="section-label">Why StudyFlow AI</span>
            <h2>A futuristic dashboard experience for modern students</h2>
            <p>
                We are not building a plain website. We are building a beautiful student command center
                with premium visuals, smooth interactions, and smart functionality that actually feels unique.
            </p>
            <ul class="custom-list">
                <li>Premium dark UI with glassmorphism cards</li>
                <li>Elegant animations and modern dashboard layout</li>
                <li>Smart study recommendation engine</li>
                <li>Built with PHP, JavaScript, HTML, CSS, and MySQL</li>
            </ul>
        </div>

        <div class="info-panel reveal delay-1">
            <div class="info-widget">
                <div class="widget-top">
                    <span class="widget-dot"></span>
                    <span>Today’s Recommendation</span>
                </div>
                <h3>Database Revision</h3>
                <p>Deadline is close. Completing this today will reduce tomorrow’s workload.</p>
                <div class="widget-tags">
                    <span>High Priority</span>
                    <span>2 Hours</span>
                    <span>Urgent</span>
                </div>
            </div>

            <div class="info-widget small">
                <h4>Weekly Progress</h4>
                <div class="progress-bar">
                    <div class="progress-fill fill-72"></div>
                </div>
                <p>72% of your weekly study goals completed.</p>
            </div>
        </div>
    </div>
</section>

<section class="section cta-section">
    <div class="container cta-box reveal">
        <span class="section-label">Get Started</span>
        <h2>Start building your smarter study life today</h2>
        <p>
            Register, add your subjects, create tasks, and let StudyFlow AI guide your next study session.
        </p>
        <div class="hero-buttons center">
            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary btn-lg">Create Account</a>
            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline btn-lg">Login</a>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>