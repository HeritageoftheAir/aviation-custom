<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <!-- Will build the page <title> -->
    <?php
        if (isset($title)) { $titleParts[] = strip_formatting($title); }
        $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>
    <?php echo auto_discovery_link_tags(); ?>

    <!-- Will fire plugins that need to include their own files in <head> -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <!-- Need to add custom and third-party CSS files? Include them here -->
    <?php 
        queue_css_file('lib/bootstrap.min');
        queue_css_file('style');
        // queue_css_file('http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700');
        echo head_css();
    ?>

    <!-- Need more JavaScript files? Include them here -->
    <?php 
        queue_js_file('lib/bootstrap.min');
        queue_js_file('globals');

       // here we check the URL and conditionally inject javascript where required
        $url = current_url();
        if (strpos($url,"items/show") == 1){
            if (metadata('item','item_type_name') == "Oral History") queue_js_file('audiotranscript');
            // if (metadata('item','item_type_name') == "Still Image") queue_js_file('trove-related');
        }

        echo head_js(); 
    ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700"> 

</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-4302320-7', 'auto');
      ga('send', 'pageview');

    </script>
    <header>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">

                <?php 
                    // logo
                    $img = "<img id='nav-logo' src='" . img('nav-logo-sm2.png') . "'>"; 
                    echo link_to_home_page($img);
                ?>

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navigation">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="primary-navigation">
                      <?php $nav = public_nav_main(); echo $nav->setUlClass('nav navbar-nav'); ?>
                    <form class="navbar-form navbar-right" role="search" action="<?php echo public_url(''); ?>search">
                        <?php echo search_form(array('show_advanced' => false)); ?>
                    </form>
                </div>
            </div>
        </nav>
    </header>        
     <!-- <div id="content" class="container"> -->
        <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
