<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<section class="section">
    <div class="container">
        <div class="section-heading reveal active">
            <span class="section-label">Contact Us</span>
            <h2>Let’s connect</h2>
            <p>
                Have questions, suggestions, or feedback about StudyFlow AI? Send us a message.
            </p>
        </div>

        <div class="two-col">
            <div class="form-panel reveal active">
                <form class="modern-form" action="#" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Enter message subject">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Write your message"></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>

            <div class="info-panel reveal active">
                <div class="info-widget">
                    <div class="widget-top">
                        <span class="widget-dot"></span>
                        <span>Contact Information</span>
                    </div>
                    <h3>Get in touch</h3>
                    <p>
                        StudyFlow AI is built to support students with a smarter and more modern academic workflow.
                    </p>

                    <div class="widget-tags">
                        <span>Email Support</span>
                        <span>Project Feedback</span>
                        <span>Feature Ideas</span>
                    </div>
                </div>

                <div class="info-widget small">
                    <h4>Email</h4>
                    <p>support@studyflowai.com</p>
                </div>

                <div class="info-widget small">
                    <h4>Availability</h4>
                    <p>Monday to Friday • 9:00 AM to 5:00 PM</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>