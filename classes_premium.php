<?php
require_once 'includes/init.php';
$pageTitle = "Class Timetable";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | HTU Martial Arts</title>
    
    <!-- SEO -->
    <meta name="description" content="View our weekly martial arts schedule. Jiu-jitsu, Karate, Muay Thai, and Judo classes for all levels in Amman.">
    
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
            <span class="section-label">SCHEDULE</span>
            <h1 class="section-title mb-3">YOUR WEEK. YOUR RULES.</h1>
            <p style="max-width: 600px; margin: 0 auto 2rem;">Train when you want. Choose what fits your life.</p>
        </div>
    </section>

    <!-- Schedule -->
    <section class="section pt-0 fade-in-up">
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

    <?php include 'includes/footer_new.php'; ?>

    <!-- Filter Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('#schedule-filters button');
        const cards = document.querySelectorAll('.class-item');

        filters.forEach(btn => {
            btn.addEventListener('click', () => {
                filters.forEach(f => {
                    f.classList.remove('active');
                    f.classList.remove('btn-primary');
                    f.classList.add('btn-outline');
                });
                
                btn.classList.add('active');
                btn.classList.remove('btn-outline');
                btn.classList.add('btn-primary');

                const filterValue = btn.getAttribute('data-filter');

                cards.forEach(card => {
                    if (filterValue === 'all' || card.getAttribute('data-art') === filterValue) {
                        card.style.display = 'flex';
                        card.classList.add('fade-in-up', 'visible'); // Re-trigger anim
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });

    if (typeof validateBooking !== 'function') {
        function validateBooking(classId, className, event) {
            if(confirm('Book ' + className + '?')) {
                // Keep alert for now or implement AJAX booking later
                alert('Booking feature coming soon!'); 
            }
        }
    }
    </script>
</body>
</html>
