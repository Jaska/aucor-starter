<?php
function add_crop_button_to_acf_images( $field ) {
  if (! is_plugin_active('crop-thumbnails/crop-thumbnails.php') ) {
    return;
  }
  $block_id = 'pic--'.wp_generate_uuid4();
  echo '<div class="crop-button__container" style="margin-top:3px;" id="'.$block_id.'"></div>';
  ?>
  <script>
	jQuery(document).ready(function($) {
		//add a button right beside the add media button - adjust if you want the button somewhere else
    $('#<?php echo $block_id; ?>').append('<button type="button" id="<?php echo $block_id;?>__button" class="button">Rajaa kuva</button>');

		$('#<?php echo $block_id;?>__button').click(function() {
			/**
			 * the ID of the image you want to open
			 * you may want to read the value by javascript from somewhere
			 **/
      var attachementId = $('#<?php echo $block_id ?>').parent().find('input[type="hidden"]').attr('value');
      // console.log(attachementId);

      if (attachementId === null || attachementId === undefined || attachementId == ''){
        return;
      }

      // var attachementId = 123;

			/** the posttype decides what imagesizes should be visible - see settings **/
			var postType = 'post';

			/** the title of the modal dialog */
			var title = 'Rajaa kuva';

			/** lets open the crop-thumbnails-modal **/
			var modal = new CROP_THUMBNAILS_VUE.modal();
			modal.open(attachementId, postType, title);
		});
	});
  </script>
  <style>
    .crop-button__container {
      display: none;
    }
    .acf-image-uploader.has-value + .crop-button__container {
      display: block;
    }
  </style>
  <?php
}

// Apply to image fields.
add_action('acf/render_field/type=image', 'add_crop_button_to_acf_images');
