<?php

namespace Ampersarnie\WP\Theme;

/**
 * Clears and cleans a lot of the additional fluff that is added
 * by WordPress by default but is not required for this theme/setup.
 *
 * @author Paul Taylor <paul.taylor@hey.com>
 */
class Clearance
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        add_action('init', [ $this, 'unhook' ]);
        add_action('wp_enqueue_scripts', [ $this, 'removeBlockLibrary' ], 100);
        add_filter('wp_resource_hints', [ $this, 'removeDNSPrefetch' ]);
    }

    /**
     * Disables XML-RPC and removes from the head.
     *
     * @author Paul Taylor <paul.taylor@hey.com>
     * @return void
     */
    public function unhook(): void
    {
        /**
         * Additional changes may be required in .htacess;
         * # Block WordPress xmlrpc.php requests
         * <Files xmlrpc.php>
         * order deny,allow
         * deny from all
         * allow from 123.123.123.123
         * </Files>
         */
        add_filter('xmlrpc_enabled', '__return_false');
        remove_action('wp_head', 'rsd_link');

        // Remove Windows Live Writer (wlwmanifest) from Header.
        remove_action('wp_head', 'wlwmanifest_link');

        // Remove shortlinks.
        remove_action('wp_head', 'wp_shortlink_wp_head');

        // Remove generator.
        remove_action('wp_head', 'wp_generator');

        // Remove REST API from header.
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');

        // Remove Emoji.
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');

        // Leave Excerpt empty if not used.
        remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    }

    /**
     * Remove dns-prefetch for w.org emojis
     *
     * @author Paul Taylor <paul.taylor@hey.com>
     * @param array $urls List of urls that will be added to prefetch.
     * @return array
     */
    public function removeDNSPrefetch(array $urls = []): array
    {
        foreach ($urls as $key => $url) {
            // Remove dns-prefetch for w.org (we really don't need it)
            // See https://core.trac.wordpress.org/ticket/40426 for details.
            if ('https://s.w.org/images/core/emoji/13.0.0/svg/' === $url) {
                unset($urls[ $key ]);
            }
        }

        return $urls;
    }

    /**
     * Remove Gutenberg Block Library CSS from loading on the frontend.
     *
     * @author Paul Taylor <paul.taylor@hey.com>
     * @return void
     */
    public function removeBlockLibrary(): void
    {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
    }
}
