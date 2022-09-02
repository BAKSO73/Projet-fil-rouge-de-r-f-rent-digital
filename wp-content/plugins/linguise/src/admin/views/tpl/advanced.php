<?php
defined('ABSPATH') || die('');
?>
<div class="content">
    <ul>
        <li class="linguise-settings-option full-width">
            <div class="full-width">
                <label for="id-cache_enabled"
                       class="linguise-setting-label label-bolder linguise-label-inline linguise-tippy" data-tippy="<?php esc_html_e('Store URLs and some translated content in a local cache to render the pages faster', 'linguise'); ?>"><?php esc_html_e('Use cache', 'linguise'); ?><span class="material-icons">help_outline</span></label>
                <div class="linguise-switch-button" style="float: left">
                    <label class="switch">
                        <input type="hidden" name="linguise_options[cache_enabled]" value="0">
                        <input type="checkbox" id="id-cache_enabled" name="linguise_options[cache_enabled]"
                               value="1" <?php echo isset($options['cache_enabled']) ? (checked($options['cache_enabled'], 1)) : (''); ?> />
                        <div class="slider"></div>
                    </label>
                </div>
            </div>

            <div class="full-width" style="display: flex; align-items: center">
                <label for="id-cache_enabled"
                       class="linguise-setting-label label-bolder"><?php esc_html_e('Maximum cache disk space usage (in MB)', 'linguise'); ?></label>
                <input type="number" name="linguise_options[cache_max_size]"
                       value="<?php echo (int)$options['cache_max_size'] ?>" style="margin-left: 20px; width: 100px;">
            </div>
        </li>

        <li class="linguise-settings-option full-width">
            <label for="browser_redirect" class="linguise-setting-label label-bolder linguise-label-inline linguise-tippy"
                   data-tippy="<?php esc_html_e('Automatically redirect users based on the browser language. The user will still be able to change the language manually but this is NOT recommended as users may use various browser languages or speak several languages', 'linguise'); ?>"><?php esc_html_e('Browser Language Redirect', 'linguise'); ?><span class="material-icons">help_outline</span></label>
            <div class="linguise-switch-button">
                <label class="switch">
                    <input type="hidden" name="linguise_options[browser_redirect]" value="0">
                    <input type="checkbox" id="browser_redirect" name="linguise_options[browser_redirect]"
                           value="1" <?php echo isset($options['browser_redirect']) ? (checked($options['browser_redirect'], 1)) : (''); ?> />
                    <div class="slider"></div>
                </label>
            </div>
        </li>

        <li class="linguise-settings-option full-width">
            <label for="search_translation" class="linguise-setting-label label-bolder linguise-label-inline linguise-tippy"
                   data-tippy="<?php esc_html_e('Enable search translation. Visitors will be able to search in their language. (This options can increase a lot your translation quota )', 'linguise'); ?>"><?php esc_html_e('Translate searches', 'linguise'); ?><span class="material-icons">help_outline</span></label>
            <div class="linguise-switch-button">
                <label class="switch">
                    <input type="hidden" name="linguise_options[search_translation]" value="0">
                    <input type="checkbox" id="search_translation" name="linguise_options[search_translation]"
                           value="1" <?php echo isset($options['search_translation']) ? (checked($options['search_translation'], 1)) : (''); ?> />
                    <div class="slider"></div>
                </label>
            </div>
        </li>


        <li class="linguise-settings-option full-width">
            <label for="pre_text"
                   class="linguise-setting-label label-bolder linguise-tippy" data-tippy="<?php esc_html_e('Add some text before the language switcher content in the popup view. HTML is also OK', 'linguise'); ?>"><?php esc_html_e('Pre-text in language popup', 'linguise'); ?><span class="material-icons">help_outline</span></label>
            <div class="items-blocks" style="padding: 10px"><textarea name="linguise_options[pre_text]"
                                                id="pre_text"><?php echo esc_html($options['pre_text']) ?></textarea>
            </div>
        </li>
        <li class="linguise-settings-option full-width">
            <label for="post_text"
                   class="linguise-setting-label label-bolder linguise-tippy" data-tippy="<?php esc_html_e('Add some text after the language switcher content in the popup view. HTML is also OK', 'linguise'); ?>"><?php esc_html_e('Post-text in language popup', 'linguise'); ?><span class="material-icons">help_outline</span></label>
            <div class="items-blocks" style="padding: 10px"><textarea name="linguise_options[post_text]"
                                                id="post_text"><?php echo esc_html($options['post_text']) ?></textarea>
            </div>
        </li>
        <li class="linguise-settings-option full-width">
            <label for="custom_css"
                   class="linguise-setting-label label-bolder linguise-tippy" data-tippy="<?php esc_html_e('Add custom CSS to apply on the Linguise language switcher', 'linguise'); ?>"><?php esc_html_e('Custom CSS Field:', 'linguise'); ?><span class="material-icons">help_outline</span></label>
            <div class="items-blocks" style="padding: 10px"><textarea cols="100" rows="5" class="custom_css"
                                                name="linguise_options[custom_css]"
                                                id="custom_css"><?php echo esc_html($options['custom_css']) ?></textarea>
            </div>
        </li>

        <li class="linguise-settings-option full-width">
            <label for="debug" class="linguise-setting-label label-bolder linguise-label-inline linguise-tippy"
                   data-tippy="<?php esc_html_e('Use for debugging purpose only. It will create a file with a log of content. Only enable it if you need it and only for a limited time', 'linguise'); ?>"><?php esc_html_e('Enable debug', 'linguise'); ?><span class="material-icons">help_outline</span></label>
            <div class="linguise-switch-button">
                <label class="switch">
                    <input type="hidden" name="linguise_options[debug]" value="0">
                    <input type="checkbox" id="debug" name="linguise_options[debug]"
                           value="1" <?php echo isset($options['debug']) ? (checked($options['debug'], 1)) : (''); ?> />
                    <div class="slider"></div>
                </label>
                <?php
                $debug_file = LINGUISE_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'linguise' . DIRECTORY_SEPARATOR . 'script-php' . DIRECTORY_SEPARATOR . 'debug.php';
                if (file_exists($debug_file)) { ?>
                <div>
                    <a href="<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=linguise_download_debug" target="_blank">Download debug file</a>
                </div>
                <?php } ?>
            </div>
        </li>

        <li class="linguise-settings-option full-width">
            <label for="id-alternate_link"
                   class="linguise-setting-label label-bolder linguise-label-inline"><?php esc_html_e('Insert alternate link tag', 'linguise'); ?></label>
            <div class="linguise-switch-button" style="float: left">
                <label class="switch">
                    <input type="hidden" name="linguise_options[alternate_link]" value="0">
                    <input type="checkbox" id="id-alternate_link" name="linguise_options[alternate_link]"
                           value="1" <?php echo isset($options['alternate_link']) ? (checked($options['alternate_link'], 1)) : (''); ?> />
                    <div class="slider"></div>
                </label>
            </div>

            <p class="description" style="width: 100%; display: inline-block; padding-left: 15px; margin: 2px 0 10px 0">
                <?php esc_html_e('It\'s highly recommended keeping this setting activated for SEO purpose', 'linguise'); ?>
            </p>
        </li>
    </ul>
</div>

<p class="submit" style="margin-top: 10px;display: inline-block;float: right; width: 100%"><input
            type="submit"
            name="submit"
            id="submit"
            class="button button-primary"
            value="<?php esc_html_e('Save Settings', 'linguise'); ?>">
</p>