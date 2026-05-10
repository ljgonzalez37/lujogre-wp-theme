<?php
/**
 * Template Name: Research
 * Uses lujogre_universities() from functions.php — single source of truth.
 */
get_header(); ?>

<section class="section--dark" style="padding:64px 0 52px;">
    <div class="container">
        <span class="eyebrow eyebrow--gold">Professor &middot; Researcher &middot; Mentor</span>
        <h1 style="color:#fff;font-family:var(--serif);font-size:2.2rem;margin-bottom:.5rem;">Research &amp; Teaching</h1>
        <p style="color:rgba(255,255,255,.55);max-width:540px;font-size:1rem;line-height:1.65;">
            Peer-reviewed research spanning artificial immune systems, data quality, anomaly detection,
            and cultural anthropology. Teaching at the doctoral, master's, and undergraduate levels
            at four universities since 2017.
        </p>
    </div>
</section>

<!-- UNIVERSITIES -->
<section class="section" id="universities">
    <div class="container">

        <span class="eyebrow">Academic Appointments</span>
        <h2 class="section-title">Where I Teach</h2>
        <p style="color:var(--text-sec);font-size:.95rem;max-width:580px;margin-bottom:2rem;line-height:1.7;">
            Ordered by seniority of role and tenure. All positions are remote and ongoing.
        </p>

        <?php
        $uq = new WP_Query(['post_type'=>'course','posts_per_page'=>8,'orderby'=>'menu_order','order'=>'ASC']);
        if ($uq->have_posts()) :
            echo '<div class="uni-grid" style="margin-bottom:3.5rem;">';
            while ($uq->have_posts()) : $uq->the_post();
                $role   = get_post_meta(get_the_ID(),'_role',true)       ?: 'Adjunct Faculty';
                $uni    = get_post_meta(get_the_ID(),'_university',true) ?: get_the_title();
                $tenure = get_post_meta(get_the_ID(),'_tenure',true)     ?: '';
                $url    = get_post_meta(get_the_ID(),'_university_url',true) ?: ''; ?>
            <div class="uni-card">
                <div class="uni-card__role"><?php echo esc_html($role); ?></div>
                <div class="uni-card__name">
                    <?php if ($url) : ?>
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($uni); ?></a>
                    <?php else : echo esc_html($uni); endif; ?>
                </div>
                <?php if ($tenure) : ?><div class="uni-card__tenure"><?php echo esc_html($tenure); ?></div><?php endif; ?>
                <div class="uni-card__courses"><?php the_excerpt(); ?></div>
            </div>
            <?php endwhile;
            echo '</div>';
            wp_reset_postdata();
        else :
            // Fallback from lujogre_universities() — single source of truth
        ?>
        <div class="uni-grid" style="margin-bottom:3.5rem;">
            <?php foreach (lujogre_universities() as $uni) : ?>
            <div class="uni-card">
                <div class="uni-card__role"><?php echo esc_html($uni['role']); ?></div>
                <div class="uni-card__name">
                    <a href="<?php echo esc_url($uni['url']); ?>"
                       target="_blank"
                       rel="noopener noreferrer"><?php echo esc_html($uni['name']); ?></a>
                </div>
                <div class="uni-card__tenure"><?php echo wp_kses_post($uni['tenure']); ?></div>
                <div class="uni-card__courses"><?php echo esc_html($uni['courses']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- TEACHING PHILOSOPHY -->
        <span class="eyebrow">Teaching Philosophy</span>
        <h2 class="section-title">Why Architecture Matters</h2>
        <div class="grid-3" style="margin-bottom:3.5rem;">
            <div class="card">
                <h3 class="card__title" style="font-family:var(--sans);font-size:1rem;">Systems Thinking First</h3>
                <p class="card__desc">Every course begins with the why. Students learn to reason about trade-offs — architectural, computational, and organizational — before they write a single line of code.</p>
            </div>
            <div class="card">
                <h3 class="card__title" style="font-family:var(--sans);font-size:1rem;">Industry-Grounded</h3>
                <p class="card__desc">Real architectures, real failures, real wins. Case studies drawn from enterprise projects and peer-reviewed research — not examples that age within a semester.</p>
            </div>
            <div class="card">
                <h3 class="card__title" style="font-family:var(--sans);font-size:1rem;">Mentor-Led</h3>
                <p class="card__desc">Dissertation guidance, career coaching, and sustained engagement beyond the syllabus. The relationship does not end when the semester does.</p>
            </div>
        </div>

        <!-- PUBLICATIONS -->
        <span class="eyebrow" id="publications">Publications &amp; Presentations</span>
        <h2 class="section-title">Peer-Reviewed Work</h2>

        <?php
        $pq = new WP_Query(['post_type'=>'publication','posts_per_page'=>20]);
        if ($pq->have_posts()) :
            echo '<div class="pub-list">';
            while ($pq->have_posts()) : $pq->the_post();
                $year  = get_post_meta(get_the_ID(),'_pub_year',true);
                $venue = get_post_meta(get_the_ID(),'_pub_venue',true); ?>
            <div class="pub-card">
                <div class="pub-card__year"><?php echo esc_html($year ?: '—'); ?></div>
                <div>
                    <div class="pub-card__venue"><?php echo esc_html($venue); ?></div>
                    <div class="pub-card__title"><?php the_title(); ?></div>
                    <div class="pub-card__desc"><?php the_excerpt(); ?></div>
                </div>
            </div>
            <?php endwhile;
            echo '</div>';
            wp_reset_postdata();
        else : ?>
        <div class="pub-list">

            <div class="pub-card">
                <div class="pub-card__year">2025</div>
                <div>
                    <div class="pub-card__venue">ACM &middot; CAIBDA '25 &middot; June 15, 2025</div>
                    <div class="pub-card__title">Immune-inspired, statistically-validated anomaly detection for data quality assurance in large-scale data engineering</div>
                    <div class="pub-card__desc">Novel immune-inspired anomaly detection algorithm grounded in the negative selection algorithm (NSA) with statistical validation. Processes 6 million rows in under 2 seconds. Outperforms Isolation Forest, LOF, DBSCAN, and autoencoders on structural (100%), date (75.08%), and value-based anomalies (49.16%). <em>Proceedings of the 2025 5th International Conference on Artificial Intelligence, Big Data and Algorithms. ACM.</em></div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2016</div>
                <div>
                    <div class="pub-card__venue">American Association of Geographers Annual Meeting &middot; San Francisco</div>
                    <div class="pub-card__title">Cultural Effects of Forced Displacement Among the Yukpa of Maracaibo, Venezuela</div>
                    <div class="pub-card__desc">Ethnographic research examining cultural disruption caused by the involuntary displacement of the Yukpa indigenous people from the Sierra de Perija to the city of Maracaibo.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2015</div>
                <div>
                    <div class="pub-card__venue">Invited Speaker &middot; Corporación Universitaria Americana &middot; Barranquilla, Colombia</div>
                    <div class="pub-card__title">Sistemas Inmunitarios Artificiales: Teoría Básica y Aplicaciones</div>
                    <div class="pub-card__desc">Invited lecture on Artificial Immune Systems — biomimetic principles, clonal selection, immune network theories, and computational applications for complex problem-solving.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2015</div>
                <div>
                    <div class="pub-card__venue">MS Dissertation &middot; University of South Africa (UNISA) &middot; Pretoria</div>
                    <div class="pub-card__title">An Exploratory Study of Forced Displacement and Some Cultural Consequences among the Yukpa of Maracaibo, Venezuela</div>
                    <div class="pub-card__desc">Ethnographic study examining cultural disruption, current needs, and providing a biographical profile of the Yukpa settled in Maracaibo with policy recommendations.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2006</div>
                <div>
                    <div class="pub-card__venue">CSURF '06 &middot; Colorado Springs Undergraduate Research Forum</div>
                    <div class="pub-card__title">Indians, Blacks, Heroes, and the Cult of Maria Lionza</div>
                    <div class="pub-card__desc">Anthropological analysis of Venezuelan syncretic religious traditions and the cultural construction of identity through devotional practice.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2006</div>
                <div>
                    <div class="pub-card__venue">International Conference on Caribbean Studies &middot; University of Texas Pan American</div>
                    <div class="pub-card__title">The Aesthetic of the Chimbángueles of San Benito</div>
                    <div class="pub-card__desc">Anthropological and artistic analysis of the Chimbángueles drums used by Afro-Venezuelan communities. Examines psychological, religious, social, and educational dimensions of the tradition honoring San Benito de Palermo.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2005</div>
                <div>
                    <div class="pub-card__venue">1st International Symposium on Bio-Inspired Computing &middot; Johor, Malaysia</div>
                    <div class="pub-card__title">A convergence analysis of a self-adaptive evolutionary negative selection algorithm</div>
                    <div class="pub-card__desc">Formal convergence analysis of SANSAD — establishing theoretical properties of the self-adaptive evolutionary negative selection approach for anomaly detection in complex systems.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2005</div>
                <div>
                    <div class="pub-card__venue">PhD Thesis &middot; Nova Southeastern University &middot; Fort Lauderdale, FL</div>
                    <div class="pub-card__title">A Self-Adaptive Evolutionary Negative Selection Approach for Anomaly Detection</div>
                    <div class="pub-card__desc">Doctoral dissertation developing SANSAD — a self-adaptive evolutionary negative selection algorithm inspired by the thymic negative selection process in natural immune systems.</div>
                </div>
            </div>

            <div class="pub-card">
                <div class="pub-card__year">2004</div>
                <div>
                    <div class="pub-card__venue">Congress on Evolutionary Computation &middot; Portland, Oregon</div>
                    <div class="pub-card__title">A self-adaptive negative selection approach for anomaly detection</div>
                    <div class="pub-card__desc">Early presentation of the negative selection framework establishing the theoretical foundation for subsequent doctoral research and the 2025 ACM publication.</div>
                </div>
            </div>

        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
