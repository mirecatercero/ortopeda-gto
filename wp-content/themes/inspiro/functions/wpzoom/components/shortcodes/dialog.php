<?php
if ( ! class_exists( 'WPZOOM' ) ) die();
$support_shortcodes = file_exists(WPZOOM::get_wpzoom_root() . '/assets/css/shortcodes.css');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
</head>
<body>
<div id="wpz-dialog">

<?php if ( $support_shortcodes ) { ?>

<div id="wpz-options-buttons" class="clear">
    <div class="alignleft">

        <input type="button" id="wpz-btn-cancel" class="button" name="cancel" value="<?php _e('Cancel', 'wpzoom'); ?>" accesskey="C" />

    </div>
    <div class="alignright">

        <input type="button" id="wpz-btn-preview" class="button" name="preview" value="<?php _e('Preview', 'wpzoom'); ?>" accesskey="P" />
        <input type="button" id="wpz-btn-insert" class="button-primary" name="insert" value="<?php _e('Insert', 'wpzoom'); ?>" accesskey="I" />

    </div>
    <div class="clear"></div><!--/.clear-->
</div><!--/#wpz-options-buttons .clear-->

<div id="wpz-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'wpzoom' ); ?></h3>

    <table id="wpz-options-table">
    </table>

</div>

<div id="wpz-preview" class="alignleft">

    <h3><?php echo __( 'Preview', 'wpzoom' ); ?></h3>

    <iframe id="wpz-preview-iframe" frameborder="0" style="width:100%;height:250px" scrolling="no"></iframe>

</div>
<div class="clear"></div>

<script type="text/javascript">var shortcode_generator_url = '<?php echo WPZOOM::$assetsPath . '/js/shortcode-generator/'; ?>';</script>
<script type="text/javascript" src="<?php echo WPZOOM::$assetsPath; ?>/js/shortcode-generator/column-control.js"></script>
<script type="text/javascript" src="<?php echo WPZOOM::$assetsPath; ?>/js/shortcode-generator/tab-control.js"></script>
<script type="text/javascript" src="<?php echo WPZOOM::$assetsPath; ?>/js/shortcode-generator/dialog.js"></script>
<?php  }  else { ?>

<div id="wpz-options-error">
    <p><?php echo __( 'Your version of theme does not yet support shortcodes.', 'wpzoom' ); ?></p>
</div>

<?php  } ?>

</div>

</body>
</html>
