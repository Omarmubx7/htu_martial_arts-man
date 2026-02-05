<?php 
require_once 'includes/init.php';
$pageTitle = "Login";
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $stmt = $conn->prepare("SELECT id, username, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = (isset($user['is_admin']) && $user['is_admin'] == 1) ? 'admin' : 'member';
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that email.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HTU Martial Arts</title>
    
    <!-- SEO -->
    <meta name="description" content="Login to your HTU Martial Arts account to book classes and manage your membership.">
    <link rel="icon" href="images/favicon.svg">
    
    <link rel="stylesheet" href="css/sport-theme.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    
    <!-- Use basic nav for auth pages or just keep clean? User asked for centralized inclusions so let's stick to it but maybe simplified. 
         Actually, typically auth pages are standalone but having the nav is good UX. -->
         
    <div class="auth-container">
        
        <div class="auth-card card animate-in">
            <div class="text-center mb-5">
                <a href="index.php" style="font-family: var(--font-heading); font-size: 1.5rem; color: var(--text-primary); text-decoration: none;">HTU MARTIAL ARTS</a>
                <p class="text-muted mt-2">Welcome back. Sign in to your account.</p>
            </div>

            <?php if($error): ?>
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--accent); color: var(--accent); padding: 1rem; border-radius: 4px; margin-bottom: 2rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; color: var(--text-muted);">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
                
                <div class="text-center mt-4">
                    <a href="signup.php" style="color: var(--accent); font-size: 0.9rem;">Don't have an account? Join Now</a>
                    <br>
                    <a href="index.php" class="text-muted small mt-3 d-inline-block">Back to Home</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
