<?php
/**
 * LuJoGre Theme v3 — functions.php
 * lujogre.com · Luis Gonzalez
 *
 * Key additions in v3:
 * - Auto-creates all 8 pages with correct slugs + templates on activation
 * - Universities ordered by seniority with live links
 * - Logo Option A: lujogre.com / LUIS GONZALEZ stacked two-weight
 */
defined('ABSPATH') || exit;

define('LUJOGRE_VER', '3.0.0');
define('LUJOGRE_DIR', get_template_directory());
define('LUJOGRE_URI', get_template_directory_uri());

/* ══ SETUP ══════════════════════════════ */
function lujogre_setup() {
    load_theme_textdomain('lujogre', LUJOGRE_DIR . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','gallery','caption','style','script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', [
        'height'      => 64,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
    register_nav_menus([
        'primary' => 'Primary Navigation',
        'footer'  => 'Footer Navigation',
    ]);
    add_image_size('portfolio-thumb', 800, 450, true);
    add_image_size('blog-card',       600, 340, true);
    add_image_size('hero-avatar',     400, 400, true);
}
add_action('after_setup_theme', 'lujogre_setup');

/* ══ ASSETS ═════════════════════════════ */
function lujogre_assets() {
    wp_enqueue_style('lujogre-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Outfit:wght@300;400;500;600&family=Fira+Code:wght@400;500&display=swap',
        [], null);
    wp_enqueue_style('lujogre-style', get_stylesheet_uri(), ['lujogre-fonts'], LUJOGRE_VER);
    wp_enqueue_script('lujogre-main', LUJOGRE_URI . '/assets/js/main.js', [], LUJOGRE_VER, true);
    wp_localize_script('lujogre-main', 'lujogre', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('lujogre_contact'),
        'strings' => [
            'sending' => 'Sending…',
            'success' => 'Message sent. I will be in touch shortly.',
            'error'   => 'Something went wrong. Please try again.',
            'network' => 'Network error. Please email doctorg@lujogre.com directly.',
        ],
    ]);
    if (is_singular() && comments_open()) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'lujogre_assets');

/* ══ CUSTOM POST TYPES ══════════════════ */
function lujogre_cpts() {
    $base = [
        'public'       => true,
        'show_in_rest' => true,
        'supports'     => ['title','editor','thumbnail','excerpt','custom-fields'],
    ];

    register_post_type('sf_article', array_merge($base, [
        'labels'      => ['name'=>'SF Articles','singular_name'=>'SF Article','add_new_item'=>'Add Article','menu_name'=>'SF Articles'],
        'has_archive' => true,
        'menu_icon'   => 'dashicons-welcome-write-blog',
        'rewrite'     => ['slug' => 'snowflake/articles'],
    ]));

    register_post_type('portfolio', array_merge($base, [
        'labels'      => ['name'=>'Portfolio','singular_name'=>'Project','add_new_item'=>'Add Project','menu_name'=>'Portfolio'],
        'has_archive' => true,
        'menu_icon'   => 'dashicons-portfolio',
        'rewrite'     => ['slug' => 'portfolio'],
    ]));

    register_post_type('speaking', array_merge($base, [
        'labels'      => ['name'=>'Speaking','singular_name'=>'Event','add_new_item'=>'Add Event','menu_name'=>'Speaking'],
        'has_archive' => true,
        'menu_icon'   => 'dashicons-microphone',
        'rewrite'     => ['slug' => 'speaking-kit/events'],
        'supports'    => ['title','editor','custom-fields'],
    ]));

    register_post_type('publication', array_merge($base, [
        'labels'      => ['name'=>'Publications','singular_name'=>'Publication','add_new_item'=>'Add Publication','menu_name'=>'Publications'],
        'has_archive' => true,
        'menu_icon'   => 'dashicons-media-document',
        'rewrite'     => ['slug' => 'research/publications'],
        'supports'    => ['title','editor','excerpt','custom-fields'],
    ]));

    register_post_type('course', array_merge($base, [
        'labels'      => ['name'=>'Courses','singular_name'=>'Course','add_new_item'=>'Add Course','menu_name'=>'Courses'],
        'has_archive' => true,
        'menu_icon'   => 'dashicons-book-alt',
        'rewrite'     => ['slug' => 'research/courses'],
    ]));
}
add_action('init', 'lujogre_cpts');

/* ══ AUTO PAGE CREATION ON ACTIVATION ══ */
/**
 * Creates all required pages with correct slugs and page templates
 * on theme activation. Safe to run multiple times — skips existing pages.
 */
