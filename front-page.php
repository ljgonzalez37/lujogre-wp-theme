<?php
/**
 * Template Name: Home Page
 * lujogre.com · Luis Gonzalez · v3
 */
get_header(); ?>

<!-- HERO -->
<section class="hero" aria-labelledby="hero-headline">
    <div class="container">
        <div class="hero__inner">

            <span class="eyebrow">
                <?php echo wp_kses_post(get_theme_mod('hero_eyebrow',
                    'Snowflake Advanced Certified Architect &middot; Principal Data &amp; AI Architect')); ?>
            </span>

            <h1 class="hero__title" id="hero-headline">
                <?php echo wp_kses_post(get_theme_mod('hero_headline',
                    'I build platforms that deliver <em>clarity, speed,</em> and lasting outcomes.')); ?>
            </h1>

            <p class="hero__sub">
                <?php echo wp_kses_post(get_theme_mod('hero_sub',
                    'With a foundation spanning computer science, enterprise data architecture, and human systems research, I help organizations turn fragmented data into platforms that actually perform.')); ?>
            </p>

            <div class="hero__actions">
                <a href="<?php echo esc_url(home_url('/portfolio')); ?>"    class="btn btn--primary">View My Work</a>
                <a href="<?php echo esc_url(home_url('/snowflake')); ?>"    class="btn btn--ghost">Snowflake Articles</a>
                <a href="<?php echo esc_url(home_url('/speaking-kit')); ?>" class="btn btn--ghost">Speaking Kit</a>
            </div>

        </div>
    </div>
</section>

<!-- CREDENTIAL STRIP -->
<div class="cred-strip">
    <div class="container">
        <span class="cred-strip__item cred-strip__item--blue">Snowflake Advanced Certified Architect</span>
        <span class="cred-strip__dot"></span>
        <span class="cred-strip__item">ACM &amp; IEEE Researcher</span>
        <span class="cred-strip__dot"></span>
        <!-- Universities named and linked, ordered by seniority -->
        <?php
        $unis = lujogre_universities();
        $total = count($unis);
        foreach ($unis as $i => $uni) : ?>
        <a href="<?php echo esc_url($uni['url']); ?>"
           class="cred-strip__item cred-strip__link"
           target="_blank"
           rel="noopener noreferrer"><?php echo esc_html($uni['abbr']); ?></a><?php
            if ($i < $total - 1) echo '<span class="cred-strip__sep">&middot;</span>';
        endforeach; ?>
        <span class="cred-strip__dot"></span>
        <span class="cred-strip__item">PhD &middot; MBA &middot; MS Anthropology</span>
    </div>
</div>

<!-- ABOUT STRIP -->
<section class="section">
    <div class="container">
        <div class="home-about-grid">

            <div>
                <?php $avatar_id = get_theme_mod('hero_avatar_id');
                if ($avatar_id) :
                    echo wp_get_attachment_image($avatar_id, 'hero-avatar', false, [
                        'class' => 'home-avatar-img',
                        'alt'   => 'Luis Gonzalez',
                    ]);
                else : ?>
                <div class="home-avatar-placeholder">LG</div>
                <?php endif; ?>
                <div class="home-avatar-caption">
                    <div class="home-avatar-name">Luis Gonzalez</div>
                    <div class="home-avatar-meta">PhD &middot; MBA &middot; MS Anthropology</div>
                    <div class="home-avatar-domain">lujogre.com</div>
                </div>
            </div>

            <div>
                <span class="eyebrow">Welcome</span>
                <h2 class="section-title" style="margin-bottom:1rem;">
                    A Different Kind of Architect
                </h2>
                <p style="color:var(--text-sec);font-size:1rem;line-height:1.8;margin-bottom:1rem;">
                    Most data architects understand technology. Fewer understand the organizations
                    that technology is supposed to serve. My background in computer science and
                    anthropology gives me both — which is why the platforms I build tend to last.
                </p>
                <p style="color:var(--text-sec);font-size:1rem;line-height:1.8;margin-bottom:1.5rem;">
                    I also teach at four universities, mentor doctoral candidates through dissertation
                    development, and write seriously about Snowflake at the Advanced Architect level.
                    I am also the author of
                    <a href="https://www.amazon.com/Navigating-Waterfalls-Matrimonial-Storm-Interior/dp/B0GCLJHN5S/"
                       target="_blank" rel="noopener noreferrer"
                       style="color:var(--blue);"><em>Navigating Waterfalls</em></a>
                    and its Spanish edition
                    <a href="https://www.amazon.com/s?k=Navegando+Cascadas+Luis+Gonzalez"
                       target="_blank" rel="noopener noreferrer"
                       style="color:var(--blue);"><em>Navegando Cascadas</em></a>.
                    If you are looking for someone who thinks architecturally and communicates at the
                    human level, we should talk.
                </p>
                <div class="btn-group">
                    <a href="<?php echo esc_url(home_url('/about')); ?>"        class="btn btn--primary">My Full Story</a>
                    <a href="<?php echo esc_url(home_url('/work-with-me')); ?>"  class="btn btn--outline">Work With Me</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- THREE OUTCOME CARDS -->
