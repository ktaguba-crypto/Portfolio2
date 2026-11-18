<?php
$pageTitle = 'Projects | Kirbe Taguba';
$activePage = 'projects';
require_once __DIR__ . '/includes/header.php';

$projects = $pdo->query("SELECT * FROM tbl_projects ORDER BY id DESC")->fetchAll();
?>

<section id="projects" class="section-padding">
    <div class="container">
        <h2 class="section-title text-center" data-aos="fade-up">My <span class="text-gold">Projects</span></h2>
        <p class="text-center text-muted mb-4" data-aos="fade-up">Things I've built through coursework and self-learning</p>

        <!-- Search + Filters -->
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary"><i class="fas fa-search"></i></span>
                    <input type="text" id="projectSearch" class="form-control bg-transparent" placeholder="Search projects...">
                </div>
            </div>
            <div class="col-12">
                <div class="filter-btns text-center" id="filterBtns">
                    <button class="btn btn-gold active" data-filter="all">All</button>
                    <button class="btn btn-outline-gold" data-filter="Web">Web</button>
                    <button class="btn btn-outline-gold" data-filter="Design">Design</button>
                    <button class="btn btn-outline-gold" data-filter="Capstone">Capstone</button>
                </div>
            </div>
        </div>

        <div class="row g-4" id="projectsGrid">
            <?php foreach ($projects as $p): ?>
            <div class="col-md-6 col-lg-4 project-card-wrapper"
                 data-category="<?= htmlspecialchars($p['category']) ?>"
                 data-title="<?= htmlspecialchars(strtolower($p['title'] . ' ' . $p['description'])) ?>"
                 data-aos="fade-up">
                <div class="project-card h-100">
                    <div class="project-img-wrapper">
                        <?php if (!empty($p['live_url'])): ?>
                        <a href="<?= htmlspecialchars($p['live_url']) ?>" target="_blank" rel="noopener" aria-label="Visit live site">
                        <?php endif; ?>
                        <img src="<?= htmlspecialchars($p['image'] ?: 'assets/img/project-placeholder.svg') ?>"
                             alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy"
                             onerror="this.src='assets/img/project-placeholder.svg'">
                        <?php if (!empty($p['live_url'])): ?>
                        </a>
                        <?php endif; ?>
                        <div class="project-overlay">
                            <button class="btn btn-gold btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#projectModal"
                                    data-title="<?= htmlspecialchars($p['title'], ENT_QUOTES) ?>"
                                    data-desc="<?= htmlspecialchars($p['description'], ENT_QUOTES) ?>"
                                    data-category="<?= htmlspecialchars($p['category'], ENT_QUOTES) ?>"
                                    data-tech="<?= htmlspecialchars($p['tech_stack'] ?? '', ENT_QUOTES) ?>"
                                    data-role="<?= htmlspecialchars($p['role'] ?? '', ENT_QUOTES) ?>"
                                    data-live="<?= htmlspecialchars($p['live_url'] ?? '', ENT_QUOTES) ?>"
                                    data-github="<?= htmlspecialchars($p['github_url'] ?? '', ENT_QUOTES) ?>"
                                    data-image="<?= htmlspecialchars($p['image'] ?: 'assets/img/project-placeholder.svg') ?>">
                                <i class="fas fa-eye me-1"></i>View Details
                            </button>
                        </div>
                    </div>
                    <div class="project-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><?= htmlspecialchars($p['title']) ?></h5>
                            <span class="badge bg-gold-subtle text-gold border border-gold-subtle"><?= htmlspecialchars($p['category']) ?></span>
                        </div>
                        <p class="text-muted small mt-2 mb-0"><?= htmlspecialchars(mb_strimwidth($p['description'], 0, 100, '...')) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div id="noProjects" class="text-center text-muted py-5 d-none">
            <i class="fas fa-search fa-2x mb-2"></i><br>No projects match your search.
        </div>
    </div>
</section>

<!-- ============ PROJECT MODAL ============ -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Project" class="img-fluid rounded mb-3 w-100">
                <span class="badge bg-gold-subtle text-gold border border-gold-subtle mb-2" id="modalCategory"></span>
                <p id="modalDesc" class="text-muted"></p>
                <p class="mb-1"><strong>Tech Stack:</strong></p>
                <p id="modalTech" class="text-muted"></p>
                <p class="mb-1"><strong>Role:</strong> <span id="modalRole" class="text-muted"></span></p>
            </div>
            <div class="modal-footer border-secondary">
                <a id="modalLive" href="#" target="_blank" rel="noopener" class="btn btn-gold"><i class="fas fa-external-link-alt me-1"></i>View Live</a>
                <a id="modalGithub" href="#" target="_blank" rel="noopener" class="btn btn-outline-gold"><i class="fab fa-github me-1"></i>GitHub</a>
            </div>
        </div>
    </div>
</div>

<script>
// Populate modal when opened
document.getElementById('projectModal').addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('modalTitle').textContent   = btn.dataset.title;
    document.getElementById('modalDesc').textContent    = btn.dataset.desc;
    document.getElementById('modalCategory').textContent= btn.dataset.category;
    document.getElementById('modalTech').textContent    = btn.dataset.tech || 'N/A';
    document.getElementById('modalRole').textContent    = btn.dataset.role || 'N/A';
    document.getElementById('modalImage').src           = btn.dataset.image;
    const liveBtn = document.getElementById('modalLive');
    const ghBtn   = document.getElementById('modalGithub');
    liveBtn.href  = btn.dataset.live || '#';
    ghBtn.href    = btn.dataset.github || '#';
    liveBtn.style.display = btn.dataset.live ? '' : 'none';
    ghBtn.style.display   = btn.dataset.github ? '' : 'none';
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
