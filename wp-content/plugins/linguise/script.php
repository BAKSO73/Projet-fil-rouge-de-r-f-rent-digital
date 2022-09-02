<?php
use Linguise\Vendor\Linguise\Script\Core\Configuration;
use Linguise\Vendor\Linguise\Script\Core\Database;
use Linguise\Vendor\Linguise\Script\Core\Processor;

define('LINGUISE_SCRIPT_TRANSLATION', true);
define('LINGUISE_SCRIPT_TRANSLATION_VERSION', 'wordpress_plugin/1.9.6');

ini_set('display_errors', false);

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

Configuration::getInstance()->load(__DIR__);

Configuration::getInstance()->set('base_dir', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR  . '..' . DIRECTORY_SEPARATOR  . '..') . DIRECTORY_SEPARATOR);

$token = Database::getInstance()->retrieveWordpressOption('token', $_SERVER['HTTP_HOST']);
$cache_enabled = Database::getInstance()->retrieveWordpressOption('cache_enabled');
$cache_max_size = Database::getInstance()->retrieveWordpressOption('cache_max_size');
$debug = Database::getInstance()->retrieveWordpressOption('debug') ? 5 : false;

Configuration::getInstance()->set('token', $token);

Configuration::getInstance()->set('cache_enabled', $cache_enabled);
Configuration::getInstance()->set('cache_max_size', $cache_max_size);
Configuration::getInstance()->set('debug', $debug);

$processor = new Processor();
// phpcs:disable WordPress.Security.NonceVerification.Recommended -- View request, no action
if (isset($_GET['linguise_language']) && $_GET['linguise_language'] === 'zz-zz' &&  isset($_GET['linguise_action'])) {
    switch ($_GET['linguise_action']) {
        case 'clear-cache':
            $processor->clearCache();
            break;
        case 'update-certificates':
            $processor->updateCertificates();
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['linguise_language']) && $_GET['linguise_language'] === 'zz-zz') {
    $processor->editor();
} else {
    $processor->run();
}
