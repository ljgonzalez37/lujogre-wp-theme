<?php
/**
 * Template Name: Speaking Kit
 */
get_header(); ?>

<section class="section--dark" style="padding:64px 0 52px;position:relative;overflow:hidden;">
    <div class="container">
        <span class="eyebrow eyebrow--gold">For Event Organizers</span>
        <h1 style="color:#fff;font-family:var(--serif);font-size:2.2rem;margin-bottom:.75rem;">Speaking Kit</h1>
        <p style="color:rgba(255,255,255,.55);max-width:500px;line-height:1.65;">
            Everything you need to book Luis Gonzalez for a keynote, technical workshop,
            or guest lecture — bios, topics, past venues, and technical requirements.
        </p>
        <?php $pdf = get_theme_mod('speaking_pdf_url',''); if ($pdf) : ?>
        <div style="margin-top:1.5rem;">
            <a href="<?php echo esc_url($pdf); ?>" class="btn btn--gold" download>Download Speaking Brief (PDF)</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">

        <!-- BIOS -->
        <span class="eyebrow">Professional Bios</span>
        <h2 class="section-title">For Event Programs</h2>

        <div class="bio-block">
            <span class="bio-block__label">50-Word Bio</span>
            <p>Luis Gonzalez is a Snowflake Advanced Certified Architect, Principal Data &amp; AI Architect,
            and professor at four universities. He holds a PhD in Computer Sciences, an MBA in Technology
            Management, and an MS in Anthropology. He builds data platforms that perform and researches
            the human systems that run on them.</p>
        </div>

        <div class="bio-block">
            <span class="bio-block__label">150-Word Bio</span>
            <p>Luis Gonzalez is a Snowflake Advanced Certified Architect and Principal Data &amp; AI Architect
            with over two decades of experience designing large-scale data platforms for enterprise organizations.
            He is an Assistant Professor at Colorado Technical University, where he teaches doctoral courses in
            Business Intelligence and Big Data Analytics, and also teaches at the University of Maryland Global
            Campus, Colorado State University Global, and American Public University System.</p>
            <br>
            <p>Luis holds a PhD in Computer Sciences from Nova Southeastern University, an MBA in Technology
            Management, and a Master's in Anthropology from the University of South Africa. His research spans
            artificial immune systems, data quality, and anomaly detection — most recently published at ACM
            CAIBDA 2025. He writes seriously about Snowflake at the Advanced Architect level and speaks at
            enterprise conferences, Snowflake community events, and academic institutions worldwide.</p>
        </div>

        <div style="margin-top:3rem;">
            <span class="eyebrow">Talk Topics</span>
            <h2 class="section-title">Available Sessions</h2>
            <div class="topic-list">
                <?php foreach ([
                    ['01','Data Architecture for the Real World','Why most data platform projects underdeliver, and the architectural decisions that separate the ones that do not. Covers Medallion architecture, Data Mesh, and the governance trade-offs that matter in production.','Enterprise conferences, data engineering summits, executive briefings'],
                    ['02','Snowflake at Scale: Advanced Architecture Patterns','Beyond the basics — Dynamic Tables, Snowpipe Streaming, Cortex AI, and the decisions that determine whether a Snowflake deployment delivers at enterprise scale. Delivered at the Advanced Certified Architect level.','Snowflake user groups, technical conferences, developer communities'],
                    ['03','Artificial Intelligence in Enterprise Data Systems','From RAG pipelines and LLM Agents to the immune-inspired anomaly detection research published at ACM CAIBDA 2025. A practitioner perspective on what AI in data engineering actually looks like outside the demo environment.','AI and data engineering conferences, corporate technical sessions'],
                    ['04','Systems Thinking for Data Engineers','Why data engineering is an organizational problem as much as a technical one. Draws on computer science, anthropology, and 20 years of enterprise experience to reframe how practitioners approach complex system design.','University lectures, doctoral seminars, interdisciplinary conferences'],
                ] as [$num,$title,$desc,$audience]) : ?>
                <div class="topic-row">
                    <div class="topic-row__num"><?php echo $num; ?></div>
                    <div>
                        <div class="topic-row__title"><?php echo esc_html($title); ?></div>
                        <div class="topic-row__desc"><?php echo esc_html($desc); ?></div>
                        <div style="font-size:.75rem;color:var(--text-muted);margin-top:5px;font-style:italic;">For: <?php echo esc_html($audience); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div style="margin-top:3rem;">
            <span class="eyebrow">Past Event Types</span>
            <h2 class="section-title" style="margin-bottom:1.25rem;">Venues &amp; Formats</h2>
            <div class="speak-grid">
                <div class="speak-card">
                    <h3 class="speak-card__name">Keynote</h3>
                    <p class="speak-card__desc">45 to 60 minute vision sessions for conferences and executive summits. Strategic framing, architecture principles, and what is actually coming in enterprise data and AI.</p>
                </div>
                <div class="speak-card">
                    <h3 class="speak-card__name">Technical Workshop</h3>
                    <p class="speak-card__desc">Hands-on sessions covering Snowflake architecture, RAG pipelines, anomaly detection, and modern engineering patterns. Suitable for half-day and full-day formats.</p>
                </div>
                <div class="speak-card">
                    <h3 class="speak-card__name">Guest Lecture</h3>
                    <p class="speak-card__desc">University sessions connecting industry practice to academic theory. Available for doctoral, master's, and undergraduate programs in Computer Science and Data Engineering.</p>
                </div>
            </div>
        </div>

        <div style="margin-top:3rem;padding:24px;background:var(--bg-alt);border:1px solid var(--border);border-radius:var(--r-lg);">
            <span class="eyebrow">Technical Requirements</span>
            <p style="font-size:.9rem;color:var(--text-sec);line-height:1.7;margin-top:.5rem;">
                Projector or large display &middot; HDMI connection &middot; Stable internet for live demos (preferred) &middot;
                Slide deck provided in PDF and PowerPoint formats &middot; Available remotely via Zoom, Teams, or Google Meet
                for virtual events.
            </p>
        </div>

        <div style="margin-top:2.5rem;text-align:center;">
            <p style="color:var(--text-sec);margin-bottom:1rem;">
                Ready to discuss your event?
            </p>
            <a href="<?php echo esc_url(home_url('/work-with-me')); ?>" class="btn btn--primary">Get in Touch</a>
        </div>

    </div>
</section>

<?php get_footer(); ?>
