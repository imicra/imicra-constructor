<?php
/**
 * The modal
 *
 * @package imicra
 */
?>
<div class="modal modal--preload transparent modal--form">
  <div class="modal__wrapper">
    <div class="modal__content">
      <div class="modal__inner">
        <div class="modal__inner-item">
          <div class="form-wrapper"></div>
        </div>
      </div>
      <button class="modal__close-btn hover" type="button" aria-label="Закрыть попап">
        <?php echo imicra_get_svg( array( 'icon' => 'cross' ) ); ?>
      </button>
    </div>
  </div>
</div>

<div class="modal modal--preload modal--success success transparent">
  <div class="modal__wrapper">
    <div class="modal__content">
      <button class="modal__close-btn hover" type="button" aria-label="Закрыть попап">
        <?php echo imicra_get_svg( array( 'icon' => 'cross' ) ); ?>
      </button>
      <div class="text-center">
        <h2 class="h1">Спасибо!</h2>
        <p>Ваша заявка успешно отправлена</p>
      </div>
    </div>
  </div>
</div>