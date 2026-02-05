<?php
require_once 'includes/init.php';
$pageTitle = "Class Timetable";
// Minimal navigation consistent with index.php
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
                <a href="classes_premium.php" class="nav-link text-accent">Classes</a>
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

    <!-- Hero -->
    <section class="section text-center" style="padding-top: 120px; padding-bottom: 4rem;">
        <div class="container">
            <span class="section-label">SCHEDULE</span>
            <h1 class="section-title mb-3">YOUR WEEK. YOUR RULES.</h1>
            <p style="max-width: 600px; margin: 0 auto 2rem;">Train when you want. Choose what fits your life.</p>
        </div>
    </section>

    <!-- Schedule -->
    <section class="section pt-0">
        <div class="container">
            
            <!-- Filters -->
            <div class="d-flex justify-content-center gap-2 mb-5 flex-wrap" id="schedule-filters">
                <button class="btn btn-outline active" data-filter="all">All Classes</button>
                <button class="btn btn-outline" data-filter="jiu-jitsu">Jiu-jitsu</button>
                <button class="btn btn-outline" data-filter="karate">Karate</button>
                <button class="btn btn-outline" data-filter="judo">Judo</button>
                <button class="btn btn-outline" data-filter="muay-thai">Muay Thai</button>
                <button class="btn btn-outline" data-filter="kids">Kids</button>
            </div>

            <div class="grid grid-3" id="schedule-grid">
                <?php
                // Logic preservation
                $sql = "SELECT id, class_name, day_of_week, start_time, end_time, martial_art, age_group, is_kids_class 
                    FROM classes 
                    ORDER BY FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), start_time";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0):
                    while($class = $result->fetch_assoc()):
                        // Access Logic
                        $access_check = ['can_book' => false, 'reason' => 'Login to book'];
                        if (isset($_SESSION['user_id'])) {
                            $access_check = canUserBookClass(
                                $_SESSION['user_id'], 
                                $class['martial_art'],
                                ($class['is_kids_class'] == 1),
                                $class['class_name']
                            );
                        }
                        
                        $class_filter = strtolower(str_replace(' ', '-', $class['martial_art']));
                        if ($class['is_kids_class'] == 1) { $class_filter = 'kids'; }
                ?>
                    <!-- Class Card -->
                    <div class="card class-item" data-art="<?php echo htmlspecialchars($class_filter); ?>">
                        <div class="mb-3 d-flex justify-content-between align-items-start">
                            <span class="text-accent fw-bold"><?php echo htmlspecialchars($class['day_of_week']); ?></span>
                            <?php if($class['is_kids_class']): ?>
                                <span class="badge bg-warning text-dark" style="font-size: 0.75rem; padding: 4px 8px; border-radius: 4px;">Kids</span>
                            <?php else: ?>
                                <span class="badge" style="background: #333; font-size: 0.75rem; padding: 4px 8px; border-radius: 4px;">Adults</span>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="card-title mb-1"><?php echo htmlspecialchars($class['class_name']); ?></h3>
                        <p class="text-muted small mb-4">
                            <i class="bi bi-clock me-1"></i>
                            <?php echo date('g:i A', strtotime($class['start_time'])) . ' - ' . date('g:i A', strtotime($class['end_time'])); ?>
                        </p>

                        <div class="mt-auto">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <?php if ($access_check['can_book']): ?>
                                    <button class="btn btn-primary w-100 btn-sm" onclick="validateBooking(<?php echo (int)$class['id']; ?>, '<?php echo htmlspecialchars($class['class_name'], ENT_QUOTES, 'UTF-8'); ?>', event)">
                                        Book Now
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-outline w-100 btn-sm" disabled style="opacity: 0.5; cursor: not-allowed;">
                                        <?php echo htmlspecialchars($access_check['reason']); ?>
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-outline w-100 btn-sm">Login to Book</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
            
            <?php if (!$result || $result->num_rows === 0): ?>
                <div class="text-center text-muted">No classes scheduled yet.</div>
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

    <!-- Filter Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('#schedule-filters button');
        const cards = document.querySelectorAll('.class-item');

        filters.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class
                filters.forEach(f => {
                    f.classList.remove('active');
                    f.classList.remove('btn-primary');
                    f.classList.add('btn-outline');
                });
                
                // Add active class
                btn.classList.add('active');
                btn.classList.remove('btn-outline');
                btn.classList.add('btn-primary');

                const filterValue = btn.getAttribute('data-filter');

                cards.forEach(card => {
                    if (filterValue === 'all' || card.getAttribute('data-art') === filterValue) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });

    // Booking function stub (if not defined elsewhere)
    if (typeof validateBooking !== 'function') {
        function validateBooking(classId, className, event) {
            if(confirm('Book ' + className + '?')) {
                // Logic to handle booking
                alert('Booking feature would process here.');
            }
        }
    }
    </script>
</body>
</html>
