<?php return array(


/* Theme Admin Menu */
"menu" => array(
    array("id"    => "1",
          "name"  => "General"),

    array("id"    => "2",
          "name"  => "Homepage"),
),

/* Theme Admin Options */
"id1" => array(
    array("type"  => "preheader",
          "name"  => "Theme Settings"),

    array("name"  => "Custom Feed URL",
          "desc"  => "Example: <strong>http://feeds.feedburner.com/wpzoom</strong>",
          "id"    => "misc_feedburner",
          "std"   => "",
          "type"  => "text"),

	array("name"  => "Enable comments for static pages",
          "id"    => "comments_page",
          "std"   => "off",
          "type"  => "checkbox"),

    array("name"  => "Display WooCommerce Cart Button in the Header?",
          "id"    => "cart_icon",
          "std"   => "on",
          "type"  => "checkbox"),

    array(
        "type" => "preheader",
        "name" => "Layouts",
    ),

    array(
        "name" => "Shop Page (WooCommerce)",
        "desc" => "Select the layout for Shop page",
        "id" => "layout_shop",
        "options" => array(
            'side-left' => 'Sidebar on the left',
            'full' => 'Full Width',
            'side-right' => 'Sidebar on the right',
        ),
        "std" => "side-right",
        "type" => "select-layout",
    ),

    array(
        "name" => "Single Product Page (WooCommerce)",
        "desc" => "Select the layout for products page in shop",
        "id" => "layout_product",
        "options" => array(
            'side-left' => 'Sidebar on the left',
            'full' => 'Full Width',
            'side-right' => 'Sidebar on the right',
        ),
        "std" => "side-right",
        "type" => "select-layout",
    ),

      array(
            "type" => "preheader",
            "name" => "Blog Posts Options"
        ),

        array(
            "name" => "Content",
            "desc" => "Number of posts displayed on homepage can be changed <a href=\"options-reading.php\" target=\"_blank\">here</a>.",
            "id" => "display_content",
            "options" => array(
                'Excerpt',
                'Full Content',
                'None'
            ),
            "std" => "Excerpt",
            "type" => "select"
        ),

        array(
            "name" => "Excerpt length",
            "desc" => "Default: <strong>50</strong> (words)",
            "id" => "excerpt_length",
            "std" => "50",
            "type" => "text"
        ),

        array(
            "type" => "startsub",
            "name" => "Featured Image"
        ),

        array(
            "name" => "Display Featured Image at the Top",
            "id" => "index_thumb",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Featured Image Width (in pixels)",
            "desc" => "Default: <strong>950</strong> (pixels).<br/><br/>You'll have to run the <a href=\"http://wordpress.org/extend/plugins/regenerate-thumbnails/\" target=\"_blank\">Regenerate Thumbnails</a> plugin each time you modify width or height (<a href=\"http://www.wpzoom.com/tutorial/fixing-stretched-images/\" target=\"_blank\">view how</a>).",
            "id" => "thumb_width",
            "std" => "950",
            "type" => "text"
        ),

        array(
            "name" => "Featured Image Height (in pixels)",
            "desc" => "Default: <strong>320</strong> (pixels)",
            "id" => "thumb_height",
            "std" => "320",
            "type" => "text"
        ),

        array(
            "type" => "endsub"
        ),


        array(
            "name" => "Display Category",
            "id" => "display_category",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Author",
            "id" => "display_author",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Date/Time",
            "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "id" => "display_date",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "name" => "Display Comments Count",
            "id" => "display_comments",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "type" => "preheader",
            "name" => "Single Posts Options"
        ),

        array("name"  => "Enable Dark Overlay in the Header?",
              "id"    => "post_overlay",
              "std"   => "on",
              "type"  => "checkbox"),


        array(
            "name" => "Display Category",
            "id" => "post_category",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Date/Time",
            "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
            "id" => "post_date",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Tags",
            "id" => "post_tags",
            "std" => "on",
            "type" => "checkbox"
        ),

        array(
            "name" => "Display Author",
            "desc" => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
            "id" => "post_author",
            "std" => "on",
            "type" => "checkbox"
        ),


        array("type" => "startsub",
               "name" => "Share Buttons"),

          array("name"  => "Display Share Buttons",
                "id"    => "post_share",
                "std"   => "on",
                "type"  => "checkbox"),

          array("name"  => "Twitter Button Label",
                "desc"  => "Default: <strong>Share on Twitter</strong>",
                "id"    => "post_share_label_twitter",
                "std"   => "Share on Twitter",
                "type"  => "text"),

          array("name"  => "Facebook Button Label",
                "desc"  => "Default: <strong>Share on Facebook</strong>",
                "id"    => "post_share_label_facebook",
                "std"   => "Share on Facebook",
                "type"  => "text"),

          array("name"  => "Google+ Button Label",
                "desc"  => "Default: <strong>Share on Google+</strong>",
                "id"    => "post_share_label_gplus",
                "std"   => "Share on Google+",
                "type"  => "text"),

        array("type"  => "endsub"),



        array(
            "name" => "Display Comments",
            "id" => "post_comments",
            "std" => "on",
            "type" => "checkbox"
        ),


        array(
            "name" => "Display Previous Post Banner",
            "id" => "post_nextprev",
            "std" => "on",
            "type" => "checkbox"
        ),


    ),


"id2" => array(

    array("type"  => "preheader",
          "name"  => "Homepage Slideshow"),

    array("name"  => "Display Slideshow on homepage?",
          "desc"  => "Do you want to show a featured slider on the homepage? To add posts in slider, go to <a href='edit.php?post_type=slider' target='_blank'>Slideshow section</a>",
          "id"    => "featured_posts_show",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Autoplay Slideshow?",
          "desc"  => "Do you want to auto-scroll the slides?",
          "id"    => "slideshow_auto",
          "std"   => "off",
          "type"  => "checkbox",
          "js"    => true),

    array("name"  => "Enable Dark Overlay?",
          "id"    => "slideshow_overlay",
          "std"   => "on",
          "type"  => "checkbox"),


    array("name"  => "Display Slide Title",
          "id"    => "slideshow_title",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Display Slide Content",
          "id"    => "slideshow_excerpt",
          "std"   => "on",
          "type"  => "checkbox"),


    array("name"  => "Display Navigation Arrows?",
          "id"    => "slideshow_arrows",
          "std"   => "on",
          "type"  => "checkbox",
          "js"    => true),


    array("name"  => "Display Scroll to Content pointer?",
          "desc"  => "This pointer is located at the bottom center of the slideshow and when you click it the page scrolls to the next section located below the slideshow.",
          "id"    => "slideshow_scroll",
          "std"   => "on",
          "type"  => "checkbox"),

    array("name"  => "Slider Autoplay Interval",
          "desc"  => "Select the interval (in miliseconds) at which the Slider should change posts (<strong>if autoplay is enabled</strong>). Default: 3000 (3 seconds).",
          "id"    => "slideshow_speed",
          "std"   => "3000",
          "type"  => "text",
          "js"    => true),

    array("name"  => "Slider Effect",
          "desc"  => "Select the effect for slides transition.",
          "id"    => "slideshow_effect",
          "options" => array('Slide', 'Fade'),
          "std"   => "Slide",
          "type"  => "select",
          "js"    => true),

    array("name"  => "Number of Posts in Slider",
          "desc"  => "How many posts should appear in  Slider on the homepage? Default: 5.",
          "id"    => "featured_posts_posts",
          "std"   => "5",
          "type"  => "text",
          "js"    => true),
),

"portfolio" => array(
   array(
       "type" => "preheader",
       "name" => "Portfolio Page"
   ),

   array(
       "name" => "Posts per Page in Paginated templates",
       "desc" => "Default: <strong>9</strong>",
       "id" => "portfolio_posts",
       "std" => "9",
       "type" => "text"
   ),

   array("type" => "startsub",
          "name" => "Lightbox Options"),

        array(
            "name" => "Enable Lightbox",
            "desc" => "By enabling this option, each portfolio post will display a lightbox icon in Portfolio page that will display a video or a large image.",
            "id" => "lightbox_enable",
            "std" => "on",
            "type" => "checkbox"
        ),


   array("type"  => "endsub"),

   array(
       "name" => "Display Portfolio Posts Excerpt",
       "desc" => "Not visible when Lightbox is enabled",
       "id" => "portfolio_excerpt",
       "std" => "on",
       "type" => "checkbox"
   ),


   array(
       "name" => "Display Read More button",
       "id" => "portfolio_btn",
       "desc" => "Not visible when Lightbox is enabled",
       "std" => "on",
       "type" => "checkbox"
   ),

   array(
       "name" => "Portfolio Page",
       "desc" => "Choose the page to which should link <em>All</em> button.",
       "id" => "portfolio_url",
       "std" => "",
       "type" => "select-page"
   ),


   array(
       "type" => "preheader",
       "name" => "Single Portfolio Posts"
   ),


   array(
       "desc" => sprintf('Here you can change the options for individual Portfolio post pages. '),
       "type" => "paragraph",
   ),


   array("name"  => "Enable Dark Overlay in the Header?",
         "id"    => "portfolio_post_overlay",
         "std"   => "on",
         "type"  => "checkbox"),

   array("name"  => "Enable Video Lightbox",
         "id"    => "portfolio_post_lightbox",
         "std"   => "on",
         "type"  => "checkbox"),

   array(
       "name" => "Display Category",
       "id" => "portfolio_category",
       "std" => "on",
       "type" => "checkbox"
   ),

   array(
       "name" => "Display Date/Time",
       "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
       "id" => "portfolio_date",
       "std" => "on",
       "type" => "checkbox"
   ),

   array(
       "name" => "Display Author",
       "desc" => "You can edit your profile on this <a href='profile.php' target='_blank'>page</a>.",
       "id" => "portfolio_author",
       "std" => "on",
       "type" => "checkbox"
   ),


   array("type" => "startsub",
          "name" => "Share Buttons"),

     array("name"  => "Display Share Buttons",
           "id"    => "portfolio_share",
           "std"   => "on",
           "type"  => "checkbox"),

     array("name"  => "Twitter Button Label",
           "desc"  => "Default: <strong>Share on Twitter</strong>",
           "id"    => "portfolio_share_label_twitter",
           "std"   => "Share on Twitter",
           "type"  => "text"),

     array("name"  => "Facebook Button Label",
           "desc"  => "Default: <strong>Share on Facebook</strong>",
           "id"    => "portfolio_share_label_facebook",
           "std"   => "Share on Facebook",
           "type"  => "text"),

     array("name"  => "Google+ Button Label",
           "desc"  => "Default: <strong>Share on Google+</strong>",
           "id"    => "portfolio_share_label_gplus",
           "std"   => "Share on Google+",
           "type"  => "text"),

   array("type"  => "endsub"),



   array(
       "name" => "Display Comments",
       "id" => "portfolio_comments",
       "std" => "on",
       "type" => "checkbox"
   ),

   array(
       "name" => "Display Previous Post Banner",
       "id" => "portfolio_nextprev",
       "std" => "on",
       "type" => "checkbox"
   ),
)

/* end return */);