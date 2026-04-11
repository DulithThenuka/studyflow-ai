<nav class="navbar">
    <div class="container nav-container">
        <a href="<?php echo URLROOT; ?>" class="logo">
            <span class="logo-mark">S</span>
            <span class="logo-text">StudyFlow AI</span>
        </a>

        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-links" id="navLinks">
            <a href="<?php echo URLROOT; ?>">Home</a>
            <a href="<?php echo URLROOT; ?>/home/about">About</a>
            <a href="<?php echo URLROOT; ?>/home/features">Features</a>
            <a href="<?php echo URLROOT; ?>/home/contact">Contact</a>

            <?php if (isLoggedIn()) : ?>
                <a href="<?php echo URLROOT; ?>/dashboard" class="btn btn-outline">Dashboard</a>
                <a href="<?php echo URLROOT; ?>/profile" class="btn btn-outline">Profile</a>
                <a href="<?php echo URLROOT; ?>/users/logout" class="btn btn-primary">Logout</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline">Login</a>
                <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary">Get Started</a>
            <?php endif; ?>
        </div>
    </div>
</nav>