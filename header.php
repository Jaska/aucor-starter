<?php
/**
 * Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aucor_starter
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<div id="page" class="site">
  <a class="skip-to-content screen-reader-text" href="#content"><?php ask_e('Accessibility: Skip to content'); ?></a>

  <header id="masthead" class="site-header" itemscope itemtype="http://schema.org/WPHeader">

    <div class="site-header__container">

      <div class="site-header__branding">

        <span class="site-header__branding__title">
          <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="headline">
            <span class="screen-reader-text"><?php bloginfo('name'); ?></span>
            <?php
            $logo = get_template_directory_uri().'/dist/images/logo.svg';
            echo '<img class="site-header__branding__logo" src="'.$logo.'" />';
            ?>
          </a>
        </span>

        <?php aucor_starter_menu_toggle_btn('menu-toggle'); ?>

      </div><!-- .site-branding -->

      <?php get_template_part('partials/navigation/menu-primary'); ?>

    </div>

  </header><!-- #masthead -->

  <div id="content" class="site-content" role="main" itemscope itemprop="mainContentOfPage">
