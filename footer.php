</div><!-- /.page-content-wrap -->

<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer-grid">

            <div>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                    <img src="<?php echo esc_url(LUJOGRE_URI . '/assets/images/logo-white.svg'); ?>"
                         alt="lujogre.com — Luis Gonzalez"
                         width="200" height="38"
                         loading="lazy">
                </a>
                <p class="footer-desc">
                    Snowflake Advanced Certified Architect &middot; Principal Data &amp; AI Architect &middot;
                    Professor at four universities &middot; Researcher.
                </p>
                <div class="footer-social-row">
                    <?php
                    $socials = [
                        ['LinkedIn',            get_theme_mod('contact_linkedin', '')],
                        ['GitHub',              get_theme_mod('contact_github',   '')],
                        ['YouTube',             get_theme_mod('contact_youtube',  '')],
                        ['Snowflake Community', 'https://community.snowflake.com'],
                        ['IEEE',                'https://ieee.org'],
                        ['ACM',                 'https://acm.org'],
                    ];
                    foreach ($socials as [$label, $url]) :
                        if (!$url) continue; ?>
                    <a href="<?php echo esc_url($url); ?>"
                       class="footer-social-link"
                       target="_blank"
                       rel="noopener noreferrer"><?php echo esc_html($label); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="footer-col">
                <h4>Navigate</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/snowflake')); ?>">Snowflake</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/research')); ?>">Research</a></li>
                    <li><a href="<?php echo esc_url(home_url('/speaking-kit')); ?>">Speaking Kit</a></li>
                    <li><a href="<?php echo esc_url(home_url('/portfolio')); ?>">Portfolio</a></li>
                    <li><a href="<?php echo esc_url(home_url('/work-with-me')); ?>">Work With Me</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Universities</h4>
                <ul>
                    <?php foreach (lujogre_universities() as $uni) : ?>
                    <li>
                        <a href="<?php echo esc_url($uni['url']); ?>"
                           target="_blank"
                           rel="noopener noreferrer"><?php echo esc_html($uni['abbr']); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li>
                        <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'doctorg@lujogre.com')); ?>">
                            <?php echo esc_html(get_theme_mod('contact_email', 'doctorg@lujogre.com')); ?>
                        </a>
                    </li>
                    <li class="footer-address">
                        <?php echo esc_html(get_theme_mod('contact_address', 'P.O. Box 154, Monument, CO 80132')); ?>
                    </li>
                    <li><a href="<?php echo esc_url(home_url('/work-with-me')); ?>">Work With Me</a></li>
                    <li><a href="<?php echo esc_url(home_url('/speaking-kit')); ?>">Speaking Kit</a></li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <span class="footer-bottom__copy">
                &copy; <?php echo esc_html(date('Y')); ?> Luis Gonzalez &mdash; lujogre.com. All rights reserved.
            </span>
            <span class="footer-bottom__creds">
                PhD &middot; MBA &middot; MS Anthropology &middot; Snowflake Advanced Certified Architect &middot; Author
            </span>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
