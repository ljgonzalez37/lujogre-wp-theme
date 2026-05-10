<?php
/**
 * Template Name: Work With Me
 * doctorg@lujogre.com · P.O. Box 154, Monument, CO 80132
 */
get_header(); ?>

<section class="section--dark" style="padding:64px 0 52px;">
    <div class="container">
        <span class="eyebrow">Architecture &middot; Advisory &middot; Speaking &middot; Teaching</span>
        <h1 style="color:#fff;font-family:var(--serif);font-size:2.2rem;margin-bottom:.5rem;">Work With Me</h1>
        <p style="color:rgba(255,255,255,.55);max-width:520px;font-size:1rem;line-height:1.65;">
            Four structured engagement models — each with a clear scope, a defined audience,
            and a direct way to initiate. If none of these fit, send a message and we'll figure it out.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <span class="eyebrow">Engagement Models</span>
        <h2 class="section-title">How We Can Work Together</h2>

        <div class="engagement-grid" style="margin-bottom:3.5rem;">

            <div class="engagement-card">
                <span class="engagement-card__num">01</span>
                <h3 class="engagement-card__title">Enterprise Architecture Advisory</h3>
                <p class="engagement-card__desc">
                    Strategic and technical advisory for organizations designing or modernizing
                    large-scale data platforms on Snowflake, Databricks, or the modern cloud stack.
                    Covers architecture review, migration strategy, governance design, and
                    technology selection. Delivered as structured engagements — not open-ended retainers.
                </p>
                <p class="engagement-card__for">For: VPs of Engineering, Chief Data Officers, and enterprise architecture teams.</p>
            </div>

            <div class="engagement-card">
                <span class="engagement-card__num">02</span>
                <h3 class="engagement-card__title">Keynote &amp; Technical Workshop</h3>
                <p class="engagement-card__desc">
                    Available for enterprise conferences, Snowflake community events, developer
                    summits, and corporate technical sessions. Topics span data architecture,
                    Snowflake at scale, AI in production, and systems thinking for data engineers.
                    Download the Speaking Kit for full topic descriptions and bios.
                </p>
                <p class="engagement-card__for">For: Conference organizers, event producers, and corporate learning teams.</p>
            </div>

            <div class="engagement-card">
                <span class="engagement-card__num">03</span>
                <h3 class="engagement-card__title">University Guest Lecture</h3>
                <p class="engagement-card__desc">
                    Guest lectures connecting current industry practice to academic theory —
                    available for doctoral seminars, master's programs, and undergraduate courses
                    in Computer Science, Data Engineering, and related fields. Brings real
                    architecture decisions and published research into the classroom.
                </p>
                <p class="engagement-card__for">For: Faculty, department chairs, and program directors at accredited universities.</p>
            </div>

            <div class="engagement-card">
                <span class="engagement-card__num">04</span>
                <h3 class="engagement-card__title">Snowflake Implementation Review</h3>
                <p class="engagement-card__desc">
                    A structured technical review of an existing or planned Snowflake implementation —
                    architecture patterns, cost efficiency, governance gaps, and optimization
                    opportunities. Delivered as a written assessment with specific, actionable
                    recommendations. Completed at the Advanced Certified Architect level.
                </p>
                <p class="engagement-card__for">For: Data engineering leads, platform teams, and Snowflake customers.</p>
            </div>

        </div>

        <!-- CONTACT -->
        <div class="contact-grid">

            <div>
                <span class="eyebrow">Send a Message</span>

                <?php if (function_exists('wpcf7')) :
                    echo do_shortcode('[contact-form-7 id="contact-form" title="Contact"]');
                else : ?>

                <form id="lujogre-contact-form" novalidate autocomplete="on">
                    <?php wp_nonce_field('lujogre_contact','lujogre_nonce'); ?>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div class="form-group">
                            <label for="cf-name">Full Name <span class="required">*</span></label>
                            <input id="cf-name" name="name" type="text" placeholder="Your full name" required autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="cf-email">Email <span class="required">*</span></label>
                            <input id="cf-email" name="email" type="email" placeholder="you@company.com" required autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cf-org">Organization</label>
                        <input id="cf-org" name="org" type="text" placeholder="Company or university" autocomplete="organization">
                    </div>

                    <div class="form-group">
                        <label for="cf-type">Engagement type</label>
                        <select id="cf-type" name="inquiry_type">
                            <option value="architecture">Enterprise Architecture Advisory</option>
                            <option value="speaking">Keynote / Technical Workshop</option>
                            <option value="lecture">University Guest Lecture</option>
                            <option value="snowflake">Snowflake Implementation Review</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cf-msg">Message <span class="required">*</span></label>
                        <textarea id="cf-msg" name="message" placeholder="Describe your project, event, or question." required></textarea>
                    </div>

                    <div id="lujogre-form-status" role="alert" aria-live="polite" style="font-size:.875rem;margin-bottom:10px;min-height:1.2em;"></div>

                    <button type="submit" class="btn btn--primary" style="width:100%;justify-content:center;">
                        Send Message
                    </button>
                    <p style="font-size:.73rem;color:var(--text-muted);margin-top:8px;text-align:center;">
                        Sent directly to
                        <a href="mailto:doctorg@lujogre.com">doctorg@lujogre.com</a>
                    </p>
                </form>

                <?php endif; ?>
            </div>

            <div>
                <span class="eyebrow">Contact Details</span>
                <div class="contact-info-list">
                    <a class="contact-info-row" href="mailto:doctorg@lujogre.com">
                        <div class="contact-info-row__label">Email</div>
                        <div class="contact-info-row__value">doctorg@lujogre.com</div>
                    </a>
                    <?php foreach ([
                        ['LinkedIn',           get_theme_mod('contact_linkedin','')],
                        ['GitHub',             get_theme_mod('contact_github','')],
                        ['YouTube',            get_theme_mod('contact_youtube','')],
                        ['Snowflake Community','https://community.snowflake.com'],
                    ] as [$label,$url]) :
                        if (!$url) continue; ?>
                    <a class="contact-info-row" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                        <div class="contact-info-row__label"><?php echo esc_html($label); ?></div>
                        <div class="contact-info-row__value"><?php echo esc_html(str_replace('https://','',rtrim($url,'/'))); ?></div>
                    </a>
                    <?php endforeach; ?>
                </div>

                <div class="address-block">
                    <p><strong>Luis Gonzalez</strong></p>
                    <p><?php echo esc_html(get_theme_mod('contact_address','P.O. Box 154, Monument, CO 80132')); ?></p>
                </div>

                <div class="contact-note">
                    I respond within one to two business days.
                    For time-sensitive requests, email
                    <a href="mailto:doctorg@lujogre.com">doctorg@lujogre.com</a> directly.
                </div>
            </div>

        </div>
    </div>
</section>

<script>
(function () {
    var form = document.getElementById('lujogre-contact-form');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var status  = document.getElementById('lujogre-form-status');
        var btn     = form.querySelector('button[type="submit"]');
        var s       = (typeof lujogre !== 'undefined') ? lujogre.strings : {};
        var data    = new FormData(form);
        data.append('action','lujogre_contact');
        btn.disabled = true;
        btn.textContent = s.sending || 'Sending…';
        status.textContent = '';
        fetch((typeof lujogre !== 'undefined' ? lujogre.ajaxurl : '/wp-admin/admin-ajax.php'),{method:'POST',body:data})
            .then(function(r){return r.json();})
            .then(function(res){
                if (res.success) { status.textContent = s.success || 'Message sent.'; status.style.color = 'var(--teal)'; form.reset(); }
                else { status.textContent = res.data || s.error || 'Something went wrong.'; status.style.color = '#e24b4a'; }
            })
            .catch(function(){ status.textContent = s.network || 'Network error. Please email doctorg@lujogre.com directly.'; status.style.color = '#e24b4a'; })
            .finally(function(){ btn.disabled = false; btn.textContent = 'Send Message'; });
    });
}());
</script>

<?php get_footer(); ?>
