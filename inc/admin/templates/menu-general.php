<?php
/**
 * Admin General Menu Page Template.
 *
 * @package imicra
 */
?>

<h1>Основные настройки сайта</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
  <?php settings_fields( 'imicra-settings-general' ); ?>
  <?php do_settings_sections( 'imicra_settings' ); ?>
  <?php submit_button(); ?>
</form>