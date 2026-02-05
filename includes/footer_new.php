<!-- Footer Include -->
<footer class="footer">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between">
            
            <!-- Brand & Info -->
            <div class="mb-5 mb-md-0" style="max-width: 300px;">
                <h4 class="mb-4">HTU MARTIAL ARTS</h4>
                <p class="text-muted mb-4">
                    Forging fighters and building character since 2026. Join the strongest community in Amman.
                </p>
                <p class="text-muted mb-2"><i class="bi bi-geo-alt me-2 text-accent"></i> HTU Campus, Amman, Jordan</p>
                <p class="text-muted mb-2"><i class="bi bi-envelope me-2 text-accent"></i> info@htumartialarts.com</p>
                <p class="text-muted"><i class="bi bi-whatsapp me-2 text-accent"></i> +962 79 123 4567</p>
            </div>

            <!-- Links -->
            <div class="d-flex gap-5 flex-wrap">
                <div>
                    <h6 class="section-label mb-3">SITEMAP</h6>
                    <ul class="d-flex flex-column gap-2">
                        <li><a href="index.php" class="text-muted hover-accent">Home</a></li>
                        <li><a href="classes_premium.php" class="text-muted hover-accent">Timetable</a></li>
                        <li><a href="prices.php" class="text-muted hover-accent">Memberships</a></li>
                        <li><a href="login.php" class="text-muted hover-accent">Member Login</a></li>
                    </ul>
                </div>
                
                <div>
                     <h6 class="section-label mb-3">SOCIAL</h6>
                     <div class="d-flex gap-3">
                        <a href="#" class="text-primary"><i class="bi bi-instagram" style="font-size: 1.25rem;"></i></a>
                        <a href="#" class="text-primary"><i class="bi bi-facebook" style="font-size: 1.25rem;"></i></a>
                        <a href="#" class="text-primary"><i class="bi bi-youtube" style="font-size: 1.25rem;"></i></a>
                     </div>
                </div>
            </div>

        </div>

        <div class="border-top border-subtle mt-5 pt-4 text-center text-muted small">
            <p>&copy; 2026 HTU Martial Arts. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- Intersection Observer for Animations -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
});
</script>
