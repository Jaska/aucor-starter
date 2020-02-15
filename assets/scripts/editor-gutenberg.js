/* ==========================================================================
  editor-gutenberg.js
========================================================================== */

/**
 * Modify style variants.
 */
wp.domReady(function() {

  // remove button styles
  wp.blocks.unregisterBlockStyle('core/button', 'outline');
  wp.blocks.unregisterBlockStyle('core/button', 'squared');

  // remove separator styles
  wp.blocks.unregisterBlockStyle('core/separator', 'dots');
  wp.blocks.unregisterBlockStyle('core/separator', 'wide');

  // remove quote styles
  wp.blocks.unregisterBlockStyle('core/quote', 'large');

//  // add lead paragraph style
 wp.blocks.registerBlockStyle('core/paragraph', {
   name: 'lead',
   label: 'Lead paragraph',
 });

  wp.blocks.registerBlockStyle('core/table', {
    name: 'no_lines',
    label: 'Ei rivejä | No lines',
  });

});

function setWideDefault( settings, name ) {
  if ( name !== 'core/columns' ) {
      return settings;
  }
  console.log(settings);
  return lodash.assign( {}, settings, {
      attributes: lodash.assign( {}, settings.attributes, {
          align: {
              default: 'wide'
          }
      } ),
  } );
}
wp.hooks.addFilter(
  'blocks.registerBlockType',
  'my-plugin/class-names/column-block',
  setWideDefault
);
