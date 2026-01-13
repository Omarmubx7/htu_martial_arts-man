<?php
// Keep bootstrapping in one place.
require_once __DIR__ . '/init.php';

// SEO Configuration per page
$seoConfig = [
    'index.php' => [
        'title' => 'H.T.U Martial Arts - Learn Jiu-Jitsu, Karate, Muay Thai & Judo in Amman',
        'description' => 'Join H.T.U Martial Arts in Amman, Jordan. Expert instructors teaching Jiu-Jitsu, Karate, Muay Thai, and Judo. Flexible memberships, modern facilities, sauna, and gym. Start your martial arts journey today!',
        'keywords' => 'martial arts Amman, Jiu-Jitsu Jordan, Karate classes Amman, Muay Thai training, Judo lessons, martial arts gym Jordan, HTU martial arts, self-defense classes Amman, MMA training Jordan',
        'og_image' => 'https://htumartialarts.42web.io/images/htu-hero.jpg',
        'canonical' => 'https://htumartialarts.42web.io/'
    ],
    'classes_premium.php' => [
        'title' => 'Martial Arts Class Schedule - H.T.U Martial Arts Amman',
        'description' => 'View our complete class timetable for Jiu-Jitsu, Karate, Muay Thai, and Judo. Morning, afternoon, and evening sessions available. Kids and adult classes. Book your first session now!',
        'keywords' => 'martial arts schedule Amman, Jiu-Jitsu timetable, Karate class times, Muay Thai sessions, Judo schedule Jordan, kids martial arts classes, adult training schedule',
        'og_image' => 'https://htumartialarts.42web.io/images/class-schedule.jpg',
        'canonical' => 'https://htumartialarts.42web.io/classes_premium.php'
    ],
    'prices.php' => [
        'title' => 'Membership Prices & Plans - H.T.U Martial Arts',
        'description' => 'Affordable martial arts memberships starting at 25 JOD/month. Basic, Intermediate, Advanced, and Elite plans. Private tuition available. Join H.T.U Martial Arts today!',
        'keywords' => 'martial arts prices Amman, gym membership Jordan, Jiu-Jitsu cost, Karate membership, Muay Thai pricing, martial arts packages Jordan, affordable martial arts training',
        'og_image' => 'https://htumartialarts.42web.io/images/membership-plans.jpg',
        'canonical' => 'https://htumartialarts.42web.io/prices.php'
    ],
    'dashboard.php' => [
        'title' => 'My Dashboard - H.T.U Martial Arts',
        'description' => 'Manage your H.T.U Martial Arts membership, view class bookings, and track your training progress.',
        'keywords' => 'martial arts dashboard, member portal, class booking, membership management',
        'og_image' => 'https://htumartialarts.42web.io/images/dashboard.jpg',
        'canonical' => 'https://htumartialarts.42web.io/dashboard.php'
    ],
    'login.php' => [
        'title' => 'Member Login - H.T.U Martial Arts',
        'description' => 'Access your H.T.U Martial Arts member dashboard. Book classes, manage your membership, and view training schedules.',
        'keywords' => 'member login, martial arts portal, HTU login, gym member access',
        'og_image' => 'https://htumartialarts.42web.io/images/login.jpg',
        'canonical' => 'https://htumartialarts.42web.io/login.php'
    ],
    'signup.php' => [
        'title' => 'Sign Up - Join H.T.U Martial Arts Today',
        'description' => 'Create your H.T.U Martial Arts account and start training. Choose from flexible membership plans for Jiu-Jitsu, Karate, Muay Thai, and Judo.',
        'keywords' => 'join martial arts Amman, sign up HTU, register gym membership, new member registration, martial arts enrollment Jordan',
        'og_image' => 'https://htumartialarts.42web.io/images/signup.jpg',
        'canonical' => 'https://htumartialarts.42web.io/signup.php'
    ],
    'admin.php' => [
        'title' => 'Admin Dashboard - H.T.U Martial Arts',
        'description' => 'Admin control panel for managing H.T.U Martial Arts operations.',
        'keywords' => 'admin panel, management dashboard',
        'og_image' => 'https://htumartialarts.42web.io/images/admin.jpg',
        'canonical' => 'https://htumartialarts.42web.io/admin.php'
    ]
];

