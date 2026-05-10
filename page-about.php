<?php
/**
 * Template Name: About
 */
get_header(); ?>

<section class="section--dark" style="padding:64px 0 52px;">
    <div class="container">
        <div class="about-hero-row">
            <?php if (has_post_thumbnail()) : ?>
            <div class="about-avatar">
                <?php the_post_thumbnail('hero-avatar', ['alt'=>'Luis Gonzalez']); ?>
            </div>
            <?php else : ?>
            <div class="about-avatar-placeholder">LG</div>
            <?php endif; ?>
            <div>
                <h1 class="about-hero-name">Luis Gonzalez</h1>
                <p class="about-hero-role">
                    Snowflake Advanced Certified Architect &middot; Principal Data &amp; AI Architect &middot; Professor &middot; Researcher
                </p>
                <div class="about-tag-row">
                    <?php foreach (['PhD Computer Sciences','MBA Technology Management','MS Anthropology','Snowflake','Databricks','Generative AI','Kafka','Terraform','Python / Spark','Oracle','IEEE','ACM'] as $t) : ?>
                    <span class="about-tag"><?php echo esc_html($t); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="about-body-grid">

            <!-- NARRATIVE -->
            <div>
                <span class="eyebrow">My Story</span>
                <h2 class="section-title" style="font-size:1.75rem;margin-bottom:1.25rem;">
                    Architect, Researcher, Professor
                </h2>

                <?php if (trim(get_the_content())) :
                    the_content();
                else : ?>
                <p style="color:var(--text-sec);line-height:1.85;margin-bottom:1rem;">
                    My career began in relational databases and Oracle Applications supporting
                    mission-critical systems in demanding industries. Over two decades, that
                    foundation evolved into cloud engineering, AI, and modern data architecture.
                </p>
                <p style="color:var(--text-sec);line-height:1.85;margin-bottom:1rem;">
                    Today I work at the intersection of architecture, analytics, AI, and solution
                    strategy — helping organizations move from fragmented, costly systems to platforms
                    that deliver clarity, speed, and measurable outcomes.
                </p>
                <p style="color:var(--text-sec);line-height:1.85;margin-bottom:1rem;">
                    In parallel, I have taught computer science at the doctoral, master's, and
                    undergraduate levels at four universities since 2017. I mentor doctoral
                    candidates through dissertation development and build courses from scratch
                    when the right curriculum does not yet exist.
                </p>
                <?php endif; ?>

                <!-- PHILOSOPHY -->
                <h3 style="margin-top:2.25rem;margin-bottom:1rem;">Philosophy</h3>
                <div class="philosophy-block">
                    <p>
                        Data systems do not fail because of bad technology. They fail because the
                        humans who design them underestimate the complexity of the organizations they
                        are supposed to serve. My work sits at that intersection — building
                        architectures that are technically rigorous and organizationally legible.
                        The anthropologist in me asks who uses this system and why, and under what
                        pressures. The architect in me answers with structures that can absorb those
                        pressures without breaking. That combination is not accidental. It is the
                        only way I know how to build something that lasts.
                    </p>
                </div>

                <!-- CAREER TIMELINE -->
                <h3 style="margin-top:2.25rem;margin-bottom:1.25rem;">Career Timeline</h3>
                <div class="timeline">
                    <?php foreach ([
                        ['2003',        'Research in Bio-Inspired Computing',      '1st International Symposium on Bio-Inspired Computing, Johor, Malaysia — early NSA algorithm work'],
                        ['2005',        'PhD — Computer Sciences',                 'Nova Southeastern University, Fort Lauderdale, FL · Dissertation: Self-Adaptive Evolutionary Negative Selection for Anomaly Detection'],
                        ['2006',        'First Peer-Reviewed Publications',        'CSURF Proceedings · Caribbean Studies Conference · Congress on Evolutionary Computation'],
                        ['2015',        'MS Anthropology — UNISA',                 'University of South Africa, Pretoria · Dissertation on forced displacement among the Yukpa of Venezuela'],
                        ['2015 – 2016', 'Invited Speaker & Conference Presenter',  'Corporación Universitaria Americana, Colombia · American Association of Geographers, San Francisco'],
                        ['2017',        'Adjunct Professor — UMGC',                'University of Maryland Global Campus · Graduate-level databases and distributed systems'],
                        ['2021',        'Assistant Professor — Colorado Technical University', 'Doctoral courses in Business Intelligence and Big Data Analytics · Dissertation mentorship begins'],
                        ['2022',        'Adjunct Faculty — CSU Global',            'Colorado State University Global · Computer Science, Software Engineering, AI'],
                        ['2024',        'Adjunct Faculty — APUS',                  'American Public University System · Advanced Analytics and AI Product Design'],
                        ['2025',        'ACM CAIBDA Publication',                  'Immune-inspired anomaly detection for large-scale data quality — ACM proceedings, June 2025'],
                    ] as [$year,$title,$sub]) : ?>
                    <div class="tl-item">
                        <div class="tl-year"><?php echo esc_html($year); ?></div>
                        <div class="tl-title"><?php echo esc_html($title); ?></div>
                        <div class="tl-sub"><?php echo esc_html($sub); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- INTERESTS -->
                <h3 style="margin-top:2.25rem;margin-bottom:1rem;">Beyond the Work</h3>
                <div class="interests-block">
                    <span class="interests-label">Outside the Lab and Classroom</span>
                    <div class="interests-list">
                        <div class="interest-item">Traveling and absorbing new cultures</div>
                        <div class="interest-item">Photography</div>
                        <div class="interest-item">Reading across disciplines</div>
                        <div class="interest-item">Genealogy research</div>
                        <div class="interest-item">Piano</div>
                        <div class="interest-item">Community and mentorship</div>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR: CREDENTIALS -->
            <div>
                <span class="eyebrow">Credentials</span>
                <div class="cred-list" style="margin-bottom:2rem;">
                    <?php foreach ([
                        ['PhD, Computer Sciences',       'Nova Southeastern University'],
                        ['MBA, Technology Management',   'Graduate Business School'],
                        ['MS, Anthropology',             'University of South Africa (UNISA)'],
                        ['Snowflake Advanced Architect', 'Snowflake Inc.'],
                        ['Snowflake Data Engineer',      'Snowflake Inc.'],
                        ['IEEE Member',                  'Institute of Electrical and Electronics Engineers'],
                        ['ACM Member',                   'Association for Computing Machinery'],
                    ] as [$name,$issuer]) : ?>
                    <div class="cred-card">
                        <div class="cred-card__name"><?php echo esc_html($name); ?></div>
                        <div class="cred-card__issuer"><?php echo esc_html($issuer); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- PUBLISHED WORKS -->
                <div style="margin-bottom:2rem;">
                    <span class="eyebrow">Published Works</span>

                    <div class="books-grid" style="grid-template-columns:1fr;">

                        <a class="book-card"
                           href="https://www.amazon.com/Navigating-Waterfalls-Matrimonial-Storm-Interior/dp/B0GCLJHN5S/"
                           target="_blank"
                           rel="noopener noreferrer">
                            <div class="book-card__cover">
                                <img src="<?php echo esc_url(LUJOGRE_URI . '/assets/images/book-navigating-waterfalls.jpg'); ?>"
                                     alt="Navigating Waterfalls book cover"
                                     width="80"
                                     loading="lazy">
                            </div>
                            <div class="book-card__body">
                                <span class="book-card__lang">English</span>
                                <div class="book-card__title">Navigating Waterfalls</div>
                                <div class="book-card__subtitle">From Matrimonial Storm to Interior Calm</div>
                                <span class="book-card__link">View on Amazon</span>
                            </div>
                        </a>

                        <a class="book-card"
                           href="https://www.amazon.com/s?k=Navegando+Cascadas+Luis+Gonzalez"
                           target="_blank"
                           rel="noopener noreferrer">
                            <div class="book-card__cover">
                                <img src="<?php echo esc_url(LUJOGRE_URI . '/assets/images/book-navegando-cascadas.jpg'); ?>"
                                     alt="Navegando Cascadas book cover"
                                     width="80"
                                     loading="lazy">
                            </div>
                            <div class="book-card__body">
                                <span class="book-card__lang">Spanish</span>
                                <div class="book-card__title">Navegando Cascadas</div>
                                <div class="book-card__subtitle">De la Tormenta Matrimonial a la Calma Interior</div>
                                <span class="book-card__link">View on Amazon</span>
                            </div>
                        </a>

                    </div>
                </div>

                <span class="eyebrow">Résumé</span>
                <p style="font-size:.875rem;color:var(--text-sec);margin-bottom:12px;">
                    Download a current PDF version of my CV.
                </p>
                <?php $resume = get_theme_mod('resume_url',''); ?>
                <?php if ($resume) : ?>
                <a href="<?php echo esc_url($resume); ?>" class="btn btn--primary" download>Download Résumé</a>
                <?php else : ?>
                <a href="<?php echo esc_url(home_url('/work-with-me')); ?>" class="btn btn--outline">Request via Contact</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
