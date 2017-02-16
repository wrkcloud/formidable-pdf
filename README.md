# Formidable View to PDF/Print
Create a PDF or Print of a Formidable View using your browser and no additional plugins.

<h2>Step 1: Create a new Template</h2>
First you need to create a new PHP file in your site’s theme folder: `wp-content/themes/{your_theme}/` we called ours `template-pdf.php`.<br>Once created open the file and give WordPress something to call in the Template dropdown. We'll create the HTML body of the page to hold our View as well - this includes the link tags for the stylesheets and the Formidable Display Controller.

```
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
```
That's it for the template - we'll come back in a few steps to add a few things.

<h2>Step 2: Stylesheets</h2>
You'll need to create your stylesheets as your theme's won't be called into the template.<br>
We used two - one (`style.css`) to style the page and View and the other (`print.css`) to omit styles from PDF/Print.<br>
Here's a quick example of how we setup `style.css`:
```
html {
   background: #525659;
}

div#page {
   width:100%;
   display: block;
}

div#view {
   position: absolute;
   margin: 0 auto;
   top: 50;
   right: 0;
   bottom: 0;
   left: 0;
   width: 800px; /* Pre determined width of an A4 page */
   max-height: 1132px; 
   background-color: #FFFFFF;
   border-radius: 10px;
}
```
Note: We set the `width` and `max-height` of `div#view` to A4 - using Photoshop to get the pixel values and then scale them down proportionally to a screen-friendly size.

- Go back to `template-pdf.php` and add the path of your stylesheets to the `<link>` tags.

<h2>Step 3: The View</h2>
Create or open the View you plan on turning into a PDF/Print.<br>
We used a `table` layout and set it's `width` to match `div#view`

- Go back to `template-pdf.php` `<?php echo FrmProDisplaysController::get_shortcode(array('id' => 29));?>` and replace 29 with your View ID
