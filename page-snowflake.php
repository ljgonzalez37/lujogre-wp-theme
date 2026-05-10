<?php
/**
 * Template Name: Snowflake
 * Dedicated Snowflake technical publication — lujogre.com
 */
get_header(); ?>

<section class="snow-hero">
    <div class="container">
        <div class="snow-hero__inner">
            <div class="snow-hero__mark" aria-hidden="true">
                <svg viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 6 54 A 44 44 0 0 1 66 68" stroke="rgba(255,255,255,0.85)" stroke-width="7.5" stroke-linecap="round"/>
                    <path d="M 15 38 A 29 29 0 0 1 60 60" stroke="rgba(255,255,255,0.65)" stroke-width="5.5" stroke-linecap="round"/>
                    <path d="M 24 24 A 17 17 0 0 1 54 50" stroke="#29B5E8" stroke-width="3.5" stroke-linecap="round"/>
                    <circle cx="66" cy="68" r="6" fill="#29B5E8"/>
                    <circle cx="66" cy="68" r="2.4" fill="#0B2D55"/>
                </svg>
            </div>
            <div>
                <span class="eyebrow" style="color:var(--blue);">Snowflake Advanced Certified Architect</span>
                <h1 class="snow-hero__title">Snowflake</h1>
                <p class="snow-hero__sub">
                    Architecture decisions, Cortex AI patterns, data quality methods,
                    and production trade-offs written at the Advanced Certified Architect level.
                    No surface-level tutorials. No vendor marketing.
                    Just the decisions that actually matter in production.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        <nav class="snow-tabs" aria-label="Snowflake sections">
            <a href="#articles"     class="active" data-tab="articles">Articles</a>
            <a href="#architecture" data-tab="architecture">Architecture Notes</a>
            <a href="#community"    data-tab="community">Community Work</a>
            <a href="#research"     data-tab="research">Research</a>
        </nav>

        <!-- ARTICLES TAB -->
        <div id="tab-articles" class="snow-panel">
            <?php
            $aq = new WP_Query(['post_type'=>'sf_article','posts_per_page'=>12]);
            if ($aq->have_posts()) :
                echo '<div class="grid-2">';
                while ($aq->have_posts()) : $aq->the_post();
                    $topic = get_post_meta(get_the_ID(),'_sf_topic',true) ?: 'Architecture';
                    $rt    = get_post_meta(get_the_ID(),'_read_time',true) ?: '10'; ?>
                    <article class="card">
                        <span class="card__eyebrow"><?php echo esc_html($topic); ?></span>
                        <h3 class="card__title"><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h3>
                        <p class="card__desc"><?php the_excerpt(); ?></p>
                        <p style="font-size:.75rem;color:var(--text-muted);margin-top:8px;"><?php echo esc_html($rt); ?> min read &middot; <?php echo get_the_date(); ?></p>
                    </article>
                <?php endwhile;
                echo '</div>';
                wp_reset_postdata();
            else : ?>

            <!-- Hardcoded articles -->
            <div style="display:flex;flex-direction:column;gap:2px;">

                <div class="pub-card sf-article-row" onclick="toggleArticle('art1')">
                    <div class="pub-card__year">2025</div>
                    <div style="flex:1;">
                        <div class="pub-card__venue">Architecture &middot; Pipelines &middot; 12 min read</div>
                        <div class="pub-card__title">Dynamic Tables vs. Streams and Tasks: The Production Decision</div>
                        <div class="pub-card__desc">Snowflake gives you two fundamentally different approaches to incremental data processing. Choosing the wrong one is not a performance problem &mdash; it is an architecture problem.</div>
                        <div style="margin-top:8px;"><span class="sf-read-toggle">Read article &darr;</span></div>
                    </div>
                </div>
                <div id="art1" class="article-body" style="display:none;">
                    <h2>Dynamic Tables vs. Streams and Tasks: The Production Decision</h2>
                    <p>When Snowflake introduced Dynamic Tables, many teams asked whether they should retire their Streams and Tasks pipelines. The honest answer is: it depends &mdash; but not in the evasive way that phrase usually implies. There is a clear decision framework, and once you understand it, the choice becomes straightforward.</p>
                    <h3>What Each Approach Actually Does</h3>
                    <p><strong>Streams and Tasks</strong> are Snowflake's procedural approach to incremental processing. A Stream tracks changes to a source table &mdash; inserts, updates, and deletes &mdash; using Snowflake's internal change tracking mechanism. A Task schedules SQL or a stored procedure on a defined interval or event trigger. Together they form a pipeline: the Stream captures what changed, the Task runs the logic. You control exactly what runs, when, and what happens when things go wrong. The tradeoff is that you own the complexity.</p>
                    <p><strong>Dynamic Tables</strong> are Snowflake's declarative approach. You write a SELECT statement that defines the target state, set a TARGET_LAG parameter specifying the maximum acceptable staleness, and Snowflake handles the rest &mdash; no merge logic, no task scheduling, no dependency management. The mental model: a Dynamic Table is a materialized view you can control the refresh frequency of, supporting joins, aggregations, window functions, and CTEs.</p>
                    <h3>The TARGET_LAG Parameter</h3>
                    <p>TARGET_LAG sets a freshness guarantee, not a fixed schedule. You can set it as a time interval (minimum one minute) or use DOWNSTREAM, which tells the Dynamic Table to refresh only when a downstream Dynamic Table triggers a refresh &mdash; useful for aligning entire pipeline freshness around the final consumer's requirements.</p>
                    <h3>REFRESH_MODE: INCREMENTAL vs. FULL vs. AUTO</h3>
                    <p><strong>INCREMENTAL</strong> &mdash; Snowflake processes only the delta from source changes.<br><strong>FULL</strong> &mdash; Snowflake recomputes the entire result set on every refresh, used when the query cannot be incrementally refreshed.<br><strong>AUTO</strong> (default) &mdash; Snowflake decides based on query structure. Check the Dynamic Table's REFRESH_MODE after creation &mdash; Snowflake shows which mode it selected and why. Non-deterministic functions and certain complex subquery patterns force FULL mode.</p>
                    <h3>Cost Considerations</h3>
                    <p>Dynamic Tables incur storage cost, cloud services compute (only billed if daily cloud services cost exceeds 10% of daily warehouse cost), and virtual warehouse compute &mdash; the primary cost driver. Dynamic Tables do not yet support serverless compute; they require a named virtual warehouse. One team reported reducing their pipeline codebase by 40% after switching to Dynamic Tables. The question is whether that engineering time savings justifies any compute cost increase for your specific workload.</p>
                    <h3>When to Use Dynamic Tables</h3>
                    <p>Use when: building transformation layers expressible as a SELECT statement; acceptable staleness is one minute or greater; you have chains of dependent transformations benefiting from automatic DAG management; implementing SCD Type 1.</p>
                    <h3>When to Use Streams and Tasks</h3>
                    <p>Use when: sub-minute latency is required; pipeline logic needs multi-step procedural operations, conditional branching, external API calls, or JavaScript UDFs; implementing SCD Type 2; needing append-only change capture; requiring precise control over error handling and retry logic per step.</p>
                    <h3>A Practical Decision Framework</h3>
                    <p><strong>1.</strong> Can the transformation be expressed as a single SELECT statement? If yes, Dynamic Tables are a strong candidate.<br><strong>2.</strong> What is the acceptable staleness? Under one minute &mdash; use Streams and Tasks. One minute or more &mdash; Dynamic Tables are viable.<br><strong>3.</strong> How complex is the dependency chain? Many dependent steps favor Dynamic Tables' automatic DAG management.</p>
                    <p>The mistake to avoid is treating Dynamic Tables as universally superior because they are newer. Both tools exist for good reasons. The right architecture uses each where its design strengths align with the pipeline requirements.</p>
                </div>

                <div class="pub-card sf-article-row" onclick="toggleArticle('art2')">
                    <div class="pub-card__year">2025</div>
                    <div style="flex:1;">
                        <div class="pub-card__venue">Cortex AI &middot; Architecture &middot; 14 min read</div>
                        <div class="pub-card__title">Building Production RAG with Snowflake Cortex Search</div>
                        <div class="pub-card__desc">Cortex Search packages vector search, keyword search, and semantic reranking into a single managed service inside Snowflake. Here is what that means for production RAG &mdash; and where it still requires careful architectural decisions.</div>
                        <div style="margin-top:8px;"><span class="sf-read-toggle">Read article &darr;</span></div>
                    </div>
                </div>
                <div id="art2" class="article-body" style="display:none;">
                    <h2>Building Production RAG with Snowflake Cortex Search</h2>
                    <p>Building a retrieval-augmented generation system from scratch requires assembling multiple components: an embedding model, a vector database, an indexing pipeline, a retrieval layer, a reranking model, and a generation model. When your data lives in Snowflake, every external hop introduces data movement &mdash; security review, compliance consideration, and additional latency. Snowflake Cortex Search addresses this by packaging the retrieval components into a managed service that runs natively inside Snowflake. Your data never leaves the platform.</p>
                    <h3>How Cortex Search Works</h3>
                    <p>Cortex Search implements hybrid search &mdash; combining vector search, keyword search, and semantic reranking in a single retrieval operation. The vector search component is powered by Arctic Embed. The current recommended model is <code>snowflake-arctic-embed-l-v2.0</code>, which achieves retrieval performance that only models with over one billion parameters have historically surpassed, while remaining practical to deploy at scale. The result is 200&ndash;300 millisecond query latency over large volumes of text, with metadata filtering support.</p>
                    <h3>Creating a Cortex Search Service</h3>
                    <pre><code>CREATE OR REPLACE CORTEX SEARCH SERVICE support_search_service
  ON document_text
  ATTRIBUTES category, department
  WAREHOUSE = search_wh
  TARGET_LAG = '1 day'
  EMBEDDING_MODEL = 'snowflake-arctic-embed-l-v2.0'
