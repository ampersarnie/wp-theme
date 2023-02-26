<?php

namespace Ampersarnie\WP\Theme;

/**
 * Get the posts with additional data required for
 * output on the index page.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @return array
 */
function get_stored_posts(): array
{
    $post_args = [
        'nopaging' => true, // phpcs:ignore WordPressVIPMinimum.Performance.NoPaging.nopaging_nopaging
    ];

    $stored_posts = \get_posts($post_args);

    return $stored_posts;
}

/**
 * Get the formatted date of the current post in the loop.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @throws \ErrorException Throws when not in the the loop.
 * @return string
 */
function get_formatted_date(): string
{
    global $post;

    if (!in_the_loop()) {
        throw new \ErrorException('Must call get_formatted_date() from the loop.');
    }

    return \get_the_date('', $post);
}

/**
 * Get the categories of the current post.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @throws \ErrorException Throws when not in the the loop.
 * @return array
 */
function get_post_categories(): array
{
    global $post;

    return \wp_get_post_categories($post->ID, [ 'fields' => 'names' ]);
}

/**
 * Get the HTML string/element for output.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @param string  $format The format to use if custom is required.
 * @param boolean $print Whether to print or return the HTML.
 * @throws \ErrorException Throws when not in the the loop.
 * @return void|string
 */
function get_datetime_html(string $format = '', bool $print = false)
{
    global $post;

    if (! in_the_loop()) {
        throw new \ErrorException('Must call get_datetime_html() from the loop.');
    }

    $datetime_value = \get_post_time('Y-m-dTH:i:sZ', true, $post, false);
    $formatted      = \get_the_date($format, $post);

    if ($print) {
        printf('<time datetime="%s">%s</time>', esc_attr($datetime_value), esc_html($formatted));
        return;
    }

    return sprintf('<time datetime="%s">%s</time>', esc_attr($datetime_value), esc_html($formatted));
}
/**
 * Get an array of available colours.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @param string $category The category or key of the requested colours.
 * @return array
 */
function get_category_colors(string $category): array
{
    $category = strtolower($category);

    $colors = [
        'default-dark'  => [
            'text'  => 'var(--color-category-text-default)',
            'color' => 'var(--color-category-default)',
        ],
        'default-light' => [
            'text'  => 'var(--color-category-text-default)',
            'color' => 'var(--color-category-default)',
        ],
        'uncategorized' => [
            'text'  => 'var(--color-font-base)',
            'color' => '#e9ab00',
        ],
    ];

    if (\array_key_exists($category, $colors)) {
        return $colors[ $category ];
    }

    return $colors['default-dark'];
}

/**
 * Retrieves the CSS vars for setting the colour.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @param string $category The requested category.
 * @return string
 */
function get_category_color_vars(string $category): string
{
    $colors = get_category_colors($category);

    return color_var_string($colors['color'], $colors['text']);
}

/**
 * Creates the css var string based on the colours added.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 * @param string $color The base/background colour to be used.
 * @param string $text The text colour.
 * @return string
 */
function color_var_string($color = null, $text = null): string
{
    $output = '';

    if (is_string($color)) {
        $output = sprintf(
            '--color-category:%s;',
            $color
        );
    }

    if (is_string($text)) {
        $output = sprintf(
            '%s--color-category-text:%s;',
            $output,
            $text
        );
    }

    return $output;
}
