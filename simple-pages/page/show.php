<?php 

    $bodyclass = 'page simple-page';
    //$top = simple_pages_earliest_ancestor_page(null);

    $title = metadata('simple_pages_page', 'title');
    
    // Build appropriate page titles
    /*
    if (!$top) {
        $top = get_current_record('simple_pages_page');
        $topSlug = metadata($top, 'slug');
        $title = metadata('simple_pages_page', 'title');
    } else {
    	$title = metadata('simple_pages_page', 'title');
    	$subtitle = metadata('simple_pages_page', 'title');
    }
    */
    echo head(array( 'title' => $title, 
    	'bodyclass' => $bodyclass, 
    	'bodyid' => metadata('simple_pages_page', 'slug'),
    	// 'subtitle' => $subtitle,
    	//'currentUriOverride' => url($topSlug)
    ));
    
    // If there is a file that matches the slug of this page, display that as the template
    // Otherwise, use the template below on show.php
    $fname = dirname(__FILE__) . '/' . metadata('simple_pages_page', 'slug') . '.php';
    if (is_file( $fname )):
        include( $fname );
    else :
    	?>

        <div id="content" class="container simple-page">
			<!-- <?php $nav = public_nav_main(); echo $nav->setOnlyActiveBranch(true)->setRenderParents(false)->setUlClass('page-nav'); ?> -->
				<div class="row">
					<div class="col-sm-12 col-md-10 col-lg-9">
				   		<p id="simple-pages-breadcrumbs"><?php echo simple_pages_display_breadcrumbs(); ?></p>
				    	<h1><?php echo metadata('simple_pages_page', 'title'); ?></h1>
				    	<?php 
				    		$text = metadata('simple_pages_page', 'text', array('no_escape' => true));
				    		echo $this->shortcodes($text);
				    	?>
				</div>
			</div>
		</div>

<?php

    endif;
    echo foot();


?>

