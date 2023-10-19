<?php
/**
 * Ajax Forms actions.
 */

/**
 * Form on frontpage
 */
function imicra_form_cta_cb() {
  // $_POST data
  $name = wp_strip_all_tags( $_POST['name'] );
  $phone = wp_strip_all_tags( $_POST['phone'] );

  // prepare email
  $imicra_site_options_mail = get_option( 'imicra_mail' );
	$email_admin = $imicra_site_options_mail;
	$host = $_SERVER['SERVER_NAME'];
	$sitename = 'info@' . $host;
  $to = [];
	$to[] = $email_admin;
	$subject = "Форма Телефон с сайта \"$sitename\"";

  $message = '';

  if ( ! empty( $name ) ) {
    $message .= "Имя: <b>{$name}</b><br>";
  }
  if ( ! empty( $phone ) ) {
    $message .= "Телефон: <b>{$phone}</b><br>";
  }
	$headers[] = 'From: Сайт <info@' . $host . '>';
  $headers[] = 'Content-Type: text/html';
  $headers[] = 'charset=UTF-8';

  if ( wp_mail( $to, $subject, $message, $headers ) ) {
    $data = array(
      'success' => true,
      'message' => 'Спасибо! Ваше сообщение отправлено'
    );
  
    wp_send_json( $data );
  }

  wp_die();
}
add_action( 'wp_ajax_imicra_form_cta', 'imicra_form_cta_cb' );
add_action( 'wp_ajax_nopriv_imicra_form_cta', 'imicra_form_cta_cb' );
