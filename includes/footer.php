<!-- includes/footer.php -->
<!-- This is the shared footer template used by all pages -->
<!-- It contains the footer content and loads necessary JavaScript libraries -->

<!-- Footer section at the bottom of the page -->
<footer class="site-footer text-center">
    <div class="container">
        <!-- Footer logo -->
        <div class="footer-logo mb-3">
            <img src="images/logo-footer.svg" alt="HTU Martial Arts" class="logo-footer" style="height: 60px;">
        </div>
        <!-- Copyright notice -->
        <p class="mb-0 text-muted">&copy; <?php echo date('Y'); ?> HTU Martial Arts. All Rights Reserved.</p>
        
        <!-- Quick Links -->
        <div class="footer-links mt-4 mb-4">
            <a href="index.php" class="mx-3">Home</a>
            <a href="classes_premium.php" class="mx-3">Classes</a>
            <a href="prices.php" class="mx-3">Memberships</a>
            <a href="login.php" class="mx-3">Login</a>
        </div>
        
        <!-- Social Media Links -->
        <div class="social-links mb-4">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
        </div>
        
        <!-- Location Info -->
        <p class="text-muted small mb-0">
            <i class="bi bi-geo-alt me-1 text-primary"></i> HTU, Amman, Jordan
        </p>
    </div>
</footer>

<?php
// ============================================================
// BOOTSTRAP COMPONENT (SITE-WIDE): TOAST NOTIFICATIONS
// Any page can call addFlashToast('Message', 'success|danger|warning|info')
// ============================================================
$__toasts = function_exists('popFlashToasts') ? popFlashToasts() : [];
if (!empty($__toasts)):
?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 2100;">
        <?php foreach ($__toasts as $__toast):
            $type = isset($__toast['type']) ? (string)$__toast['type'] : 'info';
            $msg  = isset($__toast['message']) ? (string)$__toast['message'] : '';
            $bgClass = 'text-bg-' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
        ?>
            <div class="toast align-items-center <?php echo $bgClass; ?> border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4500">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Bootstrap JavaScript bundle - required for Bootstrap components (modals, dropdowns, etc) -->
<!-- Version 5.3.0 includes Popper.js for tooltips/popovers -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Auto-show any toast markup we rendered above.
document.addEventListener('DOMContentLoaded', function () {
    if (!window.bootstrap) return;
    document.querySelectorAll('.toast').forEach(function (el) {
        try {
            var toast = bootstrap.Toast.getOrCreateInstance(el);
            toast.show();
        } catch (e) {
            // Ignore; toast is optional.
        }
    });
});
</script>

<!-- Custom JavaScript file for interactive features -->
<!-- Contains functions for smooth scrolling, animations, and other interactions -->
<script src="js/ultimate-interactions.js"></script>

<!-- ============================================================ -->
<!-- GOOGLE ANALYTICS 4 - Web Analytics Tracking -->
<!-- Measurement ID: G-QZ5PVSKE6W -->
<!-- Tracks user behavior, page views, and conversions -->
<!-- Dashboard: https://analytics.google.com -->
<!-- ============================================================ -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QZ5PVSKE6W"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QZ5PVSKE6W', {
    'send_page_view': true,
    'cookie_flags': 'SameSite=None;Secure'
  });
  
  // ============================================================
  // ENHANCED EVENT TRACKING FOR CONVERSION OPTIMIZATION
  // Automatically tracks important user interactions
  // ============================================================
  document.addEventListener('DOMContentLoaded', function() {
    // Track "Join Now" / "Sign Up" button clicks
    document.querySelectorAll('.join-btn, a[href*="signup"], a[href*="prices"]').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        var buttonText = this.textContent.trim();
        gtag('event', 'click', {
          'event_category': 'engagement',
          'event_label': 'signup_cta_clicked',
          'button_text': buttonText
        });
      });
    });
    
    // Track "Choose Plan" / Membership plan selection
    document.querySelectorAll('a[href*="plan_id"], .btn-primary[href*="signup"]').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        var planName = this.closest('.card')?.querySelector('h3')?.textContent.trim() || 'Unknown Plan';
        gtag('event', 'select_content', {
          'content_type': 'membership_plan',
          'content_id': planName,
          'event_category': 'engagement',
          'event_label': 'membership_plan_selected'
        });
      });
    });
    
    // Track "Book Class" or class-related clicks
    document.querySelectorAll('a[href*="book"], a[href*="class"]').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        gtag('event', 'click', {
          'event_category': 'engagement',
          'event_label': 'class_booking_intent'
        });
      });
    });
    
    // Track phone number clicks (if you have click-to-call)
    document.querySelectorAll('a[href^="tel:"]').forEach(function(link) {
      link.addEventListener('click', function(e) {
        gtag('event', 'phone_call', {
          'event_category': 'lead',
          'event_label': 'phone_click'
        });
      });
    });
    
    // Track email clicks
    document.querySelectorAll('a[href^="mailto:"]').forEach(function(link) {
      link.addEventListener('click', function(e) {
        gtag('event', 'email_click', {
          'event_category': 'lead',
          'event_label': 'email_intent'
        });
      });
    });
  });
</script>

<!-- ============================================================ -->
<!-- FACEBOOK PIXEL (Optional - for social media advertising) -->
<!-- Uncomment and add your Pixel ID if running Facebook ads -->
<!-- Get your Pixel ID from: https://business.facebook.com/events_manager -->
<!-- ============================================================ -->
<!--
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', 'YOUR_PIXEL_ID');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=YOUR_PIXEL_ID&ev=PageView&noscript=1"
/></noscript>
-->

<!-- Close the HTML body and document tags -->
</body>
</html>
