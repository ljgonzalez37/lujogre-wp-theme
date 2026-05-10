<?php
/**
 * Template Name: Portfolio
 */
get_header(); ?>

<section class="section--dark" style="padding:64px 0 52px;">
    <div class="container">
        <span class="eyebrow eyebrow--teal">Architecture &middot; AI Systems &middot; Data Platforms</span>
        <h1 style="color:#fff;font-family:var(--serif);font-size:2.2rem;margin-bottom:.5rem;">Selected Work</h1>
        <p style="color:rgba(255,255,255,.55);max-width:500px;">
            Petabyte-scale architectures, AI systems, Data Mesh transformations, and Snowflake solutions —
            with quantified outcomes.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php
        $pq  = new WP_Query(['post_type'=>'portfolio','posts_per_page'=>12,'orderby'=>'menu_order','order'=>'ASC']);
        $vcs = ['blue','green','purple','slate'];
        $i   = 0;
        if ($pq->have_posts()) :
            echo '<div class="grid-2">';
            while ($pq->have_posts()) : $pq->the_post();
                $outcome = get_post_meta(get_the_ID(),'_outcome',true);
                $tech    = get_post_meta(get_the_ID(),'_tech_stack_list',true);
                $vc      = get_post_meta(get_the_ID(),'_visual_class',true) ?: $vcs[$i % 4];
                $techs   = $tech ? array_map('trim',explode(',',$tech)) : [];
                $i++;
        ?>
            <article class="portfolio-card">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('portfolio-thumb',['style'=>'width:100%;height:130px;object-fit:cover;']); ?></a>
                <?php else : ?>
                    <a class="portfolio-card__visual portfolio-card__visual--<?php echo esc_attr($vc); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php endif; ?>
                <div class="portfolio-card__body">
                    <div class="portfolio-card__title"><?php the_title(); ?></div>
                    <?php if ($outcome) : ?><div class="portfolio-card__outcome"><?php echo esc_html($outcome); ?></div><?php endif; ?>
                    <?php if ($techs) : ?><div class="tech-list"><?php foreach ($techs as $t) : ?><span class="tech-pill"><?php echo esc_html($t); ?></span><?php endforeach; ?></div><?php endif; ?>
                </div>
            </article>
        <?php endwhile; echo '</div>'; wp_reset_postdata();
        else : ?>
        <div class="grid-2">
            <?php foreach ([
                ['blue',   'Snowflake Enterprise Migration &middot; Energy Sector',  'Snowflake Enterprise Migration',     'Legacy EDW to Snowflake &middot; 3.2 PB &middot; 60% cost reduction',                        'Snowflake,dbt,Terraform,Kafka'],
                ['green',  'RAG + Cortex AI Platform &middot; Financial Services',  'Cortex RAG Platform',                'Document intelligence over 40M+ records &middot; sub-2s query latency',                       'Snowflake Cortex,Arctic Embed,Python'],
                ['purple', 'Immune-Inspired Anomaly Detection &middot; ACM 2025',   'Data Quality AI System',             'NSA-based algorithm &middot; 6M rows in under 2 seconds &middot; 100% structural detection',   'Python,Snowflake,NSA Algorithm,TPC-H'],
                ['slate',  'Kafka to Snowflake Streaming &middot; Retail',          'Real-Time Streaming Platform',       '10M+ events per day &middot; Confluent + Snowpipe Streaming',                                  'Kafka,Confluent,Snowpipe,Spark'],
            ] as [$vc,$vl,$title,$outcome,$tech]) :
                $techs = explode(',',$tech); ?>
            <div class="portfolio-card">
                <div class="portfolio-card__visual portfolio-card__visual--<?php echo $vc; ?>"><?php echo $vl; ?></div>
                <div class="portfolio-card__body">
                    <div class="portfolio-card__title"><?php echo esc_html($title); ?></div>
                    <div class="portfolio-card__outcome"><?php echo $outcome; ?></div>
                    <div class="tech-list"><?php foreach ($techs as $t) : ?><span class="tech-pill"><?php echo esc_html(trim($t)); ?></span><?php endforeach; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