AS (
  SELECT document_text, category, department, document_id
  FROM enterprise_documents WHERE is_active = TRUE
);</code></pre>
                    <p>The <strong>ON</strong> parameter is the column Cortex Search indexes. <strong>ATTRIBUTES</strong> are available as query filters. <strong>TARGET_LAG</strong> controls update frequency. <strong>EMBEDDING_MODEL</strong> selects the Arctic Embed variant.</p>
                    <h3>Chunking Strategy: The Decision That Matters Most</h3>
                    <p>Snowflake recommends keeping text chunks at 512 tokens or fewer (approximately 385 English words). When a chunk is too large, the embedding vector averages across too much semantic content &mdash; a query retrieves a chunk containing the relevant topic plus unrelated content, reducing precision and diluting LLM context. Three approaches: <strong>Fixed-size with overlap</strong> (10&ndash;20% overlap prevents context loss at boundaries &mdash; simplest, good starting point); <strong>Semantic</strong> (split at natural boundaries like paragraphs &mdash; more coherent, variable size); <strong>Hierarchical</strong> (summary plus fine-grained chunks &mdash; most complex, best for long structured documents).</p>
                    <h3>Production Considerations</h3>
                    <p><strong>Governance</strong> &mdash; Cortex Search services inherit Snowflake's row-level and column-level security. Users without table access cannot retrieve content from a service built on that table.<br><strong>Cost</strong> &mdash; the initial index build is the most significant cost event; size your warehouse appropriately for the initial load, then scale down.<br><strong>Evaluation</strong> &mdash; build retrieval quality and answer quality evaluation into your pipeline from the start.</p>
                    <h3>What Cortex Search Does Not Replace</h3>
                    <p>For structured data question-answering &mdash; queries answerable by generating and executing SQL &mdash; Cortex Analyst is more appropriate. Cortex Search is the right choice for enterprise knowledge base, document search, and conversational AI over text data that lives in Snowflake.</p>
                </div>

                <div class="pub-card sf-article-row" onclick="toggleArticle('art3')">
                    <div class="pub-card__year">2025</div>
                    <div style="flex:1;">
                        <div class="pub-card__venue">Architecture &middot; Data Engineering &middot; 13 min read</div>
                        <div class="pub-card__title">Medallion Architecture on Snowflake: What the Diagrams Leave Out</div>
                        <div class="pub-card__desc">Every Medallion Architecture diagram looks the same. Three boxes, three colors, three arrows. What the diagram does not show is the ten decisions that determine whether the architecture holds at enterprise scale.</div>
                        <div style="margin-top:8px;"><span class="sf-read-toggle">Read article &darr;</span></div>
                    </div>
                </div>
                <div id="art3" class="article-body" style="display:none;">
                    <h2>Medallion Architecture on Snowflake: What the Diagrams Leave Out</h2>
                    <p>The Medallion Architecture &mdash; Bronze, Silver, Gold &mdash; has become the dominant pattern for organizing data pipelines on modern cloud platforms. What the standard diagrams omit is everything that makes the difference between an architecture that looks right on paper and one that holds up when real data arrives from real systems under real operational pressure.</p>
                    <h3>The Bronze Layer: Immutability Is Not Optional</h3>
                    <p>The most common mistake is transforming data before storing it. Bronze exists to preserve raw source data unchanged &mdash; duplicates, nulls, malformed records, unexpected schema changes all land in Bronze as-is. This immutability gives you the ability to reprocess data when business logic changes and recover from downstream errors without re-extracting from source systems. In Snowflake: <strong>Snowpipe</strong> for automated ingestion without transformation; <strong>VARIANT columns</strong> for semi-structured data parsed at Silver, not Bronze; <strong>Time Travel</strong> configured for extended retention. Add metadata columns (<code>_source_file_name</code>, <code>_load_timestamp</code>, <code>_row_hash</code>) &mdash; they cost almost nothing and make debugging dramatically easier.</p>
                    <h3>The Silver Layer: Where Complexity Lives</h3>
                    <p><strong>Deduplication</strong> &mdash; row hash for exact duplicates, primary key with timestamp ordering for latest version, QUALIFY with ROW_NUMBER() for partition deduplication. Define logic explicitly per source.<br><strong>Validation and exception strategy</strong> &mdash; failed records should not silently be dropped. Route them to an exceptions table with rejection reason codes.<br><strong>Entity resolution</strong> &mdash; a customer appears as CUST_12345 in the CRM and C-12345 in the ERP. Silver is where you resolve identities into a canonical entity with a defined identifier hierarchy. This is one of the most underestimated design challenges in Silver layer architecture &mdash; it cannot be retrofitted easily.<br><strong>Incremental vs. full refresh</strong> &mdash; Dynamic Tables with INCREMENTAL refresh work well for Silver transformations expressible as SELECT statements. For complex MERGE or multi-step CDC, Streams and Tasks remain more appropriate.</p>
                    <h3>The Gold Layer: Serving Specific Consumers</h3>
                    <p>Each Gold table should serve a defined consumer with data matching that consumer's query patterns. A dashboard table and an ML feature table have different requirements &mdash; one prioritizes pre-aggregated denormalized data, the other prioritizes feature definition stability. Building one Gold table that tries to serve both typically serves neither well. <strong>Metric definitions</strong> live in Gold &mdash; what exactly is an "active customer"? These must be explicit, documented, and consistent across the organization. <strong>Clustering keys</strong> improve performance for high-frequency filtered queries &mdash; align them with the most common query filter patterns and monitor with <code>SYSTEM$CLUSTERING_INFORMATION</code>.</p>
                    <h3>Governance Across Layers</h3>
                    <p><strong>Bronze</strong> &mdash; restrict access to ingestion pipeline and Silver jobs only. <strong>Silver</strong> &mdash; apply row-level security and column masking before data reaches Gold. <strong>Gold</strong> &mdash; this is what business users access and where Snowflake's Secure Data Sharing is most relevant. Snowflake's tag-based policy framework scales governance across large numbers of tables without per-table management.</p>
                    <h3>The Mistake That Costs the Most</h3>
                    <p>Getting layer boundaries wrong early and discovering it late. The safest guard is a written specification of what each layer is responsible for, agreed upon before implementation begins. That document does not survive the architecture review &mdash; it becomes the architecture.</p>
                </div>

            </div>
            <?php endif; ?>
        </div>

        <!-- ARCHITECTURE NOTES TAB -->
        <div id="tab-architecture" class="snow-panel" style="display:none;">
            <div style="max-width:640px;margin-bottom:2rem;">
                <h2 class="section-title" style="font-size:1.4rem;margin-bottom:.5rem;">Architecture Notes</h2>
                <p style="color:var(--text-sec);font-size:.9rem;">Shorter observations from active practice &mdash; patterns encountered this week, trade-offs worth documenting, decisions I would make differently now.</p>
            </div>
            <div class="grid-3">
                <div class="card"><span class="card__eyebrow">Medallion Architecture</span><h3 class="card__title">Bronze to Gold with incremental refresh</h3><p class="card__desc">Layer design, quality gates, and governance decisions that determine whether the architecture holds at enterprise scale.</p></div>
                <div class="card"><span class="card__eyebrow">Data Mesh</span><h3 class="card__title">Domain ownership via Snowflake Data Sharing</h3><p class="card__desc">Federated governance, cross-account secure sharing, and the organizational decisions that determine whether Data Mesh actually works.</p></div>
                <div class="card"><span class="card__eyebrow">Cortex Analyst</span><h3 class="card__title">Natural language queries over structured data</h3><p class="card__desc">Real prompts, real outputs, real limitations &mdash; what Cortex Analyst can and cannot do in a production context.</p></div>
            </div>
        </div>

        <!-- COMMUNITY TAB -->
        <div id="tab-community" class="snow-panel" style="display:none;">
            <div style="max-width:640px;margin-bottom:2rem;">
                <h2 class="section-title" style="font-size:1.4rem;margin-bottom:.5rem;">Community Work</h2>
                <p style="color:var(--text-sec);font-size:.9rem;">Contributions to the Snowflake community &mdash; Stack Overflow answers, forum posts, meetup recordings, and public talks.</p>
            </div>
            <div class="grid-2">
                <div class="card"><span class="card__eyebrow">Stack Overflow</span><h3 class="card__title">Snowflake Tag Contributions</h3><p class="card__desc">Active answers on the Snowflake tag &mdash; architecture questions, Snowpark, Dynamic Tables, and Cortex AI.</p><a href="https://stackoverflow.com/" class="card__link" target="_blank" rel="noopener">View on Stack Overflow</a></div>
                <div class="card"><span class="card__eyebrow">Meetup Recordings</span><h3 class="card__title">Snowflake User Group Sessions</h3><p class="card__desc">Recordings from user group meetups and virtual sessions on Dynamic Tables, Cortex AI, and data quality at scale.</p><a href="<?php echo esc_url(home_url('/speaking-kit')); ?>" class="card__link">Speaking Kit</a></div>
                <div class="card"><span class="card__eyebrow">Snowflake Community</span><h3 class="card__title">Forum Participation</h3><p class="card__desc">Questions answered, patterns shared, and architecture discussions in the official Snowflake Community forum.</p><a href="https://community.snowflake.com/" class="card__link" target="_blank" rel="noopener">Snowflake Community</a></div>
                <div class="card"><span class="card__eyebrow">ACM CAIBDA 2025</span><h3 class="card__title">Peer-Reviewed Research on Data Quality</h3><p class="card__desc">Published research on immune-inspired anomaly detection applied to large-scale data engineering &mdash; directly relevant to Snowflake migration validation.</p><a href="<?php echo esc_url(home_url('/research#publications')); ?>" class="card__link">Read the Paper</a></div>
            </div>
        </div>

        <!-- RESEARCH TAB -->
        <div id="tab-research" class="snow-panel" style="display:none;">
            <div style="max-width:640px;margin-bottom:2rem;">
                <h2 class="section-title" style="font-size:1.4rem;margin-bottom:.5rem;">Research Relevant to Snowflake</h2>
                <p style="color:var(--text-sec);font-size:.9rem;">Published work connecting directly to data engineering, data quality, and large-scale system design on Snowflake.</p>
            </div>
            <div class="pub-list">
                <div class="pub-card"><div class="pub-card__year">2025</div><div><div class="pub-card__venue">ACM &middot; CAIBDA '25</div><div class="pub-card__title">Immune-inspired, statistically-validated anomaly detection for data quality assurance in large-scale data engineering</div><div class="pub-card__desc">NSA-based algorithm processing 6 million rows in under 2 seconds. 100% structural anomaly detection, 75% date anomaly detection. Outperforms Isolation Forest, LOF, DBSCAN, and autoencoders. Directly applicable to Snowflake migration validation.</div></div></div>
                <div class="pub-card"><div class="pub-card__year">2005</div><div><div class="pub-card__venue">PhD Thesis &middot; Nova Southeastern University</div><div class="pub-card__title">A Self-Adaptive Evolutionary Negative Selection Approach for Anomaly Detection</div><div class="pub-card__desc">The foundational research thread extended in the 2025 ACM paper. SANSAD algorithm &mdash; the original negative selection approach for anomaly detection.</div></div></div>
            </div>
            <div style="margin-top:1.5rem;"><a href="<?php echo esc_url(home_url('/research#publications')); ?>" class="btn btn--outline">All Publications</a></div>
        </div>

    </div>
