<?php get_header(); the_post(); $cats = get_the_category(); ?>

<section class="section--dark" style="padding:56px 0 44px;">
    <div class="container" style="max-width:820px;">
        <?php if ($cats) : ?><span class="eyebrow"><?php echo esc_html($cats[0]->name); ?></span><?php endif; ?>
        <h1 style="color:#fff;font-size:clamp(1.6rem,4vw,2.4rem);margin-bottom:1rem;font-family:var(--serif);"><?php the_title(); ?></h1>
        <div style="display:flex;align-items:center;gap:14px;color:rgba(255,255,255,.48);font-size:.82rem;flex-wrap:wrap;">
            <span><?php echo get_the_date(); ?></span>
            <span style="opacity:.4;">&middot;</span>
            <span>Luis Gonzalez</span>
            <?php $tags = get_the_tags(); if ($tags) : ?>
            <span style="opacity:.4;">&middot;</span>
            <div style="display:flex;gap:5px;flex-wrap:wrap;">
                <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                   style="background:rgba(41,181,232,.15);color:var(--blue);font-size:.68rem;padding:2px 8px;border-radius:3px;font-weight:500;text-decoration:none;">
                    <?php echo esc_html($tag->name); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if (has_post_thumbnail()) : ?>
<div style="max-width:820px;margin:0 auto;padding:0 24px;">
    <?php the_post_thumbnail('full',['style'=>'width:100%;height:auto;border-radius:0 0 var(--r-lg) var(--r-lg);']); ?>
</div>
<?php endif; ?>

<section class="section section--sm">
    <div class="container" style="max-width:760px;">
        <div class="post-content"><?php the_content(); ?></div>

        <div style="display:flex;align-items:flex-start;gap:16px;margin-top:3rem;padding-top:2rem;border-top:1px solid var(--border);">
            <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--teal));display:flex;align-items:center;justify-content:center;font-family:var(--serif);font-size:1.05rem;color:#fff;flex-shrink:0;">LG</div>
            <div>
                <div style="font-weight:600;margin-bottom:3px;font-size:.92rem;">Luis Gonzalez</div>
                <div style="font-size:.82rem;color:var(--text-sec);line-height:1.55;">
                    Snowflake Advanced Certified Architect &middot; Principal Data &amp; AI Architect &middot; Professor &middot; Researcher &middot; lujogre.com
                </div>
            </div>
        </div>

        <div style="display:flex;justify-content:space-between;gap:20px;margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid var(--border);">
            <?php $prev = get_previous_post(); $next = get_next_post();
            if ($prev) : ?>
            <a href="<?php echo esc_url(get_permalink($prev)); ?>" style="font-size:.875rem;color:var(--text-sec);text-decoration:none;max-width:48%;">&larr; <?php echo esc_html($prev->post_title); ?></a>
            <?php endif;
            if ($next) : ?>
            <a href="<?php echo esc_url(get_permalink($next)); ?>" style="font-size:.875rem;color:var(--text-sec);text-decoration:none;text-align:right;max-width:48%;margin-left:auto;"><?php echo esc_html($next->post_title); ?> &rarr;</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
