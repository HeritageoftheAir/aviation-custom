<?php
    $pageTitle = __('Browse Items');
    echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>
<div id="content" class="container">

		    <h1><?php echo $pageTitle; ?></h1>
		    <div class="row">
				<div class="col-sm-12 col-md-12 col-lg-10">
			      <?php $subnav = public_nav_items(array (
	                    array (
	                        'label' => __('Browse All'),
	                        'uri' => url('items/browse')
	                        ),
	                     array (
	                         'label' => __('Browse By Tag'),
	                         'uri' => 'http://connectingthenation.net.au/items/tags'
	                         ),
	                    array (
	                        'label' => __('Browse By Collection'),
	                        'uri' => url('collections')
	                        ),
	                    array (
	                        'label' => __('Search'),
	                        'uri' => url('items/search')
	                        )
	                ));

	            echo $subnav->setUlClass('nav nav-pills navbar-left'); ?>
		        </div>
		    </div>
		    <hr>

		    <p>This page shows all the tags used across the Connecting the Nation collections. Items are tagged using aircraft registration codes and aircraft models, as well as places, companies and people. The  size of the tag indicates the number of related records. More tags will appear here over time as our collection data improves.</p>


		   <div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
				    <div class="hTagcloud">
					    <ul>
					    <?php 
							    $tags = get_records('Tag',array(
								     'sort_field'=>'name',
								     'sort_dir'=>'a'),500); 
				    		?>
						    <?php foreach ($tags as $tag): ?>
						    <li class="tag" style="font-size:<?php echo ((12 + $tag["tagCount"]).'px'); ?>">
						    	<a href="<?php echo('/items/browse/?tag=' . urlencode($tag["name"])); ?>" title="<?php echo($tag['tagCount']. ' items')?>">
						    		<?php echo($tag["name"]); ?>
		<!-- 					    	<span class="count">
							    		<?php echo($tag["tagCount"]);?>
							    	</span> -->
						    	</a>
						    </li>

						    <?php endforeach; ?>


						</ul>
					</div>
				</div>	
		</div>

	</div>
</div>

<?php echo foot(); ?>
