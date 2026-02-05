<?php
require_once 'includes/init.php';
$pageTitle = "Memberships";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | HTU Martial Arts</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/sport-theme.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="nav-logo">HTU MARTIAL ARTS</a>
            <div class="nav-links">
                <a href="index.php" class="nav-link">Home</a>
                <a href="classes_premium.php" class="nav-link">Classes</a>
                <a href="prices.php" class="nav-link text-accent">Memberships</a>
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

    <!-- Hero -->
    <section class="section text-center" style="padding-top: 120px; padding-bottom: 4rem;">
        <div class="container">
            <span class="section-label">MEMBERSHIPS</span>
            <h1 class="section-title mb-3">INVEST IN YOURSELF</h1>
            <p style="max-width: 600px; margin: 0 auto 2rem;">Transparent pricing. No hidden fees. Cancel anytime.</p>
        </div>
    </section>

    <!-- Plans -->
    <section class="section pt-0">
        <div class="container">
            
            <?php
            $recurring_plans = [];
            $one_off_plans = [];
            
            $sql = "SELECT id, type, price, description FROM memberships ORDER BY price ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if (stripos($row['type'], 'Private') !== false || stripos($row['type'], 'Personal') !== false || stripos($row['type'], 'Session') !== false) {
                        $one_off_plans[] = $row;
                    } else {
                        $recurring_plans[] = $row;
                    }
                }
            }
            ?>

            <!-- Recurring Grid -->
            <div class="grid grid-3 mb-5">
                <?php foreach($recurring_plans as $index => $plan): 
                    $is_popular = (stripos($plan['type'], 'Intermediate') !== false || $index === 1);
                ?>
                <div class="card price-card <?php echo $is_popular ? 'featured' : ''; ?>">
                    <h3 class="card-title <?php echo $is_popular ? 'text-accent' : ''; ?>"><?php echo htmlspecialchars($plan['type']); ?></h3>
                    <div class="price">$<?php echo number_format($plan['price'], 0); ?><span>/mo</span></div>
                    <p class="card-text mb-4"><?php echo htmlspecialchars($plan['description']); ?></p>
                    <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn <?php echo $is_popular ? 'btn-primary' : 'btn-outline'; ?> w-100 mt-auto">Select Plan</a>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Private/One-off Grid -->
             <?php if (!empty($one_off_plans)): ?>
                <div class="text-center mb-5 mt-5">
                    <span class="section-label">PRIVATE TRAINING</span>
                    <h2 class="section-title" style="font-size: 2rem;">PERSONALIZED SESSIONS</h2>
                </div>
                <div class="grid grid-3">
                    <?php foreach($one_off_plans as $plan): ?>
                    <div class="card price-card">
                        <h3 class="card-title"><?php echo htmlspecialchars($plan['type']); ?></h3>
                        <div class="price">$<?php echo number_format($plan['price'], 0); ?><span>/session</span></div>
                        <p class="card-text mb-4"><?php echo htmlspecialchars($plan['description']); ?></p>
                        <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn btn-outline w-100 mt-auto">Book Session</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

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
            </div>
        </div>
    </footer>

</body>
</html>
