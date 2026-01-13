<?php
require_once 'includes/init.php';

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Homepage -->
    <url>
        <loc>https://htumartialarts.42web.io/</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    <!-- Static Pages -->
    <url>
        <loc>https://htumartialarts.42web.io/classes_premium.php</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    
    <url>
        <loc>https://htumartialarts.42web.io/prices.php</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    
    <url>
        <loc>https://htumartialarts.42web.io/login.php</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    
    <url>
        <loc>https://htumartialarts.42web.io/signup.php</loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <?php
    // Dynamic: Instructors from database
    $stmt = $conn->prepare("SELECT id, name FROM instructors ORDER BY id");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        echo "<url>\n";
        echo "  <loc>https://htumartialarts.42web.io/index.php#instructor-" . $row['id'] . "</loc>\n";
        echo "  <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        echo "  <changefreq>monthly</changefreq>\n";
        echo "  <priority>0.7</priority>\n";
        echo "</url>\n";
    }
    $stmt->close();
    ?>
    
</urlset>
