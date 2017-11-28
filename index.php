<?php echo head(array('bodyid'=>'home')); ?>

<div id="splash">
    <img src="<?php echo img('Aviation_Heritage_logo_type.svg'); ?>"/>
    <!-- image source http://www.acmssearch.sl.nsw.gov.au/search/itemDetailPaged.cgi?itemID=8451 -->
</div>
<div id="content" class="container"> 

    <div class="row">
        <div class="col-sm-8 col-md-8">
            <?php echo get_theme_option('Homepage Intro'); ?>
        </div>    
        <div class="homepage item col-md-3 col-md-offset-1 col-xs-6">
                <h2><?php echo __('Featured Item'); ?></h2>
                <?php 
                    $featured = get_random_featured_items(1,null);
                    set_current_record('item',$featured[0]);
                    echo link_to_item(item_image('square_thumbnail',array('title'=>metadata('item', array('Dublin Core', 'Title'))))); 
                ?>
                                  
                <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h4>
                <p><?php $date = metadata('item', array('Dublin Core', 'Date'));
                         $creator = metadata('item', array('Dublin Core', 'Creator'));
                         if ($date){
                            echo($date);
                            if ($creator) echo " &middot ";
                         }
                         echo $creator;
                    ?></p>

                 <p class='featured-item-collection-link'><?php $coll = get_collection_for_item($featured[0]);
                    if ($coll){
                        echo link_to_items_browse(metadata($coll, array('Dublin Core', 'Title')).' Collection' , $browseParams = array('collection' => metadata($coll, 'id'))); 
                    }?>
                </p>  
        </div>
        <div class="homepage item col-md-3 col-md-offset-1 col-xs-6">
            <h2><?php echo __('Recently Added'); ?></h2>
            <?php
                $recent = get_recent_items(1,false);
                set_current_record('item',$recent[0]);
                echo link_to_item(item_image('square_thumbnail',array('title'=>metadata('item', array('Dublin Core', 'Title'))))); 
            ?>
                                  
            <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h4>
            <p><?php $date = metadata('item', array('Dublin Core', 'Date'));
                     $creator = metadata('item', array('Dublin Core', 'Creator'));
                     if ($date){
                        echo($date);
                        if ($creator) echo " &middot ";
                     }
                     echo $creator;
                ?></p>

                <p class='featured-item-collection-link'><?php $coll = get_collection_for_item($recent[0]);
                    if ($coll){
                        echo link_to_items_browse(metadata($coll, array('Dublin Core', 'Title')).' Collection' , $browseParams = array('collection' => metadata($coll, 'id'))); 
                    }?>
                </p> 
        </div>
    </div>    
</div>

<?php echo foot(); ?>
