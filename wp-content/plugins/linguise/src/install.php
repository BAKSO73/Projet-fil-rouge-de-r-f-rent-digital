<?php
add_action('admin_init', function () {
    $installed_version = get_option('linguise_version', null);

    if (!$installed_version) {
        define('LINGUISE_SCRIPT_TRANSLATION', true);
        require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'linguise' . DIRECTORY_SEPARATOR . 'script-php' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Databases' . DIRECTORY_SEPARATOR . 'Mysql.php');

        global $wpdb;
        $mysql_instance = \Linguise\Vendor\Linguise\Script\Core\Databases\Mysql::getInstance();
        $install_query = $mysql_instance->getInstallQuery($wpdb->base_prefix . 'linguise_urls');
        $wpdb->query($install_query);
    } else {
        // This is an update
        if (version_compare($installed_version, '1.7.6') === -1) {
            // Do not add flag on already installed versions
            $linguise_options = get_option('linguise_options');
            $linguise_options['add_flag_automatically'] = 0;
            update_option('linguise_options', $linguise_options);
        }
    }

    if ($installed_version !== LINGUISE_VERSION) {
        update_option('linguise_version', LINGUISE_VERSION);
    }
});
