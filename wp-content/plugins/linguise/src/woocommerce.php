<?php

/**
 * Translate woocommerce order
 */

use Linguise\Vendor\Linguise\Script\Core\Boundary;
use Linguise\Vendor\Linguise\Script\Core\Configuration;
use Linguise\Vendor\Linguise\Script\Core\Helper;
use Linguise\Vendor\Linguise\Script\Core\Processor;
use Linguise\Vendor\Linguise\Script\Core\Request;
use Linguise\Vendor\Linguise\Script\Core\Translation;

include_once ABSPATH . 'wp-admin/includes/plugin.php';
if (!is_plugin_active('woocommerce/woocommerce.php')) {
    return;
}

$linguise_options = linguiseGetOptions();
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- View request, no action
if (!empty($_SERVER['HTTP_LINGUISE_ORIGINAL_LANGUAGE']) && $_SERVER['HTTP_LINGUISE_ORIGINAL_LANGUAGE'] !== $linguise_options['default_language'] && in_array($_SERVER['HTTP_LINGUISE_ORIGINAL_LANGUAGE'], $linguise_options['enabled_languages'])) {
    add_filter('woocommerce_ajax_get_endpoint', function ($endpoint, $request) {
        if ($request === 'checkout') {
            return str_replace('checkout', 'checkout&linguise_language=' . $_SERVER['HTTP_LINGUISE_ORIGINAL_LANGUAGE'], $endpoint);
        }
        return str_replace('%%endpoint%%', '%%endpoint%%&linguise_language=' . $_SERVER['HTTP_LINGUISE_ORIGINAL_LANGUAGE'], $endpoint);
    }, 10, 2);
}

// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- View request, no action
if (!empty($_GET['linguise_language']) && $_GET['linguise_language'] !== $linguise_options['default_language'] && in_array($_GET['linguise_language'], $linguise_options['enabled_languages'])) {
    /**
     * Translate WooCommerce fragments
     *
     * @param array       $data       WooCommerce fragments
     * @param string|null $ajaxMethod WooCommerce method called from
     *
     * @return mixed
     */
    function linguiseUpdateWooCommerceFragments($data, $ajaxMethod = null)
    {
        if (empty($data)) {
            return $data;
        }

        $content = '<html><head></head><body>';
        if ($ajaxMethod === 'checkout') {
            $json = json_decode($data);
            if (!$json) {
                return $data;
            }
            $content = $json->messages;
        } elseif (is_array($data)) {
            foreach ($data as $class => $fragment) {
                $content .= '<divlinguise data-wp-linguise-class="' . $class . '">' . $fragment . '</divlinguise>';
            }
        } else {
            $content .= $data;
        }

        $content .= '</body></html>';

        define('LINGUISE_SCRIPT_TRANSLATION', 1);
        define('LINGUISE_SCRIPT_TRANSLATION_VERSION', 'wordpress_plugin/1.9.6');

        include_once(LINGUISE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

        Configuration::getInstance()->load(LINGUISE_PLUGIN_PATH);

        $options = linguiseGetOptions();
        Configuration::getInstance()->set('token', $options['token']);

        $boundary = new Boundary();
        $request =  Request::getInstance();

        $boundary->addPostFields('version', Processor::$version);
        $boundary->addPostFields('url', $request->getBaseUrl());
        $boundary->addPostFields('language', $_GET['linguise_language']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- View request, no action
        $boundary->addPostFields('requested_path', '/');
        $boundary->addPostFields('content', $content);
        $boundary->addPostFields('token', Configuration::getInstance()->get('token'));
        $boundary->addPostFields('ip', Helper::getIpAddress());
        $boundary->addPostFields('response_code', 200);
        $boundary->addPostFields('user_agent', !empty($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'');

        $ch = curl_init();

        list($translated_content, $response_code) = Translation::getInstance()->_translate($ch, $boundary);

        if (!$translated_content || $response_code !== 200) {
            // We failed to translate
            return $data;
        }

        curl_close($ch);

        $result = json_decode($translated_content);

        if ($ajaxMethod === 'checkout') {
            preg_match('/<body>(.*)<\/body>/s', $result->content, $matches);
            if (! $matches) {
                return $data;
            }
            $json->messages = $matches[1];
            return json_encode($json);
        } elseif (is_array($data)) {
            foreach ($data as $class => &$fragment) {
                preg_match('/<divlinguise data-wp-linguise-class="' . preg_quote($class) . '">(.*?)<\/divlinguise>/s', $result->content, $matches);
                if (! $matches) {
                    return $data;
                }
                $fragment = $matches[1];
            }
        } else {
            preg_match('/<body>(.*)<\/body>/s', $result->content, $matches);
            if (! $matches) {
                return $data;
            }
            return $matches[1];
        }

        return $data;
    }

    $ajaxMethods = [
        'apply_coupon',
        'remove_coupon',
        'update_shipping_method',
        'get_cart_totals',
        'checkout'
    ];
    foreach ($ajaxMethods as $ajaxMethod) {
        add_action('wc_ajax_' . $ajaxMethod, function () use ($ajaxMethod) {
            ob_start(function ($data) use ($ajaxMethod) {
                return linguiseUpdateWooCommerceFragments($data, $ajaxMethod);
            });
        });
    }

    add_filter('woocommerce_update_order_review_fragments', 'linguiseUpdateWooCommerceFragments', 1000, 1);
    add_filter('woocommerce_add_to_cart_fragments', 'linguiseUpdateWooCommerceFragments', 1000, 1);
    add_filter('woocommerce_get_return_url', function ($url, $order) {
        $siteUrl = site_url();
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- View request, no action, also $_GET['linguise_language'] is verified previously
        return preg_replace('/^' . preg_quote($siteUrl, '/') .'/', $siteUrl . '/' . $_GET['linguise_language'], $url);
    }, 10, 2);
    add_filter('woocommerce_get_endpoint_url', function ($url, $endpoint, $value, $permalink) {
        if ($endpoint !== 'order-pay') {
            return $url;
        }

        $siteUrl = site_url();
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- View request, no action, also $_GET['linguise_language'] is verified previously
        return preg_replace('/^' . preg_quote($siteUrl, '/') .'/', $siteUrl . '/' . $_GET['linguise_language'], $url);
    }, 10, 4);

    // Translate the WooCommerce order button value attributes
    add_filter('woocommerce_order_button_html', function ($html) {
        return str_replace('<button ', '<button data-linguise-translate-attributes="value data-value" ', $html);
    });
}

/**
 * Reset wc fragment
 */
add_action('wp_loaded', function () {

    $script ='try {
            jQuery(document).ready(function($) {
                if (typeof wc_cart_fragments_params === "undefined") {
                    return false;
                }
                if (typeof linguise_configs !== "undefined" && typeof linguise_configs.vars !== "undefined" && typeof linguise_configs.vars.configs !== "undefined" && typeof linguise_configs.vars.configs.current_language === "undefined") {
                    return;
                }

                $(document.body).on("wc_fragments_loaded", function () {
                    $(document.body).trigger("wc_fragment_refresh");
                });
            });
        } catch (e) {
            console.warn(e);
        }';

    wp_register_script('linguise_woocommerce_cart_fragments', '', array('jquery'), '', true);
    wp_enqueue_script('linguise_woocommerce_cart_fragments');
    wp_add_inline_script('linguise_woocommerce_cart_fragments', $script);
});
