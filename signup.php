<?php
require_once 'includes/init.php';
$pageTitle = "Sign Up";

$planId = isset($_GET['plan_id']) ? intval($_GET['plan_id']) : null;
$username = '';
$email = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $selected_plan = !empty($_POST['plan_id']) ? intval($_POST['plan_id']) : null;
    $martial_art = trim($_POST['martial_art']);

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            $error = "Email is already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $role = 'member';
            
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, membership_id, martial_art) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssis", $username, $email, $hashed, $role, $selected_plan, $martial_art);
            
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                $_SESSION['membership_id'] = $selected_plan;
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Error: " . $conn->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | HTU Martial Arts</title>
    
    <!-- SEO -->
    <meta name="description" content="Create your account and start your martial arts journey. Join the tribe today.">
    <link rel="icon" href="images/favicon.svg">

    <link rel="stylesheet" href="css/sport-theme.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    
    <div class="auth-container">
        <div class="auth-card card animate-in">
            <div class="text-center mb-5">
                <a href="index.php" style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--text-primary); text-decoration: none;">HTU MARTIAL ARTS</a>
                <p class="text-muted mt-2">Start your legacy. Join the tribe.</p>
            </div>

            <?php if($error): ?>
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--accent); color: var(--accent); padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="plan_id" value="<?php echo $planId ? intval($planId) : ''; ?>">
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Full Name</label>
                    <input type="text" name="username" class="form-control" placeholder="John Doe" required value="<?php echo htmlspecialchars($username); ?>">
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Primary Interest</label>
                    <select name="martial_art" class="form-control" style="height: auto;">
                        <option value="Jiu-jitsu">Jiu-jitsu</option>
                        <option value="Karate">Karate</option>
                        <option value="Muay Thai">Muay Thai</option>
                        <option value="Judo">Judo</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Create Account</button>
                
                <div class="text-center mt-4">
                    <a href="login.php" style="color: var(--accent); font-size: 0.9rem;">Already have an account? Sign In</a>
                    <br>
                    <a href="index.php" class="text-muted small mt-3 d-inline-block">Back to Home</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