</section>

<style>
.sf-article-row { cursor:pointer; }
.sf-article-row:hover { border-color:rgba(41,181,232,.4); }
.sf-read-toggle { font-size:.74rem; color:var(--blue); font-weight:600; }
.article-body { padding:32px; background:var(--bg-alt); border:1px solid var(--border); border-top:none; margin-bottom:2px; }
.article-body h2 { font-family:var(--serif); font-size:1.6rem; margin:0 0 1.25rem; color:var(--text); }
.article-body h3 { font-family:var(--sans); font-size:1.05rem; font-weight:600; margin:1.75rem 0 .75rem; color:var(--text); }
.article-body p  { font-size:.975rem; color:var(--text-sec); line-height:1.8; margin-bottom:1rem; }
.article-body pre { background:var(--bg-subtle); border:1px solid var(--border); border-radius:var(--r-md); padding:1.25rem; overflow-x:auto; font-size:.84rem; font-family:var(--mono); margin:1rem 0 1.25rem; }
.article-body code { background:var(--bg-subtle); border:1px solid var(--border); border-radius:3px; padding:2px 6px; font-size:.87em; font-family:var(--mono); }
.article-body pre code { background:none; border:none; padding:0; }
</style>

<script>
function toggleArticle(id) {
    var el   = document.getElementById(id);
    if (!el) return;
    var open = el.style.display !== 'none';
    el.style.display = open ? 'none' : 'block';
    var toggle = el.previousElementSibling.querySelector('.sf-read-toggle');
    if (toggle) toggle.innerHTML = open ? 'Read article &darr;' : 'Close article &uarr;';
}
(function () {
    var links  = document.querySelectorAll('.snow-tabs a');
    var panels = document.querySelectorAll('.snow-panel');
    function activate(id) {
        links.forEach(function(l){ l.classList.toggle('active', l.dataset.tab===id); });
        panels.forEach(function(p){ p.style.display=(p.id==='tab-'+id)?'':'none'; });
    }
    links.forEach(function(l){
        l.addEventListener('click', function(e){
            e.preventDefault(); activate(this.dataset.tab);
            history.replaceState(null,'','#'+this.dataset.tab);
        });
    });
    var hash=location.hash.replace('#','');
    if(['articles','architecture','community','research'].indexOf(hash)!==-1) activate(hash);
}());
</script>

<?php get_footer(); ?>
