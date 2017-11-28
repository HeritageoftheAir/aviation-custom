<?php
    $pageTitle = __('Search Items');
    echo head(array('title' => $pageTitle, 'bodyclass' => 'items advanced-search'));
?>

<div id="content" class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-8">

		    <h1><?php echo $pageTitle; ?></h1>
		    <?php $subnav = public_nav_items(); echo $subnav->setUlClass('nav nav-pills'); ?>
		    <hr>

		    <?php echo $this->partial('items/search-form.php', array('formAttributes' => array('id'=>'advanced-search-form'))); ?>

		</div>
	</div>
</div>	

<?php echo foot(); ?>
