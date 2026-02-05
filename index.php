<?php
require_once 'includes/init.php';
$pageTitle = "Home";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-inner">
    <p class="section-label">EST. 2026 • AMMAN, JORDAN</p>
    <h1 class="hero-title">
      TRAIN HARD.<br>
      MOVE SMART.<br>
      FIGHT CONFIDENT.
    </h1>
    <p class="hero-subtitle">
      Master Jiu-jitsu, Karate, Muay Thai, and Judo with structured programs,
      expert coaches, and flexible schedules.
    </p>
    <div class="hero-ctas">
      <a href="prices.php" class="btn-primary">See memberships</a>
      <a href="classes_premium.php" class="btn-outline">View timetable</a>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="section">
    <div class="section-inner">
        <div class="text-center mb-5">
            <span class="section-label">WHY CHOOSE US</span>
            <h2 class="section-title">We Build Fighters</h2>
        </div>
        
        <div class="grid-3">
            <div class="card">
                <div class="mb-4 text-center">
                    <i class="bi bi-trophy text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h4 class="text-center">World-Class Instructors</h4>
                <p class="text-muted text-center">Learn from champions who have fought in the ring and won. Real experience, real results.</p>
            </div>
            <div class="card">
                <div class="mb-4 text-center">
                    <i class="bi bi-people text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h4 class="text-center">Strong Community</h4>
                <p class="text-muted text-center">Iron sharpens iron. Train with partners who push you to be your absolute best every single day.</p>
            </div>
            <div class="card">
                <div class="mb-4 text-center">
                    <i class="bi bi-shield-check text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h4 class="text-center">Modern Safety</h4>
                <p class="text-muted text-center">Top-tier mats, sanitized gear, and structured sparring. Train hard without unnecessary injuries.</p>
            </div>
        </div>
    </div>
</section>

<!-- Facilities -->
<section class="section">
    <div class="section-inner">
        <div class="text-center mb-5">
            <span class="section-label">FACILITIES</span>
            <h2 class="section-title">Train Like A Pro</h2>
        </div>
        
        <div class="grid-3">
             <div class="card text-center">
                <i class="bi bi-moisture text-primary mb-3" style="font-size: 2rem;"></i>
                <h5>Sauna & Recovery</h5>
                <p class="text-muted small">Full-size sauna for post-training recovery.</p>
            </div>
            <div class="card text-center">
                <i class="bi bi-heart-pulse text-primary mb-3" style="font-size: 2rem;"></i>
                <h5>Strength Zone</h5>
                <p class="text-muted small">Free weights, squat racks, and cardio.</p>
            </div>
            <div class="card text-center">
                <i class="bi bi-grid-3x3 text-primary mb-3" style="font-size: 2rem;"></i>
                <h5>Pro Mats</h5>
                <p class="text-muted small">High-impact absorption for safety.</p>
            </div>
        </div>
    </div>
</section>

<!-- Instructors Section (Fixed PHP Loop) -->
<section class="section">
  <div class="section-inner">
    <p class="section-label">THE TEAM</p>
    <h2 class="section-title">Meet your coaches</h2>

    <div class="grid-3">
      <?php
      // Check if connection exists, if not use fallback or include config
      if (!isset($conn)) { require_once 'config.php'; }

      // Use prepared statement
      $sql = "SELECT name, specialty, bio, image_url FROM instructors ORDER BY id ASC";
      if ($stmt = $conn->prepare($sql)) {
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $result->num_rows > 0) {
              $imageExtensions = ["jpg", "jpeg", "png", "webp"];

              while ($row = $result->fetch_assoc()) {
                  $instructorName = $row["name"];
                  $imgSrc = "";

                  // Image logic
                  $nameWithHyphens = strtolower(str_replace(' ', '-', $instructorName));
                  foreach ($imageExtensions as $ext) {
                      $filePath = "images/" . $nameWithHyphens . "." . $ext;
                      if (file_exists($filePath)) {
                          $imgSrc = $filePath;
                          break;
                      }
                  }

                  if (empty($imgSrc) && !empty($row["image_url"])) {
                      $imgSrc = htmlspecialchars($row["image_url"]);
                  }
                  
                  // Use placeholder if still empty
                  if (empty($imgSrc)) {
                      $imgSrc = "https://via.placeholder.com/400x300?text=" . urlencode($instructorName);
                  }
                  ?>
                  <article class="card coach-card">
                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($row["name"]); ?>" class="coach-photo">
                    <h3 class="coach-name">
                      <?php echo htmlspecialchars($row["name"]); ?>
                    </h3>
                    <p class="coach-role">
                      <?php echo htmlspecialchars($row["specialty"]); ?>
                    </p>
                    <p class="coach-meta">
                      <?php echo htmlspecialchars($row["bio"]); ?>
                    </p>
                  </article>
                  <?php
              }
          } else {
              // Static fallback if DB is empty or fails
              ?>
              <article class="card coach-card">
                  <div class="coach-photo" style="background: #333;"></div>
                  <h3 class="coach-name">Sensei Hani</h3>
                  <p class="coach-role">Head Instructor</p>
                  <p class="coach-meta">Specializes in technical striking and fight IQ.</p>
              </article>
              <article class="card coach-card">
                   <div class="coach-photo" style="background: #333;"></div>
                  <h3 class="coach-name">Coach Sarah</h3>
                  <p class="coach-role">Muay Thai</p>
                  <p class="coach-meta">Active competitor focused on clinch work.</p>
              </article>
              <article class="card coach-card">
                   <div class="coach-photo" style="background: #333;"></div>
                  <h3 class="coach-name">Coach Mike</h3>
                  <p class="coach-role">Wrestling</p>
                  <p class="coach-meta">Former D1 wrestler turning grapplers into fighters.</p>
              </article>
              <?php
          }

          $stmt->close();
      }
      ?>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="section text-center" style="background: linear-gradient(rgba(5,5,9,0.9), rgba(5,5,9,0.9)), url('images/cta-bg.jpg') center/cover;">
    <div class="section-inner">
        <h2 class="section-title">START YOUR LEGACY</h2>
        <p class="text-muted mb-5" style="max-width: 600px; margin: 0 auto 2rem;">First class is on us. Come see what you're made of.</p>
        <a href="signup.php" class="btn-primary">Join The Tribe</a>
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