// Get current page
$currentPage = basename($_SERVER['PHP_SELF']);
$seo = $seoConfig[$currentPage] ?? [
    'title' => 'H.T.U Martial Arts - Amman, Jordan',
    'description' => 'Premier martial arts training facility in Amman, Jordan offering Jiu-Jitsu, Karate, Muay Thai, and Judo.',
    'keywords' => 'martial arts, Amman, Jordan, training',
    'og_image' => 'https://htumartialarts.42web.io/images/logo-social.png',
    'canonical' => 'https://htumartialarts.42web.io/' . $currentPage
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Primary Meta Tags -->
  <title><?php echo htmlspecialchars($seo['title']); ?></title>
  <meta name="title" content="<?php echo htmlspecialchars($seo['title']); ?>">
  <meta name="description" content="<?php echo htmlspecialchars($seo['description']); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($seo['keywords']); ?>">
  <meta name="robots" content="index, follow">
  <meta name="language" content="English">
  <meta name="author" content="H.T.U Martial Arts">
  
  <!-- Canonical URL -->
  <link rel="canonical" href="<?php echo htmlspecialchars($seo['canonical']); ?>">
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($seo['canonical']); ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($seo['title']); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($seo['description']); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($seo['og_image']); ?>">
  <meta property="og:site_name" content="H.T.U Martial Arts">
  <meta property="og:locale" content="en_US">
  
  <!-- Twitter Card -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?php echo htmlspecialchars($seo['canonical']); ?>">
  <meta property="twitter:title" content="<?php echo htmlspecialchars($seo['title']); ?>">
  <meta property="twitter:description" content="<?php echo htmlspecialchars($seo['description']); ?>">
  <meta property="twitter:image" content="<?php echo htmlspecialchars($seo['og_image']); ?>">
  
  <!-- Geographic Meta Tags -->
  <meta name="geo.region" content="JO-AM">
  <meta name="geo.placename" content="Amman">
  <meta name="geo.position" content="31.963158;35.930359">
  <meta name="ICBM" content="31.963158, 35.930359">
  
  <!-- Theme color for browser address bar -->
  <meta name="theme-color" content="#e3342f">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="shortcut icon" type="image/png" href="images/favicon.png">
  <link rel="apple-touch-icon" href="images/logo-touch.png">
  
  <!-- Schema.org Structured Data (JSON-LD) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "SportsActivityLocation",
    "name": "H.T.U Martial Arts",
    "image": "https://htumartialarts.42web.io/images/logo-social.png",
    "description": "Premier martial arts training facility offering Jiu-Jitsu, Karate, Muay Thai, and Judo classes in Amman, Jordan.",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Hashemite University Campus",
      "addressLocality": "Amman",
      "addressRegion": "Amman Governorate",
      "postalCode": "11000",
      "addressCountry": "JO"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 31.963158,
      "longitude": 35.930359
    },
    "url": "https://htumartialarts.42web.io",
    "telephone": "+962-XX-XXX-XXXX",
    "priceRange": "25-60 JOD",
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
        "opens": "06:00",
        "closes": "21:00"
      },
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Saturday", "Sunday"],
        "opens": "06:00",
        "closes": "17:00"
      }
    ],
    "sameAs": [
      "https://www.facebook.com/htumartialarts",
      "https://www.instagram.com/htumartialarts"
    ]
  }
  </script>
  
  <!-- Google Search Console Verification (ADD YOUR CODE HERE) -->
  <!-- <meta name="google-site-verification" content="YOUR_VERIFICATION_CODE"> -->
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Teko:wght@600&family=Exo+2:wght@400;600&family=Roboto+Mono:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Custom CSS -->
  <link href="css/sport-theme.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-glass">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php" aria-label="HTU Martial Arts" style="font-weight: 700; font-size: 1.5rem; text-transform: uppercase;">
      <img src="images/logo-desktop.svg" alt="HTU Martial Arts Logo" style="height: 45px; margin-right: 12px;" class="navbar-logo">
      <span class="navbar-brand-text">HTU MARTIAL ARTS</span>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: rgba(213, 6, 6, 0.78);">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="classes_premium.php">Classes</a></li>
        <li class="nav-item"><a class="nav-link" href="prices.php">Memberships</a></li>
        
        <?php if(isset($_SESSION['user_id'])): ?>
          <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link fw-bold" href="admin.php">Admin Dashboard</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Account</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link join-btn" href="prices.php">Join Now</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
