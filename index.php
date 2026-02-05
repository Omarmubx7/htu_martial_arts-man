<?php
require_once 'includes/init.php';
$pageTitle = "Home";
include 'includes/header.php';
?>

<!-- ============================================== -->
<!-- HERO SECTION - Main landing page banner -->
<!-- ============================================== -->
<!-- style="background: linear-gradient" creates the blue gradient background -->
<!-- style="min-height: 90vh" makes section take up most of viewport -->
<!-- style="display: flex; align-items: center" vertically centers the content -->
<!-- ============================================== -->
<!-- HERO SECTION -->
<!-- ============================================== -->
<section class="hero-sports">
    <div class="container">
        <div class="hero-content">
            <span class="text-primary fw-bold text-uppercase ls-2 mb-2 d-block">Est. 2026 • Amman, Jordan</span>
            <h1 class="mb-4">Train Hard.<br>Move Smart.<br><span class="text-primary">Fight Confident.</span></h1>
            <p class="lead mb-5 text-muted" style="max-width: 600px;">Master Jiu-jitsu, Karate, and Muay Thai with structured programs, expert guidance, and flexible schedules.</p>
            
            <div class="d-flex gap-3 flex-wrap">
                <a href="#plans" class="btn btn-primary">See Memberships</a>
                <a href="classes_premium.php" class="btn btn-outline">View Timetable</a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- FEATURES SECTION -->
<!-- ============================================== -->
<section class="page-section bg-dark">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary ls-2 mb-2">Why Choose Us</h6>
            <h2>Elevate Your Game</h2>
        </div>
        
        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="mb-4">
                        <i class="bi bi-trophy text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4>World-Class Coaches</h4>
                    <p class="text-muted">Learn from certified instructors with competitive backgrounds and years of teaching experience.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="mb-4">
                        <i class="bi bi-clock-history text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4>Flexible Schedule</h4>
                    <p class="text-muted">Morning, evening, and weekend classes designed to fit your busy lifestyle.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="mb-4">
                        <i class="bi bi-building text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4>Modern Facility</h4>
                    <p class="text-muted">Train in a clean, fully-equipped gym with premium mats, sauna, and strength area.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- FACILITIES SECTION -->
<!-- ============================================== -->
<section class="page-section">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary ls-2 mb-2">The Gym</h6>
            <h2>Premium Facilities</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center border-0">
                    <div class="mb-3">
                        <i class="bi bi-moisture text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5>Sauna & Recovery</h5>
                    <p class="text-muted small">Full-size sauna for post-training recovery.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0">
                    <div class="mb-3">
                        <i class="bi bi-heart-pulse text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5>Strength Zone</h5>
                    <p class="text-muted small">Free weights, squat racks, and cardio.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0">
                    <div class="mb-3">
                        <i class="bi bi-grid-3x3 text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h5>Pro Mats</h5>
                    <p class="text-muted small">High-impact absorption for safety.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- INSTRUCTORS SECTION -->
<!-- ============================================== -->
<section class="page-section bg-dark">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary ls-2 mb-2">The Team</h6>
            <h2>Meet Your Coaches</h2>
        </div>
        <div class="row g-4">
            <?php
            $stmt = $conn->prepare("SELECT id, name, specialty, bio FROM instructors");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    // Image logic same as before but wrapped in new layout
                    $instructorName = trim($row["name"]);
                    $imageExtensions = ['png', 'jpg', 'jpeg', 'webp'];
                    $imgSrc = '';
                    foreach ($imageExtensions as $ext) {
                        $filePath = "images/" . $instructorName . "." . $ext;
                        if (file_exists($filePath)) { $imgSrc = $filePath; break; }
                    }
                    if (empty($imgSrc)) {
                        $nameWithHyphens = strtolower(str_replace(' ', '-', $instructorName));
                        foreach ($imageExtensions as $ext) {
                            $filePath = "images/" . $nameWithHyphens . "." . $ext;
                            if (file_exists($filePath)) { $imgSrc = $filePath; break; }
                        }
                    }
                    if (empty($imgSrc) && !empty($row["image_url"])) { $imgSrc = htmlspecialchars($row["image_url"]); }
                    
                    echo '  <div class="card h-100 p-0 overflow-hidden text-start">';
                    echo '    <div style="aspect-ratio: 1/1; overflow: hidden;">';
                    if (!empty($imgSrc)) {
                        echo '      <img src="' . $imgSrc . '" loading="lazy" alt="' . htmlspecialchars($row["name"]) . '" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">';
                    } else {
                        echo '      <div class="bg-dark d-flex align-items-center justify-content-center h-100 text-muted"><i class="bi bi-person-fill display-4"></i></div>';
                    }
                    echo '    </div>';
                    echo '    <div class="p-4">';
                    echo '      <h5 class="mb-1">' . htmlspecialchars($row["name"]) . '</h5>';
                    echo '      <p class="text-primary small fw-bold text-uppercase mb-3">' . htmlspecialchars($row["specialty"]) . '</p>';
                    echo '      <p class="text-muted small mb-0">' . htmlspecialchars($row["bio"]) . '</p>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else { echo '<div class="col-12 text-center text-muted">Instructors loading...</div>'; }
            $stmt->close();
            ?>
        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- MEMBERSHIPS SECTION (ID="plans") -->
<!-- ============================================== -->
<section id="plans" class="page-section">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary ls-2 mb-2">Join The Tribe</h6>
            <h2>Start Training Today</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $stmt_plans = $conn->prepare("SELECT id, type, price, description FROM memberships WHERE type NOT LIKE '%Private%' AND type NOT LIKE '%Personal%' LIMIT 3");
            $stmt_plans->execute();
            $result = $stmt_plans->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
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
