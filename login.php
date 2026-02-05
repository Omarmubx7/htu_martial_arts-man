<?php 
/**
 * login.php
 * User login page - authenticates users against the database
 * Uses prepared statements for security and password_verify() for password checking
 */

require_once 'includes/init.php';
$pageTitle = "Login";

$error = '';

// ===================================================================
// HANDLE LOGIN LOGIC - Process form submission
// ===================================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from the login form (safely)
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Query the database to find user with this email
    // Using prepared statement to prevent SQL injection - very important for security!
    // The ? is a placeholder that gets safely replaced with the actual email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    // 's' means the parameter is a string
    $stmt->bind_param("s", $email);
    // Execute the prepared query with the email value
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if exactly one user was found with this email
    if ($result->num_rows == 1) {
        // Get the user data from database as an associative array
        $user = $result->fetch_assoc();
        
        // Verify the password they entered matches the hashed password in database
        // password_verify() safely compares plain text password with bcrypt hash
        // Never compare plain text passwords directly - always use password_verify()!
        if (password_verify($password, $user['password'])) {
            // Password is correct! Store user info in SESSION variables
            // This keeps them logged in as they navigate the site
            $_SESSION['user_id'] = $user['id'];
            // Check is_admin flag; set role to 'admin' if true, else default to 'member'
            $role = (isset($user['is_admin']) && $user['is_admin'] == 1) ? 'admin' : 'member';
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $role, $membership_id);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['membership_id'] = $membership_id;

            addFlashToast("Welcome back, $username!", "success");
            redirectTo("dashboard.php");
        } else {
            addFlashToast("Invalid password.", "danger");
        }
    } else {
        addFlashToast("No account found with that email.", "danger");
    }
    $stmt->close();
}
?>

<section class="page-section d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card glass-panel shadow-lg">
                    <div class="text-center mb-4">
                        <h2 class="mb-1">Welcome Back</h2>
                        <p class="text-muted text-uppercase ls-2 small">Sign in to your account</p>
                    </div>
                    
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                        
                        <div class="text-center">
                            <p class="text-muted small mb-0">Don't have an account? <a href="signup.php" class="text-primary fw-bold">Join Now</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
