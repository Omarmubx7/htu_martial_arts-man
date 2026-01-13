<?php
require_once 'includes/init.php';
http_response_code(404);
$pageTitle = "Page Not Found";
include 'includes/header.php';
?>

<section class="page-section text-center" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <h1 class="display-1 fw-bold text-primary mb-4">404</h1>
        <h2 class="mb-4">Page Not Found</h2>
        <p class="lead mb-5">The page you're looking for doesn't exist or has been moved.</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="index.php" class="btn btn-primary btn-lg"><i class="bi bi-house-door me-2"></i>Return Home</a>
            <a href="classes_premium.php" class="btn btn-outline-primary btn-lg"><i class="bi bi-calendar-week me-2"></i>View Classes</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
