<?php
$currentUrl = $_GET['url'] ?? '';
?>

<aside class="dashboard-sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-logo">SF</div>
        <div class="sidebar-brand-text">
            <h3>StudyFlow AI</h3>
            <p>Student productivity suite</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="<?php echo URLROOT; ?>/dashboard" class="sidebar-link <?php echo ($currentUrl == 'dashboard' || $currentUrl == '') ? 'active' : ''; ?>">
            <span class="sidebar-icon">◫</span>
            <span>Overview</span>
        </a>

        <a href="<?php echo URLROOT; ?>/subjects" class="sidebar-link <?php echo (strpos($currentUrl, 'subjects') === 0) ? 'active' : ''; ?>">
            <span class="sidebar-icon">📚</span>
            <span>Subjects</span>
        </a>

        <a href="<?php echo URLROOT; ?>/tasks" class="sidebar-link <?php echo (strpos($currentUrl, 'tasks') === 0) ? 'active' : ''; ?>">
            <span class="sidebar-icon">📝</span>
            <span>Tasks</span>
        </a>

        <a href="<?php echo URLROOT; ?>/planner" class="sidebar-link <?php echo (strpos($currentUrl, 'planner') === 0) ? 'active' : ''; ?>">
            <span class="sidebar-icon">🧠</span>
            <span>Smart Planner</span>
        </a>

        <a href="<?php echo URLROOT; ?>/focus" class="sidebar-link <?php echo (strpos($currentUrl, 'focus') === 0) ? 'active' : ''; ?>">
            <span class="sidebar-icon">⏱</span>
            <span>Focus Mode</span>
        </a>

        <a href="<?php echo URLROOT; ?>/progress" class="sidebar-link <?php echo (strpos($currentUrl, 'progress') === 0) ? 'active' : ''; ?>">
            <span class="sidebar-icon">📈</span>
            <span>Progress</span>
        </a>

        <a href="<?php echo URLROOT; ?>/profile" class="sidebar-link <?php echo (strpos($currentUrl, 'profile') === 0) ? 'active' : ''; ?>">
            <span class="sidebar-icon">👤</span>
            <span>Profile</span>
        </a>

        <a href="<?php echo URLROOT; ?>/users/logout" class="sidebar-link logout-link">
            <span class="sidebar-icon">⇠</span>
            <span>Logout</span>
        </a>
    </nav>
</aside>