function lujogre_create_pages() {
    $pages = [
        [
            'title'    => 'Home',
            'slug'     => 'home',
            'template' => 'front-page.php',
            'content'  => '',
        ],
        [
            'title'    => 'About',
            'slug'     => 'about',
            'template' => 'page-about.php',
            'content'  => '',
        ],
        [
            'title'    => 'Snowflake',
            'slug'     => 'snowflake',
            'template' => 'page-snowflake.php',
            'content'  => '',
        ],
        [
            'title'    => 'Blog',
            'slug'     => 'blog',
            'template' => '',
            'content'  => '',
        ],
        [
            'title'    => 'Research',
            'slug'     => 'research',
            'template' => 'page-research.php',
            'content'  => '',
        ],
        [
            'title'    => 'Speaking Kit',
            'slug'     => 'speaking-kit',
            'template' => 'page-speaking-kit.php',
            'content'  => '',
        ],
        [
            'title'    => 'Portfolio',
            'slug'     => 'portfolio',
            'template' => 'page-portfolio.php',
            'content'  => '',
        ],
        [
            'title'    => 'Work With Me',
            'slug'     => 'work-with-me',
            'template' => 'page-work-with-me.php',
            'content'  => '',
        ],
    ];

    foreach ($pages as $page) {
        // Check if a page with this slug already exists
        $existing = get_page_by_path($page['slug'], OBJECT, 'page');
        if ($existing) {
            // Page exists — ensure template is assigned
            if (!empty($page['template'])) {
                $current_template = get_post_meta($existing->ID, '_wp_page_template', true);
                if ($current_template !== $page['template']) {
                    update_post_meta($existing->ID, '_wp_page_template', $page['template']);
                }
            }
            continue;
        }

        // Create the page
        $page_id = wp_insert_post([
            'post_title'   => $page['title'],
            'post_name'    => $page['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => $page['content'],
        ]);

        // Assign template
        if ($page_id && !is_wp_error($page_id) && !empty($page['template'])) {
            update_post_meta($page_id, '_wp_page_template', $page['template']);
        }
    }

    // Set front page and blog page
    $front = get_page_by_path('home', OBJECT, 'page');
    $blog  = get_page_by_path('blog',  OBJECT, 'page');

    if ($front) {
        update_option('page_on_front',  $front->ID);
        update_option('show_on_front',  'page');
    }
    if ($blog) {
        update_option('page_for_posts', $blog->ID);
    }

    // Flush rewrite rules so slugs resolve immediately
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'lujogre_create_pages');
// Also run on init in case theme was already active — checks idempotently
add_action('init', function() {
    if (!get_option('lujogre_pages_created')) {
        lujogre_create_pages();
        update_option('lujogre_pages_created', '3.0.0');
    }
});

/* ══ CUSTOMIZER ═════════════════════════ */
function lujogre_customizer($wp_customize) {

    // Hero
    $wp_customize->add_section('lujogre_hero', ['title' => 'Hero Section', 'priority' => 30]);
    foreach ([
        'hero_eyebrow'  => ['Eyebrow',    'Snowflake Advanced Certified Architect &middot; Principal Data &amp; AI Architect'],
        'hero_headline' => ['Headline',   'I build platforms that deliver clarity, speed, and lasting outcomes.'],
        'hero_sub'      => ['Subheading', 'With a foundation spanning computer science, enterprise data architecture, and human systems research, I help organizations turn fragmented data into platforms that actually perform.'],
    ] as $key => [$label, $default]) {
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => 'wp_kses_post']);
        $wp_customize->add_control($key, ['label' => $label, 'section' => 'lujogre_hero', 'type' => 'textarea']);
    }

    // Contact
    $wp_customize->add_section('lujogre_contact', ['title' => 'Contact Info', 'priority' => 32]);
    foreach ([
        'contact_email'       => ['Contact Email',          'doctorg@lujogre.com'],
        'contact_address'     => ['Mailing Address',        'P.O. Box 154, Monument, CO 80132'],
        'contact_linkedin'    => ['LinkedIn URL', 'https://www.linkedin.com/in/luisjgonzalez/'],
        'contact_github'      => ['GitHub URL',             ''],
        'contact_youtube'     => ['YouTube URL',            ''],
        'resume_url'          => ['Résumé PDF URL',         ''],
        'speaking_pdf_url'    => ['Speaking Brief PDF URL', ''],
    ] as $key => [$label, $default]) {
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control($key, ['label' => $label, 'section' => 'lujogre_contact', 'type' => 'text']);
    }

    // Avatar
    $wp_customize->add_section('lujogre_media', ['title' => 'Profile Photo', 'priority' => 34]);
    $wp_customize->add_setting('hero_avatar_id', ['default' => '', 'sanitize_callback' => 'absint']);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_avatar_id', [
        'label'     => 'Profile Photo (square, min 400×400)',
        'section'   => 'lujogre_media',
        'mime_type' => 'image',
    ]));
}
add_action('customize_register', 'lujogre_customizer');

