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
                // heuristic to separate plans
                if (stripos($row['type'], 'Private') !== false || stripos($row['type'], 'Personal') !== false || stripos($row['type'], 'Session') !== false) {
                    $one_off_plans[] = $row;
                } else {
                    $recurring_plans[] = $row;
                }
            }
        }
        ?>

        <!-- Memberships Grid -->
        <h3 class="text-center mb-5">Recurring Memberships</h3>
        <div class="row g-4 justify-content-center mb-5">
            <?php if (!empty($recurring_plans)): ?>
                <?php foreach($recurring_plans as $plan): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center hover-card d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column flex-grow-1">
                            <h4 class="mb-3"><?php echo htmlspecialchars($plan['type']); ?></h4>
                            <div class="display-5 fw-bold text-primary mb-3">
                                $<?php echo number_format($plan['price'], 0); ?><span class="fs-6 text-muted fw-normal">/mo</span>
                            </div>
                            <p class="text-muted mb-4"><?php echo htmlspecialchars($plan['description']); ?></p>
                            
                            <div class="mt-auto w-100">
                                <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn btn-primary w-100">Choose Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted">No memberships available.</div>
            <?php endif; ?>
        </div>

        <!-- Services Grid (if any) -->
        <?php if (!empty($one_off_plans)): ?>
        <h3 class="text-center mb-5 pt-5 border-top border-dark">Private Training & Services</h3>
        <div class="row g-4 justify-content-center">
            <?php foreach($one_off_plans as $plan): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 text-center hover-card">
                    <div class="card-body p-4">
                        <h4 class="mb-3"><?php echo htmlspecialchars($plan['type']); ?></h4>
                        <div class="display-5 fw-bold text-primary mb-3">
                            $<?php echo number_format($plan['price'], 0); ?>
                        </div>
                        <p class="text-muted mb-4"><?php echo htmlspecialchars($plan['description']); ?></p>
                        <a href="signup.php?plan_id=<?php echo $plan['id']; ?>" class="btn btn-outline w-100">Book Session</a>
                    </div>
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
