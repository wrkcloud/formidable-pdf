# Formidable View to PDF/Print
Create a PDF or Print of a Formidable View using your browser and no additional plugins.

We have only tested this process on the following (*tested in BrowserStack):

macOS Sierra | Safari | 10.0.3<br>
macOS Sierra | Chrome | 56<br>
macOS Sierra | Firefox | 51<br>
Win8.1 | IE | 11* <br>
Win8.1 | Chrome | 56* <br>

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
We used two - one (`style.css`) will style the page and View and the other (`print.css`) will omit or add styles to PDF/Print.<br>
Here's a quick example of how we set up `style.css`:
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

<h2>Step 4: The Page</h2>
You've created the template, set some broad styles and linked your View so we can now create the page that will display the PDF/Print.<br>

Create a new Page in the WP Dashboard, name the page and leave the content blank.<br>
In the Template dropdown `Formidable to PDF` will now be an option. Select it and publish the page.<br>
Navigate to the page and you will see your View in the center of the page formatted to the proportions of an A4 page.<br>
Now you can see the View you'll be able to fine tune it's content and styles in `style.css`.

<h2>Step 5: Okay, give me a PDF</h2>
To produce a PDF of the View or Print the View we will use the browser's built in Print capability.<br>

<h4>PDF Process</h4>
- Action your browser's print process
- The print preview window will open
- In most browsers there will be an option to 'Save as PDF' in Chrome this feature is hidden in the Destinations
- Disable the Headers & Footers
- Save your PDF!

<h4>Print Process</h4>
- Exactly the same as the PDF Process just hit 'Print' instead!

Granted this doesn't have the same UX as just clicking a download button - but until Formidable add the capability or a reliable plugin comes around this is a stop-gap we're happy to live with.<br>
Not to mention it doesn't eat the soul of your server resources trying to create a PDF or fill in a PDF Form.

<h2>Tested Formidable Features</h2>
Here's a list of the Formidable features and capabilities that we have tried so far (with Yes or No if it worked or not:)<br>
- Insert a View (Yes)
- Filter a View (Yes, we filtered using two fields and [get param] )
- Nested Views (Yes, two Views deep)
- Multiple Views (Yes)
- Dynamic Fields (Yes)
- Related Dynamic Lists (Yes)
- Repeatable Fields (Yes)
- Insert a View in `<title>` (Yes, useful for setting filename of the PDF)
- Filter a View in `<title>` (No, not investigated further yet)

We can't see any reason why the majority of Formidable wouldn't work - if we find more we'll add them here.

<h2>Notes</h2>
We're only 12 hours into adding this functionality to our site so it's still a baby, but as it grows and we discover new things we'll add them here.<br>
Here's a few things we've already found:<br>
- To permanently remove the browser placed Header and Footer add this to your `print.css`. You'll need to faf around with the `body margin` to make sure it all lines up with your printers margins - in the end we deemed it easier just to untick 'Header & Footer in the Print window (they don't show up at all when doing a PDF anyway). 
```
@media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
```
- Browsers remove `background-color` to save ink, but if you need some color added back in there's a -webkit- property that will do the trick (in WebKit browsers...). In `print.css` add the following to the selector's declaration (you'll need this to put the colour back in PDF's as well):
```
-webkit-print-color-adjust: exact;
````










