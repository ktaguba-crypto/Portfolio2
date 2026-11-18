<?php
$pageTitle = 'Kirbe Taguba | Aspiring Web Developer';
$activePage = 'home';
require_once __DIR__ . '/includes/header.php';

$skills     = $pdo->query("SELECT * FROM tbl_skills ORDER BY category, percentage DESC")->fetchAll();
$certs      = $pdo->query("SELECT * FROM tbl_certificates ORDER BY id DESC")->fetchAll();
$stats = [
    'projects' => (int)$pdo->query("SELECT COUNT(*) FROM tbl_projects")->fetchColumn(),
    'skills'   => (int)$pdo->query("SELECT COUNT(*) FROM tbl_skills")->fetchColumn(),
    'certs'    => (int)$pdo->query("SELECT COUNT(*) FROM tbl_certificates")->fetchColumn(),
];
?>

<!-- ============ HERO ============ -->
<section id="home" class="hero-section d-flex align-items-center">
    <div class="hero-bg"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                <p class="hero-greet">Hello, I'm</p>
                <h1 class="hero-name"><?= htmlspecialchars($profile['full_name'] ?? 'Kirbe Taguba') ?></h1>
                <h2 class="hero-typed">
                    <span id="typingText"><?= htmlspecialchars($profile['hero_title'] ?? '') ?></span><span class="typing-cursor">|</span>
                </h2>
                <p class="hero-subtitle"><?= htmlspecialchars($profile['hero_subtitle'] ?? '') ?></p>
                <div class="hero-buttons mt-4">
                    <?php if (!empty($profile['resume_file'])): ?>
                    <a href="<?= htmlspecialchars($profile['resume_file']) ?>" class="btn btn-gold btn-lg me-2" download>
                        <i class="fas fa-download me-2"></i>Download CV
                    </a>
                    <?php else: ?>
                    <span class="badge bg-gold-subtle text-gold border border-gold-subtle px-3 py-2 me-2">
                        <i class="fas fa-file-alt me-1"></i>Resume available upon request
                    </span>
                    <?php endif; ?>
                    <a href="contact.php" class="btn btn-outline-gold btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contact Me
                    </a>
                </div>
                <div class="social-icons mt-4">
                    <?php if (!empty($profile['facebook_url'])): ?><a href="<?= htmlspecialchars($profile['facebook_url']) ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
                    <?php if (!empty($profile['instagram_url'])): ?><a href="<?= htmlspecialchars($profile['instagram_url']) ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a><?php endif; ?>
                    <?php if (!empty($profile['github_url'])): ?><a href="<?= htmlspecialchars($profile['github_url']) ?>" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a><?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-duration="1000">
                <div class="hero-photo-wrapper">
                    <div class="hero-photo-ring"></div>
                    <img src="<?= htmlspecialchars($profile['profile_photo'] ?: 'assets/img/profile.jpg') ?>"
                         alt="<?= htmlspecialchars($profile['full_name'] ?? 'Profile') ?>"
                         class="hero-photo img-fluid"
                         onerror="this.src='assets/img/placeholder.svg'">
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                    <span class="badge bg-gold text-dark px-3 py-2">Currently 4th Year BSIT</span>
                    <?php if (!empty($profile['open_to_ojt'])): ?>
                    <span class="badge bg-success-subtle text-success border border-success px-3 py-2">Open to OJT</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <a href="#about" class="scroll-down"><i class="fas fa-chevron-down"></i></a>
    </div>
</section>

