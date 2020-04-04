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

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<div class="mobile-menu js-mobile-menu">
  <div class="mobile-menu__nav" role="dialog">
    <?php Aucor_Menu_Toggle::render(); ?>
    <div class="mobile-menu__nav__inner">
      <?php Aucor_Menu_Primary::render(); ?>
      <?php Aucor_Menu_Upper::render(); ?>
    </div>
  </div>
  <div class="mobile-menu__overlay" data-a11y-dialog-hide tabindex="-1"></div>
</div>

<div id="page" class="site js-page">

  <svg class="svg-effects" aria-hidden="true">
    <filter id="svg-effects-blur">
      <feGaussianBlur stdDeviation="10"></feGaussianBlur>
      <feColorMatrix type="matrix" values="1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 9 0"></feColorMatrix>
      <feComposite in2="SourceGraphic" operator="in"></feComposite>
    </filter>
  </svg>

  <a class="skip-to-content" href="#content"><?php ask_e('Accessibility: Skip to content'); ?></a>

  <header id="masthead" class="site-header" itemscope itemtype="https://schema.org/WPHeader">
    <div class="site-header__inner">

    <div class="site-header__branding">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__title" rel="home" itemprop="headline">
        <span class="screen-reader-text"><?php bloginfo('name'); ?></span>
        <?php include 'dist/images/logo.svg'; ?>
      </a>
    </div>

    <?php Aucor_Menu_Toggle::render(); ?>

    <div class="site-header__menus">
      <div class="site-header__upper desktop-menu">
        <?php Aucor_Menu_Upper::render(); ?>
      </div>
      <div class="site-header__main desktop-menu">
        <?php Aucor_Menu_Primary::render(); ?>
      </div>
    </div>

    </div>
  </header>

  <div id="content" class="site-content" role="main" itemscope itemprop="mainContentOfPage">
