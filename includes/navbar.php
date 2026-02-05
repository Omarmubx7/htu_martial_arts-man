<!-- Navbar Include -->
<nav class="navbar">
    <div class="container nav-container">
        <a href="index.php" class="nav-logo">HTU MARTIAL ARTS</a>
        
        <!-- Toggle for Mobile -->
        <button class="menu-toggle" onclick="document.querySelector('.nav-links').classList.toggle('active')">
            <i class="bi bi-list"></i>
        </button>

        <div class="nav-links">
            <!-- Close btn for mobile (optional ui) -->
            <a href="index.php" class="nav-link <?php echo ($pageTitle ?? '') === 'Home' ? 'active' : ''; ?>">Home</a>
            <a href="classes_premium.php" class="nav-link <?php echo ($pageTitle ?? '') === 'Class Timetable' ? 'active' : ''; ?>">Classes</a>
            <a href="prices.php" class="nav-link <?php echo ($pageTitle ?? '') === 'Memberships' ? 'active' : ''; ?>">Memberships</a>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="nav-link">Dashboard</a>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-link <?php echo ($pageTitle ?? '') === 'Login' ? 'active' : ''; ?>">Login</a>
            <?php endif; ?>
            
            <a href="signup.php" class="btn btn-primary btn-sm">Join Now</a>
        </div>
    </div>
</nav>
