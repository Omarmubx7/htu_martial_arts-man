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
            <h2 class="section-title">TRAIN LIKE A PRO</h2>
            
            <div class="grid grid-3">
                <div class="card">
                    <div class="mb-4 text-accent"><i class="bi bi-droplet" style="font-size: 2rem;"></i></div>
                    <h3 class="card-title">Sauna & Recovery</h3>
                    <p class="card-text">Full-size sauna for post-training recovery.</p>
                </div>
                <div class="card">
                    <div class="mb-4 text-accent"><i class="bi bi-heart-pulse" style="font-size: 2rem;"></i></div>
                    <h3 class="card-title">Strength Zone</h3>
                    <p class="card-text">Free weights, squat racks, and cardio.</p>
                </div>
                <div class="card">
                    <div class="mb-4 text-accent"><i class="bi bi-layers" style="font-size: 2rem;"></i></div>
                    <h3 class="card-title">Pro Mats</h3>
                    <p class="card-text">High-impact absorption for safety.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- The Team -->
    <section class="section">
        <div class="container">
            <span class="section-label">THE TEAM</span>
            <h2 class="section-title">MEET YOUR COACHES</h2>
            
            <div class="grid grid-4">
                <!-- Coach 1 -->
                <div class="card">
                    <div class="coach-img" style="background-image: url('images/Ali%20Mohammed.png'); background-position: top;"></div>
                    <h3 class="card-title">Ali Mohammed</h3>
                    <p class="section-label">Head Coach</p>
                    <p class="card-text">Gym owner & head martial arts coach.</p>
                </div>
                <!-- Coach 2 -->
                <div class="card">
                    <div class="coach-img" style="background-image: url('images/Sarah%20Saleh.png'); background-position: top;"></div>
                    <h3 class="card-title">Sarah Saleh</h3>
                    <p class="section-label">Karate</p>
                    <p class="card-text">Assistant coach, 5th Dan Karate.</p>
                </div>
                <!-- Coach 3 -->
                <div class="card">
                    <div class="coach-img" style="background-image: url('images/Fares%20Qasem.png'); background-position: top;"></div>
                    <h3 class="card-title">Fares Qasem</h3>
                    <p class="section-label">Jiu-Jitsu / Muay Thai</p>
                    <p class="card-text">2nd Dan BJJ, 1st Dan Judo.</p>
                </div>
                <!-- Coach 4 -->
                <div class="card">
                    <div class="coach-img" style="background-image: url('images/Maen%20Mohanad.png'); background-position: top;"></div>
                    <h3 class="card-title">Maen Mohanad</h3>
                    <p class="section-label">Karate</p>
                    <p class="card-text">Assistant coach, 3rd Dan Karate.</p>
                </div>
                 <!-- Coach 5 -->
                 <div class="card">
                    <div class="coach-img" style="background-image: url('images/Reem%20Emad.png'); background-position: top;"></div>
                    <h3 class="card-title">Reem Emad</h3>
                    <p class="section-label">Shotokan</p>
                    <p class="card-text">Kata & Self-defence specialist.</p>
                </div>
                 <!-- Coach 6 -->
                 <div class="card">
                    <div class="coach-img" style="background-image: url('images/Jana%20Qader.png'); background-position: top;"></div>
                    <h3 class="card-title">Jana Qader</h3>
                    <p class="section-label">Fitness</p>
                    <p class="card-text">BSc Physiotherapy, MSc Sports Science.</p>
                </div>
                 <!-- Coach 7 -->
                 <div class="card">
                    <div class="coach-img" style="background-image: url('images/Omar%20Mubaidin.png'); background-position: top;"></div>
                    <h3 class="card-title">Omar Mubaidin</h3>
                    <p class="section-label">S&C Coach</p>
                    <p class="card-text">Strength & conditioning specialist helping fighters build power.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Your Legacy -->
    <section class="section text-center" style="background: linear-gradient(180deg, var(--bg-body) 0%, #1a1a2e 100%);">
        <div class="container">
            <h2 class="section-title">START YOUR LEGACY</h2>
            <p style="max-width: 600px; margin: 0 auto 2rem;">First class is on us. Come see what you're made of.</p>
            <a href="signup.php" class="btn btn-primary">JOIN THE TRIBE</a>
        </div>
    </section>

    <!-- Pricing Strip -->
    <section class="section">
        <div class="container">
            <span class="section-label">MEMBERSHIPS</span>
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="section-title mb-0">START TRAINING TODAY</h2>
                <a href="prices.php" class="btn btn-outline">View All Options</a>
            </div>
            
            <div class="grid grid-3">
                <!-- Basic -->
                <div class="card price-card">
                    <h3 class="card-title">BASIC</h3>
                    <div class="price">$25<span>/mo</span></div>
                    <p class="card-text">1 Martial Art • 2 Sessions/Week</p>
                    <a href="signup.php?plan_id=1" class="btn btn-outline w-100 mt-4">Select Plan</a>
                </div>
                <!-- Intermediate -->
                <div class="card price-card featured">
                    <h3 class="card-title text-accent">INTERMEDIATE</h3>
                    <div class="price">$35<span>/mo</span></div>
                    <p class="card-text">1 Martial Art • 3 Sessions/Week</p>
                    <a href="signup.php?plan_id=2" class="btn btn-primary w-100 mt-4">Select Plan</a>
                </div>
                <!-- Advanced -->
                <div class="card price-card">
                    <h3 class="card-title">ADVANCED</h3>
                    <div class="price">$45<span>/mo</span></div>
                    <p class="card-text">Any 2 Arts • 5 Sessions/Week</p>
                    <a href="signup.php?plan_id=3" class="btn btn-outline w-100 mt-4">Select Plan</a>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Final CTA -->
    <section class="section text-center">
        <div class="container">
            <span class="section-label">READY TO BEGIN?</span>
            <h2 class="section-title">CREATE YOUR ACCOUNT</h2>
            <a href="signup.php" class="btn btn-primary">Sign Up Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container d-flex justify-content-between align-items-center flex-column flex-md-row">
            <div class="mb-4 mb-md-0">
                <h4 class="mb-2">HTU MARTIAL ARTS</h4>
                <p class="mb-0 text-muted">© 2026 HTU Martial Arts. All Rights Reserved.</p>
            </div>
            <div class="d-flex flex-column align-items-center align-items-md-end">
                <div class="footer-links mb-2">
                    <a href="index.php">Home</a>
                    <a href="classes_premium.php">Classes</a>
                    <a href="prices.php">Memberships</a>
                    <a href="login.php">Login</a>
                </div>
                <p class="text-muted small">HTU, Amman, Jordan</p>
            </div>
        </div>
    </footer>

</body>
</html>
