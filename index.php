<?php get_header(); ?>

<section class="section--dark" style="padding:52px 0 40px;">
    <div class="container">
        <span class="eyebrow">Writing &amp; Ideas</span>
        <h1 style="color:#fff;font-family:var(--serif);font-size:2rem;margin-bottom:.5rem;">
            <?php if (is_category()) single_cat_title();
            elseif (is_tag())        single_tag_title();
            elseif (is_search())     printf('Search: &ldquo;%s&rdquo;', get_search_query());
            else                     _e('Blog','lujogre'); ?>
        </h1>
        <p style="color:rgba(255,255,255,.5);max-width:480px;font-size:.95rem;">
            Architecture, data engineering, AI research, teaching, and the occasional thought on how systems — technical and human — behave under pressure.
        </p>
    </div>
</section>

<div style="padding:10px 0;border-bottom:1px solid var(--border);overflow-x:auto;">
    <div class="container">
        <div style="display:flex;gap:6px;flex-wrap:wrap;">
            <a href="<?php echo esc_url(home_url('/blog')); ?>"
               style="<?php echo !is_category()?'background:var(--blue);color:#fff;border-color:var(--blue);':'background:var(--bg-alt);color:var(--text-sec);';?>padding:4px 14px;border-radius:20px;font-size:.74rem;font-weight:500;text-decoration:none;border:1px solid var(--border);">All</a>
            <?php foreach (get_categories(['hide_empty'=>true]) as $cat) :
                $active = is_category($cat->term_id); ?>
            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
               style="<?php echo $active?'background:var(--blue);color:#fff;border-color:var(--blue);':'background:var(--bg-alt);color:var(--text-sec);';?>padding:4px 14px;border-radius:20px;font-size:.74rem;font-weight:500;text-decoration:none;border:1px solid var(--border);">
               <?php echo esc_html($cat->name); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
        <div class="grid-3">
        <?php
        $thumbs = ['blue','teal','amber','slate','navy'];
        $i = 0;
        while (have_posts()) : the_post();
            $cats  = get_the_category();
            $thumb = $thumbs[$i++ % count($thumbs)];
        ?>
            <article class="post-card">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-card'); ?></a>
                <?php else : ?>
                    <a class="post-card__thumb post-card__thumb--<?php echo esc_attr($thumb); ?>"
                       href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"></a>
                <?php endif; ?>
                <div class="post-card__body">
                    <span class="post-card__cat"><?php echo $cats ? esc_html($cats[0]->name) : ''; ?></span>
                    <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="post-card__meta"><?php echo get_the_date(); ?></p>
                </div>
            </article>
        <?php endwhile; ?>
        </div>
        <div style="display:flex;justify-content:center;margin-top:3rem;">
            <?php the_posts_pagination(['prev_text'=>'Newer','next_text'=>'Older']); ?>
        </div>
        <?php else : ?>
        <p style="color:var(--text-sec);text-align:center;padding:3rem 0;">
            No posts yet. <a href="<?php echo esc_url(home_url('/snowflake')); ?>">Read the Snowflake articles</a>.
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
