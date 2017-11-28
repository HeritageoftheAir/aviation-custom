<?php 

	echo head(array(
    'title' => metadata('simple_pages_page', 'title'),
    'bodyclass' => 'page simple-page',
    'bodyid' => metadata('simple_pages_page', 'slug')
)); 


?>


<div id="content" class="container simple-page">
	<?php $nav = public_nav_main(); echo $nav->setOnlyActiveBranch(true)->setRenderParents(false)->setUlClass('page-nav'); ?>
	<div class="row">
		<div class="col-sm-12 col-md-8">
	    <p id="simple-pages-breadcrumbs"><?php echo simple_pages_display_breadcrumbs(); ?></p>
	    <h1><?php echo metadata('simple_pages_page', 'title'); ?></h1>
	    <?php
	    $text = metadata('simple_pages_page', 'text', array('no_escape' => true));
	    echo $this->shortcodes($text);
	    ?>
	</div>
	</div>
</div>

<?php echo foot(); ?>
