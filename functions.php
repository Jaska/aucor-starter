<?php
/**
 * Include PHP files, nothing else.
 *
 * All the functions, hooks and setup should be on their own
 * filer organized at /inc/. The names of files should describe
 * what the file does as following:
 *
 * `register-`  configures new settings and assets
 * `setup-`     configures existing settings and assets
 * `function-`  adds functions to be used in templates
 *
 * @package aucor_starter
 */

/**
 * Configuration
 */
require_once 'inc/_conf/register-assets.php';
require_once 'inc/_conf/register-blocks.php';
require_once 'inc/_conf/register-image-sizes.php';
require_once 'inc/_conf/register-localization.php';
require_once 'inc/_conf/register-menus.php';
require_once 'inc/_conf/image-crop-fixer.php';
require_once 'inc/_conf/cpt.php';
// require_once 'inc/_conf/deregister-functionality.php';
require_once 'inc/_conf/add-nonpublic-cpt-to-polylang.php';

/**
 * Custom blocks
 */
require_once 'inc/_conf/register-custom-blocks.php';

/**
 * Editor
 */
require_once 'inc/editor/setup-classic-editor.php';
require_once 'inc/editor/setup-gutenberg.php';
require_once 'inc/editor/setup-theme-support.php';
require_once 'inc/editor/cpt-class-gutenberg.php';

/**
 * Forms
 */
require_once 'inc/forms/function-search-form.php';
require_once 'inc/forms/af-forms-submit-text.php';

/**
 * Helpers
 */
require_once 'inc/helpers/function-dates.php';
require_once 'inc/helpers/function-entry-footer.php';
require_once 'inc/helpers/function-hardcoded-ids.php';
require_once 'inc/helpers/function-html-attributes.php';
require_once 'inc/helpers/function-last-edited.php';
require_once 'inc/helpers/function-titles.php';
require_once 'inc/helpers/menu-shortcode.php';
require_once 'inc/helpers/setup-fallbacks.php';
require_once 'inc/helpers/function-get-lang-content.php';
require_once 'inc/helpers/function-get-relevant-sidebar.php';
require_once 'inc/helpers/function-get-archive-post-type.php';
require_once 'inc/helpers/function-get-relevant-sections.php';
// require_once 'inc/helpers/function-sibling-nav.php';
// require_once 'inc/helpers/get-content-filters.php';
require_once 'inc/helpers/function-display-map.php';
require_once 'inc/helpers/add-crop-button-acf-images.php';
require_once 'inc/helpers/show-image-with-admin-lists.php';

/**
 * Media
 */
require_once 'inc/media/function-image.php';
require_once 'inc/media/function-svg.php';

/**
 * Navigation
 */
require_once 'inc/navigation/function-menu-toggle.php';
require_once 'inc/navigation/function-numeric-posts-nav.php';
require_once 'inc/navigation/function-share-buttons.php';
require_once 'inc/navigation/function-sub-pages-nav.php';
require_once 'inc/navigation/setup-menu-hooks.php';


