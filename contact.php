<php
$pageTitle = 'Contact | Kirbe Taguba';
$activePage = 'contact';
require_once __DIR__ . '/includes/header.php';

// Handle contact form submission (POST only)
$success = false;
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name    = trim(htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'));
    $email   = trim(htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'));
    $subject = trim(htmlspecialchars($_POST['subject'] ?? '', ENT_QUOTES, 'UTF-8'));
    $message = trim(htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8'));

    // Basic validation
    if ($name === '' || $email === '' || $message === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        // Prepared statement - safe against SQL injection
        $stmt = $pdo->prepare("INSERT INTO tbl_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        $success = true;
    }
}
?>

<section id="contact" class="section-padding">
    <div class="container">
        <h2 class="section-title text-center" data-aos="fade-up">Get In <span class="text-gold">Touch</span></h2>
        <p class="text-center text-muted mb-5" data-aos="fade-up">Have a question or want to work together? Send me a message.</p>

        <div class="row g-5">
            <!-- Contact Info -->
            <div class="col-lg-5" data-aos="fade-right">
                <h4 class="mb-4">Contact Information</h4>
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div><strong>Gmail</strong><br><a href="mailto:<?= htmlspecialchars($profile['email'] ?? '') ?>"><?= htmlspecialchars($profile['email'] ?? '') ?></a></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div><strong>Mobile</strong><br><a href="tel:<?= preg_replace('/\D/', '', $profile['phone'] ?? '') ?>"><?= htmlspecialchars($profile['phone'] ?? '') ?></a></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fab fa-facebook-f"></i></div>
                        <div><strong>Facebook</strong><br><a href="<?= htmlspecialchars($profile['facebook_url'] ?? '#') ?>" target="_blank" rel="noopener">Kirbe Dedicatoria Taguba</a></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fab fa-instagram"></i></div>
                        <div><strong>Instagram</strong><br><a href="<?= htmlspecialchars($profile['instagram_url'] ?? '#') ?>" target="_blank" rel="noopener">@kirbetaguba</a></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fab fa-github"></i></div>
                        <div><strong>GitHub</strong><br><a href="<?= htmlspecialchars($profile['github_url'] ?? '#') ?>" target="_blank" rel="noopener">Kirby123gwapo</a></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div><strong>Address</strong><br><?= htmlspecialchars($profile['address'] ?: ($profile['location'] ?? '')) ?></div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div><strong>Education</strong><br>BSIT - CSU Piat Campus (4th Year)</div>
                    </div>
                </div>

                <!-- Map: Tuguegarao City -->
                <div class="mt-4 rounded overflow-hidden border border-secondary">
                    <iframe
                        src="https://www.google.com/maps?q=Tuguegarao+City,+Cagayan,+Philippines&output=embed"
                        width="100%" height="280" style="border:0;" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Map of Tuguegarao City"></iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="contact-form-card p-4 p-md-5">
                    <?php if ($success): ?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            Thank you! Your message has been sent successfully. I'll get back to you soon.
                        </div>
                    <?php elseif ($error): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="contact.php" id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required maxlength="150"
                                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required maxlength="150"
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" maxlength="200"
                                       value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="6" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-gold btn-lg w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
