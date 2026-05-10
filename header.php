<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Luis Gonzalez — Snowflake Advanced Certified Architect, Principal Data &amp; AI Architect, Professor, and Researcher. lujogre.com">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header" role="banner">
    <div class="container">

        <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="lujogre.com — Luis Gonzalez home">
            <?php if (has_custom_logo()) :
                the_custom_logo();
            else : ?>
            <img src="<?php echo esc_url(LUJOGRE_URI . '/assets/images/logo-white.svg'); ?>"
                 alt="lujogre.com — Luis Gonzalez"
                 width="240" height="48"
                 loading="eager">
            <?php endif; ?>
        </a>

        <nav class="main-nav" id="main-nav" role="navigation" aria-label="Primary">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'lujogre_fallback_nav',
                'items_wrap'     => '%3$s',
                'depth'          => 1,
                'walker'         => new LuJoGre_Walker(),
            ]);
            ?>
            <a class="nav-cta" href="<?php echo esc_url(home_url('/work-with-me')); ?>">Work With Me</a>
        </nav>

        <button class="nav-toggle" id="nav-toggle"
                aria-controls="main-nav"
                aria-expanded="false"
                aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

    </div>
</header>

<div class="page-content-wrap">

<?php
/* ── Fallback nav when no menu is assigned ── */
function lujogre_fallback_nav() {
    $items = [
        'About'        => home_url('/about'),
        'Snowflake'    => home_url('/snowflake'),
        'Blog'         => home_url('/blog'),
        'Research'     => home_url('/research'),
        'Speaking Kit' => home_url('/speaking-kit'),
        'Portfolio'    => home_url('/portfolio'),
    ];
    $current_path = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    foreach ($items as $label => $url) {
        $page_path = rtrim(parse_url($url, PHP_URL_PATH), '/');
        $is_current = ($current_path === $page_path);
        printf(
            '<a href="%s"%s>%s</a>',
            esc_url($url),
            $is_current ? ' aria-current="page"' : '',
            esc_html($label)
        );
    }
}

/* ── Custom walker: adds aria-current to active items ── */
class LuJoGre_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $item    = $data_object;
        $classes = (array) ($item->classes ?? []);
        $current = in_array('current-menu-item', $classes, true);
        $output .= sprintf(
            '<a href="%s"%s>%s</a>',
            esc_attr($item->url),
            $current ? ' aria-current="page"' : '',
            esc_html($item->title)
        );
    }
}
