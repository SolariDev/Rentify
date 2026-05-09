<?php
/*
Template Name: Rentify Base
Description: Plantilla mínima para incrustar shortcodes del plugin Rentify.
Author: Gabriel Solari - SolariDev
Version: 1.0.0
*/

defined('ABSPATH') || exit;

get_header(); ?>

<main id="primary" class="site-main rentify-base">
   <?php the_content(); ?>
</main>

<?php get_footer(); ?>
