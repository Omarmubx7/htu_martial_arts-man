<?php
require_once 'includes/init.php';
$pageTitle = "Sign Up";
include 'includes/header.php';

// 1. Get Plan from URL if set
$planId = isset($_GET['plan_id']) ? intval($_GET['plan_id']) : null;
$username = '';
$email = '';

// 2. Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $selected_plan = !empty($_POST['plan_id']) ? intval($_POST['plan_id']) : null; // Can be null
    $martial_art = trim($_POST['martial_art']); // e.g. "Jiu-jitsu"

    // Validation
    if ($password !== $confirm_password) {
        addFlashToast("Passwords do not match.", "danger");
    } else {
        // Check email uniqueness
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            addFlashToast("Email is already registered.", "warning");
        } else {
            // Create User
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            // Default role = member
            $role = 'member';
            
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, membership_id, martial_art) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssis", $username, $email, $hashed, $role, $selected_plan, $martial_art);
            
            if ($stmt->execute()) {
                // Auto Login
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['membership_id'] = $selected_plan;
                
                addFlashToast("Account created successfully! Welcome to the team.", "success");
                redirectTo("dashboard.php");
            } else {
                addFlashToast("Error: " . $conn->error, "danger");
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>

<section class="page-section d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card glass-panel shadow-lg">
                    <div class="text-center mb-4">
                        <h2 class="mb-1">Join The Tribe</h2>
                        <p class="text-muted text-uppercase ls-2 small">Start your journey today</p>
                    </div>
                    
                    <form method="POST">
                        <input type="hidden" name="plan_id" value="<?php echo $planId ? intval($planId) : ''; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" name="username" class="form-control" placeholder="John Doe" required value="<?php echo htmlspecialchars($username); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                         
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <!-- Main Discipline Selection -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Primary Interest</label>
                            <select name="martial_art" class="form-select">
                                <option value="Jiu-jitsu">Jiu-jitsu</option>
                                <option value="Karate">Karate</option>
                                <option value="Muay Thai">Muay Thai</option>
                                <option value="Judo">Judo</option>
                            </select>
                            <div class="form-text text-muted small">You can change this later in your dashboard.</div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-3">Create Account</button>
                        
                        <div class="text-center">
                            <p class="text-muted small mb-0">Already a member? <a href="login.php" class="text-primary fw-bold">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Optional: Sidebar or visual element -->
            <div class="col-md-5 d-none d-md-block ps-5 align-self-center">
                 <h1 class="display-4 mb-4">Train.<br>Fight.<br><span class="text-primary">Win.</span></h1>
                 <p class="lead text-muted">"The only person you are destined to become is the person you decide to be."</p>
                 <div class="mt-4 text-primary">
                     <i class="bi bi-star-fill"></i>
                     <i class="bi bi-star-fill"></i>
                     <i class="bi bi-star-fill"></i>
                     <i class="bi bi-star-fill"></i>
                     <i class="bi bi-star-fill"></i>
                 </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