/* ══ AJAX CONTACT ════════════════════════ */
function lujogre_contact_submit() {
    if (!isset($_POST['lujogre_nonce']) ||
        !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['lujogre_nonce'])), 'lujogre_contact')) {
        wp_send_json_error('Security check failed. Please refresh and try again.');
    }

    $name    = sanitize_text_field(wp_unslash($_POST['name']         ?? ''));
    $email   = sanitize_email(wp_unslash($_POST['email']             ?? ''));
    $org     = sanitize_text_field(wp_unslash($_POST['org']          ?? ''));
    $type    = sanitize_text_field(wp_unslash($_POST['inquiry_type'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message']  ?? ''));

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields.');
    }
    if (!is_email($email)) {
        wp_send_json_error('Please enter a valid email address.');
    }

    $to      = get_theme_mod('contact_email', 'doctorg@lujogre.com');
    $subject = sprintf('[lujogre.com] %s inquiry from %s', ucfirst($type), $name);
    $body    = "Name:         {$name}\nEmail:        {$email}\nOrganization: {$org}\nInquiry:      " . ucfirst($type) . "\n\nMessage:\n{$message}\n\n---\nSent from lujogre.com";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>",
    ];

    wp_mail($to, $subject, $body, $headers)
        ? wp_send_json_success('Message sent.')
        : wp_send_json_error('Email could not be sent. Please email doctorg@lujogre.com directly.');
}
add_action('wp_ajax_lujogre_contact',        'lujogre_contact_submit');
add_action('wp_ajax_nopriv_lujogre_contact', 'lujogre_contact_submit');

/* ══ WIDGETS ═════════════════════════════ */
function lujogre_widgets() {
    $a = [
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ];
    register_sidebar(array_merge($a, ['name' => 'Blog Sidebar',      'id' => 'blog-sidebar']));
    register_sidebar(array_merge($a, ['name' => 'Snowflake Sidebar', 'id' => 'snowflake-sidebar']));
}
add_action('widgets_init', 'lujogre_widgets');

/* ══ HELPERS ═════════════════════════════ */
add_filter('document_title_separator', fn() => '·');
add_filter('excerpt_length',           fn() => 26);
add_filter('excerpt_more',             fn() => '&hellip;');

/**
 * University data — single source of truth used by all templates.
 * Ordered by seniority: doctoral mentorship → longest tenure → curriculum → newest.
 */
function lujogre_universities() {
    return [
        [
            'role'    => 'Assistant Professor',
            'name'    => 'Colorado Technical University',
            'abbr'    => 'CTU',
            'url'     => 'https://www.coloradotech.edu',
            'tenure'  => 'May 2021 – Present &middot; Doctoral level',
            'courses' => 'Doctoral courses in Business Intelligence and Big Data Analytics. Mentors doctoral candidates through research design, methodology, and dissertation development. Connects academic research with real-world analytics and enterprise data frameworks.',
        ],
        [
            'role'    => 'Professor (promoted from Adjunct)',
            'name'    => 'University of Maryland Global Campus',
            'abbr'    => 'UMGC',
            'url'     => 'https://www.umgc.edu',
            'tenure'  => 'January 2017 – Present &middot; Graduate level',
            'courses' => 'Graduate-level Relational Databases, Distributed Database Management Systems, and Compiler Theory. Develops curriculum and assessments for advanced database architecture and distributed systems.',
        ],
        [
            'role'    => 'Adjunct Faculty',
            'name'    => 'Colorado State University Global',
            'abbr'    => 'CSU Global',
            'url'     => 'https://csuglobal.edu',
            'tenure'  => 'April 2022 – Present &middot; Graduate level',
            'courses' => 'Computer Science courses including Programming, Software Engineering, and AI. Develops and refines new courses ensuring alignment with industry standards and modern cloud technologies.',
        ],
        [
            'role'    => 'Adjunct Faculty',
            'name'    => 'American Public University System',
            'abbr'    => 'APUS',
            'url'     => 'https://www.apus.edu',
            'tenure'  => 'May 2024 – Present &middot; Graduate &amp; Undergraduate',
            'courses' => 'Advanced Analytics and AI Product Design. Develops complete courses from scratch including hands-on labs, case studies, and applied technical content.',
        ],
    ];
}