<!-- ============ ABOUT ============ -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <h2 class="section-title">About <span class="text-gold">Me</span></h2>
                <p class="lead text-muted"><?= nl2br(htmlspecialchars($profile['about_text'] ?? '')) ?></p>
                <?php if (!empty($profile['motto'])): ?>
                <blockquote class="motto-quote">
                    <i class="fas fa-quote-left text-gold"></i>
                    <?= htmlspecialchars($profile['motto']) ?>
                </blockquote>
                <?php endif; ?>
                <div class="info-cards mt-4">
                    <div class="info-card">
                        <i class="fas fa-graduation-cap"></i>
                        <div><strong>Education</strong><br><small>BSIT - CSU Piat Campus</small></div>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <div><strong>Location</strong><br><small><?= htmlspecialchars($profile['location'] ?? 'Tuguegarao City') ?></small></div>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-briefcase"></i>
                        <div><strong>Status</strong><br><small><?= htmlspecialchars($profile['job_title'] ?? 'Aspiring Web Developer') ?></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="row g-3">
                    <div class="col-6 col-md-4">
                        <div class="stat-card"><span class="stat-num" data-count="<?= $stats['projects'] ?>">0</span><span class="stat-label">Projects</span></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card"><span class="stat-num" data-count="<?= $stats['skills'] ?>">0</span><span class="stat-label">Skills</span></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card"><span class="stat-num" data-count="<?= $stats['certs'] ?>">0</span><span class="stat-label">Certificates</span></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card"><span class="stat-num" data-count="4">0</span><span class="stat-label">Year Level</span></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card"><span class="stat-num" data-count="<?= $visitsToday ?>">0</span><span class="stat-label">Visits Today</span></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card"><span class="stat-num" data-count="<?= $totalVisits ?>">0</span><span class="stat-label">Total Visits</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SKILLS ============ -->
<section id="skills" class="section-padding bg-alt">
    <div class="container">
        <h2 class="section-title text-center" data-aos="fade-up">My <span class="text-gold">Skills</span></h2>
        <p class="text-center text-muted mb-5" data-aos="fade-up">Technologies I use to build modern web applications</p>
        <div class="row g-4">
            <?php
            $categories = ['Frontend' => 'fa-laptop-code', 'Backend' => 'fa-server', 'Tools' => 'fa-tools'];
            foreach ($categories as $cat => $icon):
                $catSkills = array_filter($skills, fn($s) => $s['category'] === $cat);
                if (empty($catSkills)) continue;
            ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="skill-group-card h-100">
                    <h5 class="mb-4"><i class="fas <?= $icon ?> text-gold me-2"></i><?= $cat ?></h5>
                    <?php foreach ($catSkills as $skill): ?>
                    <div class="skill-bar mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="skill-name"><?= htmlspecialchars($skill['skill_name']) ?></span>
                            <span class="skill-pct"><?= (int)$skill['percentage'] ?>%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-gold" style="width: 0%" data-width="<?= (int)$skill['percentage'] ?>"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ CERTIFICATES ============ -->
<section id="certificates" class="section-padding">
    <div class="container">
        <h2 class="section-title text-center" data-aos="fade-up">Certificates</h2>
        <p class="text-center text-muted mb-5" data-aos="fade-up">Credentials that mark my learning journey</p>
        <div class="row g-4">
            <?php foreach ($certs as $cert): ?>
            <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in">
                <div class="cert-card h-100">
                    <div class="cert-img-wrapper">
                        <img src="<?= htmlspecialchars($cert['image'] ?: 'assets/img/cert-placeholder.svg') ?>"
                             alt="<?= htmlspecialchars($cert['title']) ?>"
                             class="img-fluid" loading="lazy"
                             onerror="this.src='assets/img/cert-placeholder.svg'">
                    </div>
                    <div class="cert-body p-3">
                        <h6 class="mb-1"><?= htmlspecialchars($cert['title']) ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($cert['issuer'] ?? '') ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($certs)): ?>
            <div class="col-12 text-center text-muted">No certificates yet.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-padding cta-section text-center">
    <div class="container" data-aos="zoom-in">
        <h2 class="mb-3">Let's Work <span class="text-gold">Together</span></h2>
        <p class="text-muted mb-4">Have a project in mind? Feel free to reach out.</p>
        <a href="contact.php" class="btn btn-gold btn-lg"><i class="fas fa-paper-plane me-2"></i>Get In Touch</a>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
