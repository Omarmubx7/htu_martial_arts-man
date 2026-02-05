<?php
// index.php
session_start();
include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTU Martial Arts | Train Hard. Fight Confident.</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/sport-theme.css">
</head>
<body>

    <!-- Navigation (Mubx Style) -->
    <nav class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="nav-logo">HTU MARTIAL ARTS</a>
            <div class="nav-links">
                <a href="index.php" class="nav-link text-accent">Home</a>
                <a href="classes_premium.php" class="nav-link">Classes</a>
                <a href="prices.php" class="nav-link">Memberships</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                    <a href="logout.php" class="nav-link">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Login</a>
                <?php endif; ?>
                <a href="signup.php" class="btn btn-primary btn-sm">Join Now</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content animate-in">
                <span class="section-label">EST. 2026 - AMMAN, JORDAN</span>
                <h1 class="hero-title">
                    TRAIN HARD.<br>
                    MOVE SMART.<br>
                    <span class="text-accent">FIGHT CONFIDENT.</span>
                </h1>
                <p class="hero-subtitle">
                    Master Jiu-jitsu, Karate, Muay Thai, and Judo with structured programs, expert coaches, and flexible schedules.
                </p>
                <div class="d-flex gap-2">
                    <a href="prices.php" class="btn btn-primary">See Memberships</a>
                    <a href="classes_premium.php" class="btn btn-outline">View Timetable</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section">
        <div class="container">
            <span class="section-label">WHY CHOOSE US</span>
            <h2 class="section-title">WE BUILD FIGHTERS</h2>
            
            <div class="grid grid-3">
                <div class="card">
                    <div class="mb-4 text-accent"><i class="bi bi-trophy" style="font-size: 2rem;"></i></div>
                    <h3 class="card-title">World-Class Instructors</h3>
                    <p class="card-text">Learn from champions who have fought in the ring and won. Real experience, real results.</p>
                </div>
                <div class="card">
                    <div class="mb-4 text-accent"><i class="bi bi-people" style="font-size: 2rem;"></i></div>
                    <h3 class="card-title">Strong Community</h3>
                    <p class="card-text">Iron sharpens iron. Train with partners who push you to be your absolute best every single day.</p>
                </div>
                <div class="card">
                    <div class="mb-4 text-accent"><i class="bi bi-shield-check" style="font-size: 2rem;"></i></div>
                    <h3 class="card-title">Modern Safety</h3>
                    <p class="card-text">Top-tier mats, sanitized gear, and structured sparring. Train hard without unnecessary injuries.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities -->
    <section class="section">
        <div class="container">
            <span class="section-label">FACILITIES</span>
                    echo '  <div class="card h-100 text-center">';
                    echo '      <h5 class="mb-2">' . htmlspecialchars($row['type']) . '</h5>';
                    echo '      <div class="display-5 fw-bold text-primary mb-3">$' . number_format($row['price'], 0) . '</div>';
                    echo '      <p class="text-muted mb-4 small">' . htmlspecialchars($row['description']) . '</p>';
                    echo '      <a href="signup.php?plan_id=' . intval($row['id']) . '" class="btn btn-outline w-100">Choose Plan</a>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
            $stmt_plans->close();
            ?>
        </div>
        <div class="text-center mt-5">
            <a href="prices.php" class="btn btn-primary">View All Membership Options</a>
        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- CTA SECTION -->
<!-- ============================================== -->
<section class="py-5 bg-dark border-top border-secondary">
    <div class="container text-center">
        <h2 class="mb-4">Ready to Begin?</h2>
        <a href="signup.php" class="btn btn-primary">Create Your Account</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
