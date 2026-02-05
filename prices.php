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
    
    <!-- SEO -->
    <meta name="description" content="Affordable martial arts memberships in Amman. Choose from Basic, Intermediate, and Advanced plans. No hidden fees.">
    
    <!-- Assets -->
    <link rel="icon" href="images/favicon.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/sport-theme.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <!-- Hero -->
    <section class="section text-center inner-hero" style="padding-top: 140px; padding-bottom: 4rem;">
        <div class="container animate-in">
            <span class="section-label">MEMBERSHIPS</span>
            <h1 class="section-title mb-3">INVEST IN YOURSELF</h1>
            <p style="max-width: 600px; margin: 0 auto 2rem;">Transparent pricing. No hidden fees. Cancel anytime.</p>
        </div>
    </section>

    <!-- Plans -->
    <section class="section pt-0 fade-in-up">
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
                    <?php if($is_popular): ?>
                        <div class="text-accent mb-2" style="font-size: 0.8rem; letter-spacing: 2px; font-weight: bold;">MOST POPULAR</div>
                    <?php endif; ?>
                    
                    <h3 class="card-title <?php echo $is_popular ? 'text-accent' : ''; ?>"><?php echo htmlspecialchars($plan['type']); ?></h3>
                    <div class="price">$<?php echo number_format($plan['price'], 0); ?><span>/mo</span></div>
                    <p class="card-text mb-4"><?php echo htmlspecialchars($plan['description']); ?></p>
                    <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn <?php echo $is_popular ? 'btn-primary' : 'btn-outline'; ?> w-100 mt-auto">Select Plan</a>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Private/One-off Grid -->
             <?php if (!empty($one_off_plans)): ?>
                <div class="text-center mb-5 mt-5 pt-5 border-top border-subtle">
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

    <?php include 'includes/footer_new.php'; ?>

</body>
</html>
