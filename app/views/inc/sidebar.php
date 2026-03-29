<?php
$currentUrl = $_GET['url'] ?? '';
?>

<aside class="dashboard-sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-logo">SF</div>
        <div>
            <h3>StudyFlow AI</h3>
            <p>Student Panel</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="<?php echo URLROOT; ?>/dashboard" class="sidebar-link <?php echo ($currentUrl == 'dashboard' || $currentUrl == '') ? 'active' : ''; ?>">Dashboard</a>
        <a href="<?php echo URLROOT; ?>/subjects" class="sidebar-link <?php echo (strpos($currentUrl, 'subjects') === 0) ? 'active' : ''; ?>">Subjects</a>
        <a href="<?php echo URLROOT; ?>/tasks" class="sidebar-link <?php echo (strpos($currentUrl, 'tasks') === 0) ? 'active' : ''; ?>">Tasks</a>
        <a href="<?php echo URLROOT; ?>/planner" class="sidebar-link <?php echo (strpos($currentUrl, 'planner') === 0) ? 'active' : ''; ?>">Smart Planner</a>
        <a href="<?php echo URLROOT; ?>/focus" class="sidebar-link <?php echo (strpos($currentUrl, 'focus') === 0) ? 'active' : ''; ?>">Focus Mode</a>
        <a href="<?php echo URLROOT; ?>/progress" class="sidebar-link <?php echo (strpos($currentUrl, 'progress') === 0) ? 'active' : ''; ?>">Progress</a>
        <a href="<?php echo URLROOT; ?>/users/logout" class="sidebar-link logout-link">Logout</a>
    </nav>
</aside><?php
$currentUrl = $_GET['url'] ?? '';
?>

<aside class="dashboard-sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-logo">SF</div>
        <div>
            <h3>StudyFlow AI</h3>
            <p>Student Panel</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="<?php echo URLROOT; ?>/dashboard" class="sidebar-link <?php echo ($currentUrl == 'dashboard' || $currentUrl == '') ? 'active' : ''; ?>">Dashboard</a>
        <a href="<?php echo URLROOT; ?>/subjects" class="sidebar-link <?php echo (strpos($currentUrl, 'subjects') === 0) ? 'active' : ''; ?>">Subjects</a>
        <a href="<?php echo URLROOT; ?>/tasks" class="sidebar-link <?php echo (strpos($currentUrl, 'tasks') === 0) ? 'active' : ''; ?>">Tasks</a>
        <a href="<?php echo URLROOT; ?>/planner" class="sidebar-link <?php echo (strpos($currentUrl, 'planner') === 0) ? 'active' : ''; ?>">Smart Planner</a>
        <a href="<?php echo URLROOT; ?>/focus" class="sidebar-link <?php echo (strpos($currentUrl, 'focus') === 0) ? 'active' : ''; ?>">Focus Mode</a>
        <a href="<?php echo URLROOT; ?>/progress" class="sidebar-link <?php echo (strpos($currentUrl, 'progress') === 0) ? 'active' : ''; ?>">Progress</a>
        <a href="<?php echo URLROOT; ?>/users/logout" class="sidebar-link logout-link">Logout</a>
    </nav>
</aside>