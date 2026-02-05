<?php
require_once 'includes/init.php';
$pageTitle = "Class Timetable";
include 'includes/header.php';
?>


<!-- Hero Banner -->
<section class="page-section bg-dark text-center pb-5">
    <div class="container pt-5">
        <h6 class="text-primary ls-2 mb-2">Schedule</h6>
        <h1 class="mb-4">Your Week. Your Rules.</h1>
        <p class="text-muted lead mb-4" style="max-width: 500px; margin: 0 auto;">Train when you want. Choose what fits your life.</p>
        <button class="btn btn-primary" onclick="document.querySelector('.schedule-section').scrollIntoView({behavior: 'smooth'})">View Timetable</button>
    </div>
</section>

<!-- Schedule Section -->
<section class="schedule-section page-section">
    <div class="container">
        
        <!-- Filter Buttons -->
        <div class="schedule-filters d-flex flex-wrap justify-content-center gap-2 mb-5">
            <button class="btn btn-outline active" data-filter="all">All Classes</button>
            <button class="btn btn-outline" data-filter="jiu-jitsu">Jiu-jitsu</button>
            <button class="btn btn-outline" data-filter="karate">Karate</button>
            <button class="btn btn-outline" data-filter="judo">Judo</button>
            <button class="btn btn-outline" data-filter="muay-thai">Muay Thai</button>
            <button class="btn btn-outline" data-filter="kids">Kids Classes</button>
        </div>
        
        <!-- Class Grid -->
        <div class="row g-4 schedule-grid">
            <?php
            // SECURITY: Use prepared statement even without parameters for consistency against injection
            $sql = "SELECT id, class_name, day_of_week, start_time, end_time, martial_art, age_group, is_kids_class 
                FROM classes 
                ORDER BY FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), start_time";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0):
            while($class = $result->fetch_assoc()):
                // Check access if user is logged in
                $access_check = ['can_book' => false, 'reason' => 'Login to book'];
                
                if (isset($_SESSION['user_id'])) {
                    // SECURITY: Passing validated fields to access checker
                    $access_check = canUserBookClass(
                        $_SESSION['user_id'], 
                        $class['martial_art'],
                        ($class['is_kids_class'] == 1),
                        $class['class_name']
                    );
                }
                
                $locked_class = $access_check['can_book'] ? '' : 'locked';
                $class_filter = strtolower(str_replace(' ', '-', $class['martial_art']));
                if ($class['is_kids_class'] == 1) { $class_filter = 'kids'; }
            ?>
                <!-- Class Card -->
                <div class="col-md-6 col-lg-4 class-slot <?php echo htmlspecialchars($locked_class, ENT_QUOTES, 'UTF-8'); ?>" 
                     data-art="<?php echo htmlspecialchars($class_filter, ENT_QUOTES, 'UTF-8'); ?>"
                     data-kids="<?php echo ($class['is_kids_class'] == 1) ? 'kids' : 'adult'; ?>">
                     
                    <div class="card h-100 text-center hover-card">
                        <div class="mb-3">
                            <?php if($class['is_kids_class']): ?>
                                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Kids</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Adults</span>
                            <?php endif; ?>
                        </div>
                        
                        <h4 class="mb-1"><?php echo htmlspecialchars($class['class_name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                        <p class="text-primary fw-bold mb-3"><?php echo htmlspecialchars($class['day_of_week'], ENT_QUOTES, 'UTF-8'); ?></p>
                        
                        <div class="py-3 border-top border-bottom border-dark my-3">
                            <i class="bi bi-clock me-2 text-primary"></i>
                            <span class="text-muted">
                                <?php echo htmlspecialchars(date('g:i A', strtotime($class['start_time'])) . ' - ' . date('g:i A', strtotime($class['end_time'])), ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </div>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php if ($access_check['can_book']): ?>
                                <button class="btn btn-primary w-100" onclick="validateBooking(<?php echo (int)$class['id']; ?>, '<?php echo htmlspecialchars($class['class_name'], ENT_QUOTES, 'UTF-8'); ?>', event)">
                                    Book Now
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>
                                    <?php echo strlen($access_check['reason']) > 25 ? 'Restricted' : htmlspecialchars($access_check['reason'], ENT_QUOTES, 'UTF-8'); ?>
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-outline w-100">Login to Book</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; else: ?>
                <div class="col-12 text-center text-muted">No classes scheduled yet. Please check back soon.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="cta-banner page-section bg-dark border-top border-secondary text-center">
    <div class="container">
        <h2 class="mb-4">Ready to Level Up?</h2>
        <p class="text-muted lead mb-4">Upgrade to Elite for unlimited access to all classes.</p>
        <a href="prices.php" class="btn btn-primary">View Plans</a>
    </div>
</section>


<?php include 'includes/footer.php'; ?>
