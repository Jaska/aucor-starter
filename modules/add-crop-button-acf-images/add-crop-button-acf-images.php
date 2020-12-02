<?php
function add_crop_button_to_acf_images($field)
{
  if (!is_plugin_active('crop-thumbnails/crop-thumbnails.php')) {
    return;
  }
  $block_id = 'pic--' . wp_generate_uuid4();
  echo '<div class="crop-button__container" style="margin-top:3px;" id="' . $block_id . '"></div>';
?>
  <script>
    jQuery(document).ready(function($) {

      let add_crop_button = function(block_id) {
        let $ = jQuery;
        let $block = $('#' + block_id);
        let $existing_button = $block.find('#' + block_id + '__button');

        // only one button
        if ($existing_button.length) {
          return false;
        }
        $block.append('<button type="button" id="' + block_id + '__button" class="button">Rajaa kuva</button>');

        $('#' + block_id + '__button').click(function() {

          var attachment_id = $block.parent().find('input[type="hidden"]').attr('value');

          if (attachment_id === null || attachment_id === undefined || attachment_id == '') {
            return;
          }

          /** the posttype decides what imagesizes should be visible - see settings **/
          var postType = 'post';

          /** the title of the modal dialog */
          var title = 'Rajaa kuva';

          /** lets open the crop-thumbnails-modal **/
          var modal = new CROP_THUMBNAILS_VUE.modal();
          modal.open(attachment_id, postType, title);
        });

      }

      //add a button right beside the add media button - adjust if you want the button somewhere else
      add_crop_button('<?php echo $block_id; ?>');

    });
  </script>

  <?php
  static $result;
  if ($result !== null) {
  } else {
    $result = '1';
  ?>
    <style>
      .crop-button__container {
        display: none;
      }

      .acf-image-uploader.has-value+.crop-button__container {
        display: block;
      }
    </style>
<?php
  }
}

// Apply to image fields.
add_action('acf/render_field/type=image', 'add_crop_button_to_acf_images');
