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
