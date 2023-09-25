(function ($) {
  "use strict";

  /* ---------------------------------------------------------------------------
   * Admin area
   * --------------------------------------------------------------------------- */
  $(document).ready(function () {
    var mediaUploader,
      metaBox = $('.imicra-term-group'),
      add_btn = metaBox.find('.tax_media_button'),
      remove_btn = metaBox.find('.tax_media_remove'),
      img_container = metaBox.find('#taxonomy-image-wrapper'),
      input = metaBox.find('#taxonomy-image-id');

    add_btn.on('click', function (e) {
      e.preventDefault();

      if (mediaUploader) {
        mediaUploader.open();
        return;
      }

      mediaUploader = wp.media({
        title: 'Выбрать Изображение',
        button: {
          text: 'Выбрать Изображение'
        },
        multiple: false
      });

      mediaUploader.on('select', function () {
        var attachment = mediaUploader.state().get('selection').first().toJSON();

        input.val(attachment.id);
        img_container.html('<img src="' + attachment.url + '" style="width: 100px; height: 100px; object-fit: cover;"/>');
      });

      mediaUploader.open();
    });

    remove_btn.on('click', function (e) {
      e.preventDefault();

      input.val('');
      img_container.html('');
    });

    $('#addtag #submit').on('click', function () {
      img_container.html('');
    });

  });

}(jQuery));