<section class="section section--alt">
    <div class="container">
        <span class="eyebrow">What I Do</span>
        <h2 class="section-title">Three Areas of Serious Work</h2>

        <div class="grid-3">

            <div class="card">
                <span class="card__eyebrow">Enterprise Architecture</span>
                <h3 class="card__title">Data Platforms That Perform</h3>
                <p class="card__desc">
                    Snowflake, Databricks, Kafka, Terraform, and the full modern stack.
                    From petabyte-scale migrations to real-time streaming architectures —
                    designed for performance, governed for scale, built to last.
                </p>
                <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="card__link">View Portfolio</a>
            </div>

            <div class="card">
                <span class="card__eyebrow">Snowflake</span>
                <h3 class="card__title">Advanced-Level Technical Writing</h3>
                <p class="card__desc">
                    Architecture decisions, Cortex AI patterns, data quality methods,
                    and production trade-offs — written at the Advanced Certified Architect level
                    for practitioners who need more than surface coverage.
                </p>
                <a href="<?php echo esc_url(home_url('/snowflake')); ?>" class="card__link">Read the Articles</a>
            </div>

            <div class="card">
                <span class="card__eyebrow">Research &amp; Teaching</span>
                <h3 class="card__title">Academic Work at Four Universities</h3>
                <p class="card__desc">
                    Doctoral, master's, and undergraduate instruction in Computer Science,
                    Big Data, and Data Engineering. Published research in ACM and IEEE.
                    Dissertation mentorship for doctoral candidates.
                </p>
                <a href="<?php echo esc_url(home_url('/research')); ?>" class="card__link">Research &amp; Teaching</a>
            </div>

        </div>
    </div>
</section>

<!-- UNIVERSITIES STRIP -->
<section class="section section--border">
    <div class="container">
        <span class="eyebrow">Academic Appointments</span>
        <h2 class="section-title" style="margin-bottom:1.5rem;">Teaching at Four Universities</h2>
        <div class="uni-grid">
            <?php foreach (lujogre_universities() as $uni) : ?>
            <div class="uni-card">
                <div class="uni-card__role"><?php echo esc_html($uni['role']); ?></div>
                <div class="uni-card__name">
                    <a href="<?php echo esc_url($uni['url']); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       style="color:inherit;text-decoration:none;border-bottom:1px solid rgba(41,181,232,.3);padding-bottom:1px;transition:border-color .15s;"
                       onmouseover="this.style.borderColor='var(--blue)'"
                       onmouseout="this.style.borderColor='rgba(41,181,232,.3)'"><?php echo esc_html($uni['name']); ?></a>
                </div>
                <div class="uni-card__tenure"><?php echo wp_kses_post($uni['tenure']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- LATEST BLOG -->
<section class="section">
    <div class="container">
        <span class="eyebrow">Latest Writing</span>
        <h2 class="section-title">From the Blog</h2>

        <?php
        $posts  = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3]);
        $thumbs = ['blue', 'teal', 'amber', 'slate', 'navy'];
        $i = 0;
        if ($posts->have_posts()) : ?>
        <div class="grid-3">
        <?php while ($posts->have_posts()) : $posts->the_post();
            $cats  = get_the_category();
            $thumb = $thumbs[$i++ % count($thumbs)]; ?>
            <article class="post-card">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-card'); ?></a>
                <?php else : ?>
                    <a class="post-card__thumb post-card__thumb--<?php echo esc_attr($thumb); ?>"
                       href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"></a>
                <?php endif; ?>
                <div class="post-card__body">
                    <span class="post-card__cat"><?php echo $cats ? esc_html($cats[0]->name) : 'Blog'; ?></span>
                    <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="post-card__meta"><?php echo get_the_date(); ?></p>
                </div>
            </article>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p style="color:var(--text-sec);">
            Articles are published regularly. In the meantime,
            <a href="<?php echo esc_url(home_url('/snowflake')); ?>">explore the Snowflake articles</a>.
        </p>
        <?php endif; ?>

        <div class="section-cta">
            <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn--outline">View All Posts</a>
        </div>
    </div>
</section>

<!-- SPEAKING CTA -->
<section class="section section--dark">
    <div class="container text-center">
        <span class="eyebrow eyebrow--gold">Speaking &amp; Events</span>
        <h2 style="color:#fff;font-family:var(--serif);font-size:clamp(1.6rem,3.5vw,2.1rem);margin-bottom:.75rem;">
            Available for Keynotes, Workshops,<br>and Guest Lectures
        </h2>
        <p style="color:rgba(255,255,255,.55);max-width:520px;margin:0 auto 2rem;font-size:1rem;line-height:1.7;">
            I speak at enterprise conferences, Snowflake community events, and university programs.
            Download the speaking kit or get in touch to discuss your event.
        </p>
        <div class="btn-group" style="justify-content:center;">
            <a href="<?php echo esc_url(home_url('/speaking-kit')); ?>"  class="btn btn--primary">Speaking Kit</a>
            <a href="<?php echo esc_url(home_url('/work-with-me')); ?>" class="btn btn--ghost">Get in Touch</a>
        </div>
    </div>
</section>

<!-- DOMAIN NOTE -->
<div class="section section--sm section--border">
    <div class="container">
        <p class="domain-note">
            lujogre.com is the professional home of Luis Gonzalez —
            Snowflake Advanced Certified Architect, Principal Data &amp; AI Architect,
            Professor, and Researcher.
        </p>
    </div>
</div>

<?php get_footer(); ?>
