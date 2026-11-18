<?php
$pageTitle = 'About Me | Kirbe Taguba';
$activePage = 'about';
require_once __DIR__ . '/includes/header.php';

$education  = $pdo->query("SELECT * FROM tbl_experience WHERE entry_type = 'Education' ORDER BY sort_order ASC, id ASC")->fetchAll();
$experience = $pdo->query("SELECT * FROM tbl_experience WHERE entry_type = 'Experience' ORDER BY sort_order ASC, id ASC")->fetchAll();
?>

<!-- ============ ABOUT (DETAILED) ============ -->
<section id="about" class="section-padding">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">More <span class="text-gold">About Me</span></h2>
        <div class="row g-5 mt-2">
            <div class="col-lg-6" data-aos="fade-right">
                <h4 class="mb-3">Who I Am</h4>
                <p class="text-muted"><?= nl2br(htmlspecialchars($profile['about_text'] ?? '')) ?></p>
                <p class="text-muted">
                    I am currently a <strong>BS Information Technology</strong> student at
                    <strong>Cagayan State University - Piat Campus</strong> in Piat Cagayan,
                    currently in my <strong>4th year</strong> (ongoing - not yet graduated).
                    I aspire to become a professional web developer and am actively building
                    projects to sharpen my skills in PHP, MySQL, JavaScript and modern front-end
                    technologies.
                </p>
                <?php if (!empty($profile['motto'])): ?>
                <blockquote class="motto-quote mt-3">
                    <i class="fas fa-quote-left text-gold"></i>
                    <?= htmlspecialchars($profile['motto']) ?>
                </blockquote>
                <?php endif; ?>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h4 class="mb-3">Personal Info</h4>
                <ul class="list-unstyled about-facts">
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Name:</strong> <?= htmlspecialchars($profile['full_name'] ?? '') ?></li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Course:</strong> BS Information Technology (4th Year)</li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>School:</strong> CSU - Piat Campus</li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Location:</strong> <?= htmlspecialchars($profile['location'] ?? '') ?></li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Address:</strong> <?= htmlspecialchars($profile['address'] ?? '') ?></li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Birthday:</strong> <?= htmlspecialchars($profile['birthday'] ?? '') ?> (Age <?= (int)($profile['age'] ?? 0) ?>)</li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Languages:</strong> <?= htmlspecialchars($profile['languages'] ?? '') ?></li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Hobbies:</strong> <?= htmlspecialchars($profile['hobbies'] ?? '') ?></li>
                    <li><i class="fas fa-check-circle text-gold me-2"></i><strong>Tools:</strong> <?= htmlspecialchars($profile['tools'] ?? '') ?></li>
                </ul>
                <div class="mt-4">
                    <?php if (!empty($profile['open_to_ojt'])): ?>
                    <span class="badge bg-success-subtle text-success border border-success px-3 py-2 me-2 mb-2"><i class="fas fa-briefcase me-1"></i>Open to OJT</span>
                    <?php endif; ?>
                    <a href="projects.php" class="btn btn-outline-gold">View Projects</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ EXPERIENCE ============ -->
<section id="experience" class="section-padding bg-alt">
    <div class="container">
        <h2 class="section-title text-center" data-aos="fade-up">My <span class="text-gold">Experience</span></h2>
        <p class="text-center text-muted mb-5" data-aos="fade-up">Work, training and organizational involvement</p>

        <div class="timeline">
            <?php foreach ($experience as $i => $exp): ?>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="<?= $i * 150 ?>">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="d-flex justify-content-between flex-wrap align-items-start">
                        <div>
                            <h5 class="mb-1"><?= htmlspecialchars($exp['school_name']) ?></h5>
                            <p class="text-muted mb-1"><i class="fas fa-briefcase me-1"></i><?= htmlspecialchars($exp['degree'] ?? '') ?></p>
                        </div>
                        <div class="text-end">
                            <span class="badge <?= $exp['status'] === 'Completed' ? 'bg-success-subtle text-success border border-success' : 'bg-warning-subtle text-warning border border-warning' ?> px-3 py-2">
                                <?= htmlspecialchars($exp['status']) ?>
                            </span>
                            <br><small class="text-muted"><?= htmlspecialchars($exp['period'] ?? '') ?></small>
                        </div>
                    </div>
                    <?php if (!empty($exp['description'])): ?>
                    <p class="mt-2 mb-0 text-muted"><?= nl2br(htmlspecialchars($exp['description'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($experience)): ?>
            <p class="text-center text-muted">No experience entries yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============ EDUCATION TIMELINE ============ -->
<section id="education" class="section-padding">
    <div class="container">
        <h2 class="section-title text-center" data-aos="fade-up">My <span class="text-gold">Education</span></h2>
        <p class="text-center text-muted mb-5" data-aos="fade-up">Academic journey from primary school to university</p>

        <div class="timeline">
            <?php foreach ($education as $i => $edu): ?>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="<?= $i * 150 ?>">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="d-flex justify-content-between flex-wrap align-items-start">
                        <div>
                            <h5 class="mb-1"><?= htmlspecialchars($edu['school_name']) ?></h5>
                            <p class="text-muted mb-1"><i class="fas fa-book me-1"></i><?= htmlspecialchars($edu['degree'] ?? '') ?></p>
                        </div>
                        <div class="text-end">
                            <span class="badge <?= $edu['status'] === 'Completed' ? 'bg-success-subtle text-success border border-success' : 'bg-warning-subtle text-warning border border-warning' ?> px-3 py-2">
                                <?= htmlspecialchars($edu['status']) ?>
                            </span>
                            <br><small class="text-muted"><?= htmlspecialchars($edu['period'] ?? '') ?></small>
                        </div>
                    </div>
                    <?php if (!empty($edu['description'])): ?>
                    <p class="mt-2 mb-0 text-muted"><?= nl2br(htmlspecialchars($edu['description'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
