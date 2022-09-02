<?php
defined('ABSPATH') or die("Restricted access!");
?>
<div class="wrap">
    <h1>Connect Nudgify to your website</h1>

    <hr />

    <h2>Settings</h2>

    <form id="nudgify-form-options" name="dofollow" action="options.php" method="post">
        <?php settings_errors(); ?>
        <?php echo nudgify_feedback_message('connect'); ?>

        <?php settings_fields(NudgifyOptions::OPTIONS_GROUP); ?>
        <?php do_settings_sections(NudgifyOptions::OPTIONS_GROUP); ?>
        <input type="hidden" name="<?= NudgifyOptions::SAVED ?>" id="<?= NudgifyOptions::SAVED ?>" data-initial="<?= get_option(NudgifyOptions::SAVED, time()) ?>" value="<?= get_option(NudgifyOptions::SAVED, time()) ?>" />

        <?php if (get_option(NudgifyOptions::CONNECTED)) : ?>
            <div class="notice notice-success">
                <p><strong>Your site is connected to Nudgify.</strong></p>
            </div>
        <?php endif; ?>


        <table class="form-table">
            <tr>
                <th>
                    <label for="<?= NudgifyOptions::ENABLED ?>">Enable Nudgify</label>
                </th>
                <td>
                    <select id="<?= NudgifyOptions::ENABLED ?>" name="<?= NudgifyOptions::ENABLED ?>" data-initial="<?= get_option(NudgifyOptions::ENABLED) ?>" style="width: 10em;">
                        <option value="1" <?= get_option(NudgifyOptions::ENABLED) == 1 ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= get_option(NudgifyOptions::ENABLED) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                </td>
            </tr>
            <tr class="depends-on-enabled <?= get_option(NudgifyOptions::ENABLED) ? '' : 'hidden' ?>">
                <th>
                    <label for="<?= NudgifyOptions::SITE_KEY ?>">Site Key</label>
                </th>
                <td>
                    <input id="<?= NudgifyOptions::SITE_KEY ?>" class="regular-text code" name="<?= NudgifyOptions::SITE_KEY ?>" type="text" value="<?= esc_html(get_option(NudgifyOptions::SITE_KEY)); ?>" />

                    <p class="description">
                        Go to your the <a href="https://app.nudgify.com/integrations/wordpress" target="_blank" rel="noopener">Wordpress Integration page</a> for your current site to find your Site Key.
                    </p>
                </td>
            </tr>
            <tr class="depends-on-enabled <?= get_option(NudgifyOptions::ENABLED) ? '' : 'hidden' ?>">
                <th>
                    <label for="<?= NudgifyOptions::API_TOKEN ?>">API Key</label>
                </th>
                <td>
                    <input id="<?= NudgifyOptions::API_TOKEN ?>" class="regular-text code" name="<?= NudgifyOptions::API_TOKEN ?>" type="text" value="<?= esc_html(get_option(NudgifyOptions::API_TOKEN)); ?>" />

                    <p class="description">
                        Go to your <a href="https://app.nudgify.com/settings" target="_blank" rel="noopener">Profile Details</a> to find your API Key.
                    </p>
                </td>
            </tr>
            <tr class="depends-on-enabled <?= get_option(NudgifyOptions::ENABLED) ? '' : 'hidden' ?>">
                <th>
                    <label for="<?= NudgifyOptions::AUTOSYNC ?>">Sync new orders to Nudgify</label>
                </th>
                <td>
                    <select id="<?= NudgifyOptions::AUTOSYNC ?>" name="<?= NudgifyOptions::AUTOSYNC ?>" style="width: 10em;">
                        <option value="1" <?= get_option(NudgifyOptions::AUTOSYNC) == 1 ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= get_option(NudgifyOptions::AUTOSYNC) == 0 ? 'selected' : '' ?>>No</option>
                    </select>
                    <p class="description">
                        Enable this option to automatically sync new WooCommerce orders with Nudgify
                    </p>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <p class="depends-on-enabled submit <?= get_option(NudgifyOptions::ENABLED) ? '' : 'hidden' ?>">
                        <input type="submit" name="submit" id="nudgify-setup" class="button button-primary" value="Set up connection">
                    </p>
                    <p class="depends-on-enabled submit <?= get_option(NudgifyOptions::ENABLED) ? 'hidden' : '' ?>">
                        <input type="submit" name="submit" id="nudgify-submit" class="button button-primary" value="Save settings">
                    </p>
                </td>
            </tr>
        </table>
    </form>

    <?php if (nudgify_woocommerce_enabled()) : ?>
        <div class="depends-on-enabled <?= get_option(NudgifyOptions::ENABLED) ? '' : 'hidden' ?>">
        <hr>
        <h2>Sync orders</h2>
        <?php echo nudgify_feedback_message('manualsync'); ?>
        <form action="<?php echo admin_url('admin.php'); ?>" method="post" id="nudgify-form-manualsync">
            <input type="hidden" name="action" value="<?php echo NudgifyOptions::DO_MANUAL_SYNC; ?>" />
            <table class="form-table">
                <tr>
                    <th></th>
                    <td>
                        <?php submit_button('Manually sync orders'); ?>
                        <p class="description">
                            This will send the last 30 orders to Nudgify
                        </p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="nudgify-feedback"></td>
                </tr>
            </table>
        </form>
        </div>
    <?php endif; ?>
</div>
<script>
    jQuery('#nudgify-form-manualsync').on('submit', function(event) {
        event.preventDefault();
        var form = jQuery('#nudgify-form-manualsync');
        var button = form.find('input[type=submit]');
        var buttonText = button.val();
        var feedback = form.find('.nudgify-feedback');

        jQuery.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            beforeSend: function() {
                button.prop('disabled', true);
                button.val('Syncing orders ...');
                feedback.html('');
            },
            success: function(data) {
                button.prop('disabled', false);
                button.val(buttonText);
                feedback.html(`
                    <div class="notice is-dismissible inline notice-success" style="max-width:25em">
                        <p><b>Orders synced successfully</b></p>
                    </div>
                `);
            }
        });
    });

    jQuery('#nudgify-form-options').on('submit', function() {
        var button = jQuery('#nudgify-form-options').find('#nudgify-setup');
        button.prop('disabled', true);
        button.val('Connecting ...');
    });

    jQuery('#<?= NudgifyOptions::SITE_KEY ?>,#<?= NudgifyOptions::API_TOKEN ?>').on('change', function(event) {
        jQuery('#<?= NudgifyOptions::SAVED ?>').val(Date.now());
    });

    jQuery('#<?= NudgifyOptions::ENABLED ?>').on('change', function(event) {
        if (event.target.value) {
            jQuery('#<?= NudgifyOptions::SAVED ?>').val(Date.now());
        }
        jQuery('.depends-on-enabled').toggleClass('hidden');
    });
</script>