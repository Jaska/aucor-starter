<?php

function af_filter_args( $args, $form ) {
  $args['submit_text'] = ask__('Forms: Lähetä');

  return $args;
}
add_filter( 'af/form/args', 'af_filter_args', 10, 2 );
