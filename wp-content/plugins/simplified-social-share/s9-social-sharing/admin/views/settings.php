<?php
// S9_Social_Sharing_Settings
// Exit if called directly
if (!defined('ABSPATH')) {
  exit();
}

/**
 * The main class and initialization point of the plugin settings page.
 */
if (!class_exists('S9_Social_Share_Settings')) {

  class S9_Social_Share_Settings
  {
    public static function socialWidgetTypeUI($action, $currentWidget)
    {
      if(!isset($currentWidget['widget_type'])){
        $currentWidget['widget_type'] = isset($_GET["type"])?$_GET["type"]:"inline";
      }
?>
      <div class="s9_form-group">
        <label>Widget Type</label>
        <select id="s9-<?php echo $action; ?>-widget-type">
          <option <?php echo ($currentWidget['widget_type'] == "inline" ? "selected" : ""); ?> value="inline">Inline</option>
          <option <?php echo ($currentWidget['widget_type'] == "floating" ? "selected" : ""); ?> value="floating">Floating</option>
        </select>
      </div>
    <?php
    }

    public static function socialLayoutUI($action, $currentWidget)
    {
      $layout = '';
      if (!isset($currentWidget["layout"]["position"])) {
        $layout = $currentWidget["layout"]["position"];
      }
    ?>
      <div class="s9_button-configuration">
        <h2>Layout</h2>
        <div class="s9_button-configuration-inner">
          <div class="form-group">
            <label>Desktop</label>
            <div>
              <input data-index="2" id="s9-<?php echo $action; ?>-hide-social-hide-on-desktop" type="checkbox" <?php echo ((isset($layout["desktop"]["hide"]) && $layout["desktop"]["hide"] == "true") ? "checked" : ""); ?>>
              <label for="s9-<?php echo $action; ?>-hide-social-hide-on-desktop">Hide On Desktop</label>
            </div>
            <div class="s9_button-configuration desktop hideinline">
              <div class="s9_form-group">
                <label>Position</label>
                <select id="s9-<?php echo $action; ?>-hide-social-position-on-desktop">
                  <option <?php echo (isset($layout['desktop']["value"]) && $layout['desktop']["value"] == "left" ? "selected" : ""); ?> value="left">Left</option>
                  <option <?php echo (isset($layout['desktop']["value"]) && $layout['desktop']["value"] == "right" ? "selected" : ""); ?> value="right">Right</option>
                </select>
              </div>
              <div class="s9_form-group">
                <label>Top Offset In %</label>
                <input id="s9-<?php echo $action; ?>-hide-social-offset-on-desktop" type="number" value="<?php echo (isset($layout['desktop']["offset"]) ? $layout['desktop']["offset"] : 0); ?>"></input>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Mobile</label>
            <div>
              <input data-index="2" id="s9-<?php echo $action; ?>-hide-social-hide-on-mobile" type="checkbox" <?php echo ((isset($layout["mobile"]["hide"]) && $layout["mobile"]["hide"] == "true") ? "checked" : ""); ?>>
              <label for="s9-<?php echo $action; ?>-hide-social-hide-on-mobile">Hide On Mobile</label>
            </div>
            <div class="s9_button-configuration mobile hideinline">
              <div class="s9_form-group">
                <label>Position</label>
                <select id="s9-<?php echo $action; ?>-hide-social-position-on-mobile">
                  <option <?php echo (isset($layout['mobile']["value"]) && $layout['mobile']["value"] == "top" ? "selected" : ""); ?> value="top">Top</option>
                  <option <?php echo (isset($layout['mobile']["value"]) && $layout['mobile']["value"] == "bottom" ? "selected" : ""); ?> value="bottom">Bottom</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    public static function socialCounterUI($action, $currentWidget)
    {
      $counter = '';
      if (isset($currentWidget["options"]["counter"])) {
        $counter = $currentWidget["options"]["counter"];
      }
    ?>
      <div class="s9_button-configuration">
        <h2>Counter</h2>
        <div class="s9_button-configuration-inner">
          <div class="s9_form-group">
            <label>Type</label>
            <select id="s9-<?php echo $action; ?>-social-counter-type">
              <option <?php echo (isset($counter['type']) && $counter['type'] == "individual" ? "selected" : ""); ?> value="individual">Individual</option>
              <option <?php echo (isset($counter['type']) && $counter['type'] == "individual & total" ? "selected" : ""); ?> value="individual & total">Individual & total</option>
              <option <?php echo (!isset($counter['type'])||isset($counter['type']) && $counter['type'] == "none" ? "selected" : ""); ?> value="none">None</option>
              <option <?php echo (isset($counter['type']) && $counter['type'] == "total" ? "selected" : ""); ?> value="total">Total</option>
            </select>
          </div>
          <div class="s9_form-group">
            <label>Minimum Share Count</label>
            <input id="s9-<?php echo $action; ?>-social-counter-min-count" type="number" value="<?php echo (isset($counter['min_show_count']) ? $counter['min_show_count'] : 0); ?>"></input>
          </div>
        </div>
      </div>
    <?php
    }
    public static function socialAnimationUI($action, $currentWidget)
    {
      $animations = '';
      if (isset($currentWidget["design"]["animations"])) {
        $animations = $currentWidget["design"]["animations"];
      }
    ?>
      <div class="s9_button-configuration">
        <h2>Animation</h2>
        <div class="s9_button-configuration-inner">
          <div class="s9_form-group">
            <label>Entrance</label>
            <select id="s9-<?php echo $action; ?>-widget-animation-entrance">
              <option <?php echo (isset($animations['entrance']) && $animations['entrance'] == "none" ? "selected" : ""); ?> value="none">none</option>
              <option <?php echo (isset($animations['entrance']) && $animations['entrance'] == "fade-in" ? "selected" : ""); ?> value="fade-in">fade-in</option>
              <option <?php echo (isset($animations['entrance']) && $animations['entrance'] == "slide-in" ? "selected" : ""); ?> value="slide-in">slide-in</option>
              <option <?php echo (isset($animations['entrance']) && $animations['entrance'] == "zoom-in" ? "selected" : ""); ?> value="zoom-in">zoom-in</option>
            </select>
          </div>
          <div class="s9_form-group">
            <label>Hover</label>
            <select id="s9-<?php echo $action; ?>-widget-animation-hover">
              <option <?php echo (isset($animations['hover']) && $animations['hover'] == "none" ? "selected" : ""); ?> value="none">none</option>
              <option <?php echo (isset($animations['hover']) && $animations['hover'] == "background" ? "selected" : ""); ?> value="background">background</option>
              <option <?php echo (isset($animations['hover']) && $animations['hover'] == "grow" ? "selected" : ""); ?> value="grow">grow</option>
            </select>
          </div>
        </div>
      </div>
    <?php
    }
    public static function socialButtonUI($action, $currentWidget)
    {
      $button = '';
      if (isset($currentWidget["design"]["buttons"])) {
        $button = $currentWidget["design"]["buttons"];
      }
    ?>
      <div class="s9_button-configuration">
        <h2>Button</h2>
        <div class="s9_button-configuration-inner">
          <div class="form-group">
            <label>Hide Social Provider Names</label>
            <div class="s9_block">
              <input data-index="2" id="s9-<?php echo $action; ?>-hide-social-provider-names" type="checkbox" <?php echo ((isset($button["hide_label"]) && $button["hide_label"] == "true") ? "checked" : ""); ?>>
              <label for="s9-<?php echo $action; ?>-hide-social-provider-names"></label>
            </div>
          </div>
          <div class="s9_form-group">
            <label>Button Color</label>
            <div class="s9_color">
              <input type="text" spellcheck="false" placeholder="#0c0ced or grey" id="s9-<?php echo $action; ?>-widget-button-color" value="<?php echo ((isset($button["bg_color"])) ? $button["bg_color"] : ""); ?>" class="s9_color-input">
              <input type="color" id="s9-<?php echo $action; ?>-widget-button-color-picker" class="s9_show-color" value="<?php echo ((isset($button["bg_color"])) ? $button["bg_color"] : ""); ?>">
              <span class="s9_color_editor dashicons dashicons-admin-customizer"></span>
            </div>
          </div>
          <div class="s9_form-group hidelabel">
            <label>Label Color</label>
            <div class="s9_color">
              <input type="text" spellcheck="false" placeholder="#0c0ced or grey" id="s9-<?php echo $action; ?>-widget-label-color" value="<?php echo ((isset($button["color"])) ? $button["color"] : ""); ?>" class="s9_color-input">
              <input type="color" id="s9-<?php echo $action; ?>-widget-label-color-picker" class="s9_show-color" value="<?php echo ((isset($button["color"])) ? $button["color"] : ""); ?>">
              <span class="s9_color_editor dashicons dashicons-admin-customizer"></span>
            </div>
          </div>
          <div class="s9_form-group">
            <label>Button Size</label>
            <select id="s9-<?php echo $action; ?>-widget-button-size">
              <option <?php echo (isset($button['size']) && $button['size'] == "large" ? "selected" : ""); ?> value="large">Large (48x48)</option>
              <option <?php echo (isset($button['size']) && $button['size'] == "medium" ? "selected" : ""); ?> value="medium">Medium (32x32)</option>
              <option <?php echo (isset($button['size']) && $button['size'] == "small" ? "selected" : ""); ?> value="small">Small (16x16)</option>
            </select>
          </div>
          <div class="s9_form-group">
            <label>Icon Color</label>
            <div class="s9_color">
              <input type="text" spellcheck="false" placeholder="#0c0ced or grey" id="s9-<?php echo $action; ?>-widget-icon-color" value="<?php echo ((isset($button["icon_color"])) ? $button["icon_color"] : ""); ?>" class="s9_color-input">
              <input type="color" id="s9-<?php echo $action; ?>-widget-icon-color-picker" class="s9_show-color" value="<?php echo ((isset($button["icon_color"])) ? $button["icon_color"] : ""); ?>">
              <span class="s9_color_editor dashicons dashicons-admin-customizer"></span>
            </div>
          </div>
          <div class="s9_form-group s9_range-slider">
            <label>Button Rounded Corners </label>
            <input type="range" id="s9-<?php echo $action; ?>-widget-corners" name="range" min="0" max="24" value="<?php echo ((isset($button["border_radius"])) ? $button["border_radius"] : "0"); ?>" step="">
          </div>
        </div>
      </div>
      <?php
    }
    public static function socialSubmitButtonUI($action, $currentWidget)
    {
      if (isset($currentWidget["id"]) && !empty($currentWidget["id"])) { ?>
        <input id="s9-<?php echo $action; ?>-widget-id" type="hidden" value="<?php echo $currentWidget["id"]; ?>">
      <?php
      }
      ?>
      <hr />
      <div id="s9-<?php echo $action; ?>-widget-submit" class="btn btn-primary">Submit</div>
      <?php
    }
    public static function socialRegisterButtonUI($action, $currentWidget)
    {
      if (isset($currentWidget["id"]) && !empty($currentWidget["id"])) { ?>
        <input id="s9-<?php echo $action; ?>-widget-id" type="hidden" value="<?php echo $currentWidget["id"]; ?>">
      <?php
      }
      ?>
      <hr />
      <div id="s9-<?php echo $action; ?>-widget-submit" class="btn btn-primary">Register</div>
    <?php
    }
    public static function randomNumber($length) {
      $min = 1 . str_repeat(0, $length-1);
      $max = str_repeat(9, $length);
      return mt_rand($min, $max);   
  }
    public static function socialWidgetNameUI($action, $currentWidget)
    {
    ?>
      <div class="s9_form-group">
        <label>Widget Name</label>
        <input type="text" id="s9-<?php echo $action; ?>-widget-name" value="<?php echo (isset($currentWidget["name"]) ? $currentWidget["name"] : "widget-".self::randomNumber(10)); ?>">
      </div>
    <?php
    }
    public static function socialContainerNameUI($action, $currentWidget)
    {
    ?>
      <div class="s9_button-configuration">
        <h2>Advanced settings</h2>
        <div class="s9_button-configuration-inner">
          <div class="s9_form-group hidefloting">
            <label>Parent Container Selector (Class)</label>
            <input type="text" id="s9-<?php echo $action; ?>-widget-container-name" value="<?php echo (isset($currentWidget['options']["container"]) && !empty($currentWidget['options']["container"]) ? $currentWidget['options']["container"] : ".s9-widget-wrapper"); ?>">
          </div>
          <div id="s9-widget-preview"></div>
          <div class="s9_form-group">
            <label>Custom Share URL</label>
            <input type="text" placeholder="e.g. https://my-other-blog.com/post/1" id="s9-<?php echo $action; ?>-widget-custom-share-url" value="<?php echo (isset($currentWidget['providers']["list"][0]["share_url"]) ? $currentWidget['providers']["list"][0]["share_url"] : ""); ?>">
          </div>
        </div>
      </div>
    <?php
    }
    public static function socialProviderUI($action, $currentWidget)
    {
    ?>
      <div class="s9_form-group">
        <label>Select Providers</label>
        <div id="s9-<?php echo $action; ?>-share-provider" class="s9-social-provider no-label">
          <?php
          $providers = array(
            "GoogleBookmarks" => false,
            "Flipboard" => false,
            "Tumblr" => false,
            "Telegram" => false,
            "Line" => false,
            "Evernote" => false,
            "Skype" => false,
            "Facebook" => true,
            "Gmail" => true,
            "Pocket" => false,
            "Buffer" => false,
            "Twitter" => true,
            "YahooMail" => false,
            "Blogger" => false,
            "LinkedIn" => true,
            "Reddit" => false,
            "Vkontakte" => false,
            "MySpace" => false,
            "Whatsapp" => false,
            "Pinterest" => false,
            "Digg" => false,
            "Print" => false,
            "Email" => false,
            "Social9" => true
          );
          if (isset($currentWidget['id'])) {
            $providers = self::sortArrayByArray($providers, $currentWidget['providers']['list']);
          }

          foreach ($providers as $provider => $status) { ?>
            <a title="<?php echo $provider; ?>" data-provider="<?php echo $provider; ?>" role="button" tabindex="0" class="s9-btn-share<?php echo (($status == true) ? " active " : " "); ?>s9-<?php echo strtolower($provider); ?>">
              <span class="s9-icon-wrap">
                <img src="<?php echo S9_SHARE_PLUGIN_URL . 'assets/images/providers/' . strtolower($provider) . '.svg'; ?>" />
              </span>
              <span class="s9-label"><?php echo $provider; ?></span>
            </a><?php
              }
                ?>
        </div>
      </div>
    <?php
    }
    public static function sortArrayByArray($array, $orderProviders)
    {
      $ordered = array();
      $modifiedArray = array();
      foreach ($array as $k => $v) {
        $modifiedArray[strtolower($k)] = $k;
        $array[$k] = false;
      }
      foreach ($orderProviders as $key => $value) {
        if ($value['name'] == strtolower($modifiedArray[$value['name']])) {
          $ordered[$modifiedArray[$value['name']]] = true;
          unset($array[$modifiedArray[$value['name']]]);
        }
      }
      return $ordered + $array;
    }
    public static function tool_social_widget($action, $currentWidget)
    {
    ?>
      <script type="text/javascript" src="//cdn.social9.com/js/s9-sdk.min.js"></script>
      <section>
        <div class="s9_section-header">
          <h1>Social Widget</h1>
        </div>
        <div class="s9-message"></div>
        <div class="s9_button-configuration">
          <div class="s9_button-configuration-inner">
            <?php
            self::socialWidgetTypeUI($action, $currentWidget);
            self::socialWidgetNameUI($action, $currentWidget);
            ?>
          </div>
        </div>
        <?php
        self::socialProviderUI($action, $currentWidget);
        self::socialButtonUI($action, $currentWidget);
        self::socialAnimationUI($action, $currentWidget);
        self::socialCounterUI($action, $currentWidget);
        self::socialLayoutUI($action, $currentWidget);
        self::socialContainerNameUI($action, $currentWidget);
        if ($action == "guest") {
          self::socialRegisterButtonUI($action, $currentWidget);
        } else {
          self::socialSubmitButtonUI($action, $currentWidget);
        }
        ?>
      </section>
    <?php
    }
    /**
     * Render social sharing settings page.
     */
    public static function render_options_page()
    {
    ?>
      <div id="s9_root">
        <?php do_action('s9_admin_header_ui'); ?>
        <div class="s9_main">
          <?php

          if (isset($_POST['reset']) && current_user_can('manage_options')) {
            S9_Core::reset_share_options();
            echo '<p style="display:none;" class="s9-alert-box s9-notif">Sharing settings have been reset and default values have been applied to the plug-in</p>';
            echo '<script type="text/javascript">jQuery(function(){jQuery(".s9-notif").slideDown().delay(3000).slideUp();});</script>';
          }

          $social9AccountId = get_option('social9_account_id');
          $myListTable = new S9_Widget_List_Table();
          if (isset($_GET['action']) && in_array($_GET['action'], array("new", "edit", "guest"))) {
            $toolType = isset($_GET['type']) && !empty($_GET['type']) ? trim($_GET['type']) : 'inline';
            $currentWidget = false;
            if (in_array($toolType, array("inline", "floating"))) {
              if (isset($_GET['share']) && !empty($_GET['share'])) {
                $wid = $_GET['share'];
                require_once(S9_CORE_DIR . 'lib/social9_sdk.php');
                $s9sdk = new Social9();
                if (!empty($social9AccountId)) {
                  $currentWidget = $s9sdk->getWidgetByWidgetId($social9AccountId, $wid);
                }
              }
              self::tool_social_widget($_GET['action'], $currentWidget);
            }
          } else if (!empty($social9AccountId)) {
          ?>
            <div class="s9-widget-table">
              <?php
              echo sprintf('<a class="button button-primary s9-new-widget-button" href="?page=%s&action=%s">New Widget</a>', $_REQUEST['page'], 'new');
              $myListTable->prepare_items();
              $myListTable->display();
              ?>
            </div>
          <?php
          } else {
          ?>
            <script>
              window.location.href = "?page=social9";
            </script>
          <?php
          }
          ?>
        </div>
      </div>
    <?php
	do_action('s9_create_mailazy_ui');
    }
    public static function new_tool_selection_option()
    {
    ?>
      <div class="wrap s9-wrap cf">
        <header>
          <h2 class="logo"><a href="//www.social9.com" target="_blank">social9</a></h2>
        </header>
        <h1>Select and configure a share button!</h1>
        <style>
          .cls-2 {
            fill: #c9c9c9
          }

          .buttonlabel {
            padding: 10px 20px;
            display: flex;
          }

          .sharing-buttons.d-flex.align-items-center {
            background: #ddd;
            width: 250px;
            display: inline-block;
            padding: 30px;
            cursor: pointer;
          }

          .sharing-buttons.d-flex.align-items-center svg {
            width: 80px;
            float: left;
          }
        </style>
        <div class="button-wrapper d-flex justify-content-between flex-wrap">
          <?php
          foreach (array('inline', 'floating') as $type) {
          ?>
            <a href="admin.php?page=social9_share&action=new&tab=<?php echo $type; ?>">
              <div class="sharing-buttons inline d-flex align-items-center">
                <img src="<?php echo S9_SHARE_PLUGIN_URL . 'assets/images/' . $type . '.svg'; ?>" />
                <div class="buttonlabel"><?php echo $type; ?> Sharing Button</div>
              </div>
            </a>
          <?php
          }
          ?>
        </div>
  <?php
    }
  }

  new S9_Social_Share_Settings();
}
