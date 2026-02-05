<?php
require_once 'includes/init.php';
$pageTitle = "Memberships & Pricing";
include 'includes/header.php';
?>

<!-- Hero Banner -->
<section class="page-section bg-dark text-center pb-5">
    <div class="container pt-5">
        <h6 class="text-primary ls-2 mb-2">Join The Tribe</h6>
        <h1 class="mb-4">Invest In Yourself</h1>
        <p class="text-muted lead mb-4" style="max-width: 600px; margin: 0 auto;">Transparent pricing. No hidden fees. Cancel anytime.</p>
    </div>
</section>

<!-- Pricing Section -->
<section class="page-section">
    <div class="container">
        
        <?php
        $recurring_plans = [];
        $one_off_plans = [];
        
        $sql = "SELECT id, type, price, description FROM memberships ORDER BY price ASC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if (stripos($row['type'], 'Private') !== false || stripos($row['type'], 'Personal') !== false || stripos($row['type'], 'Session') !== false) {
                    $one_off_plans[] = $row;
                } else {
                    $recurring_plans[] = $row;
                }
            }
        }
        ?>

        <!-- recurring Memberships - 3 Col Grid -->
        <div class="row g-0 justify-content-center align-items-stretch">
            <?php if (!empty($recurring_plans)): ?>
                <?php foreach($recurring_plans as $index => $plan): 
                    $is_popular = (stripos($plan['type'], 'Elite') !== false || stripos($plan['type'], 'Unlimited') !== false || $index === 1);
                    $card_class = $is_popular ? 'card-sport border-active scale-up' : 'card-sport';
                    $btn_class = $is_popular ? 'btn-primary' : 'btn-outline';
                ?>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="<?php echo $card_class; ?> text-center h-100 d-flex flex-column p-5" style="<?php echo $is_popular ? 'z-index: 2; border-color: var(--color-primary); background: #0f0f15;' : ''; ?>">
                        <?php if($is_popular): ?>
                            <div class="badge bg-primary position-absolute top-0 start-50 translate-middle-x mt-3">MOST POPULAR</div>
                        <?php endif; ?>
                        
                        <h3 class="mb-3 text-uppercase"><?php echo htmlspecialchars($plan['type']); ?></h3>
                        <div class="display-3 fw-bold text-white mb-2">
                            <span class="fs-4 align-top">$</span><?php echo number_format($plan['price'], 0); ?>
                        </div>
                        <p class="text-muted small mb-4">PER MONTH</p>
                        
                        <ul class="list-unstyled text-start mb-5 mx-auto" style="max-width: 200px;">
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Access to facilities</li>
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Expert coaching</li>
                            <?php if($is_popular): ?>
                                <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Unlimited Classes</li>
                                <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Free Gear Rental</li>
                            <?php endif; ?>
                        </ul>
                        
                        <div class="mt-auto w-100">
                            <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn <?php echo $btn_class; ?> w-100 btn-lg">Choose Plan</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Services Grid (if any) -->
        <?php if (!empty($one_off_plans)): ?>
        <div class="section-header text-center mt-5 pt-5">
            <span class="section-label">PRIVATE TRAINING</span>
            <h3 class="mb-4">Personalized Sessions</h3>
        </div>
        
        <div class="row g-4 justify-content-center">
            <?php foreach($one_off_plans as $plan): ?>
            <div class="col-md-4">
                <div class="card-sport text-center">
                    <h4 class="mb-3"><?php echo htmlspecialchars($plan['type']); ?></h4>
                    <div class="display-5 fw-bold text-white mb-3">
                        $<?php echo number_format($plan['price'], 0); ?>
                    </div>
                    <p class="text-muted mb-4"><?php echo htmlspecialchars($plan['description']); ?></p>
                    <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn btn-outline w-100">Book Session</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- FAQ / Additional Info -->
<section class="page-section bg-dark">
    <div class="container text-center">
        <h3 class="mb-4">Common Questions</h3>
        <div class="row justify-content-center">
            <div class="col-md-8 text-start">
                <div class="mb-4">
                    <h5 class="text-primary mb-2">Do I need experience?</h5>
                    <p class="text-muted">No! We welcome all levels, from complete beginners to pro fighters.</p>
                </div>
                <div class="mb-4">
                    <h5 class="text-primary mb-2">What gear do I need?</h5>
                    <p class="text-muted">For your first class, just bring comfortable athletic wear and a water bottle. We have loaner gear available.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upgrade Modal Logic (Hidden form handling) -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_plan_id']) && isset($_SESSION['user_id'])) {
    // ... logic for upgrade handling would go here or be processed via a separate endpoint ...
    // For now, keeping the display logic clean.
}
?>

<?php include 'includes/footer.php'; ?>
