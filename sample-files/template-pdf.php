<?php
/*
 * Template Name: Formidable to PDF
 * Description: Document Print/PDF Template
 */
?>
<html>
  <head>
    <title>Page Title</title>
    <link rel=“stylesheet” type=“text/css” href=“”>
    <link rel=“stylesheet” type=“text/css” href=“” media=“print” />
  </head>
  <div id=“page”> <!-- Page -->
    <div id=“view”> <!-- View -->
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
        <?php comments_template( '', true ); ?>
        <?php echo FrmProDisplaysController::get_shortcode(array('id' => 29));?>
      <?php endwhile; // end of the loop. ?>
    </div> <!-- END View -->
  </div> <!-- END Page -->
</html>