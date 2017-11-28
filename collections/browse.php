<?php
    $pageTitle = __('Browse collections');
    echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<div id="content" class="container">

    <h1><?php echo 'Browse all collections'; ?></h1>

     <div class="row">
    <div class="col-md-12">

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

    <div class="browse-collections">
        <?php if ($total_results > 0): ?>
        
            <?php foreach (loop('collections') as $collection): ?>
                <div class="collection">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><?php echo metadata('collection', array('Dublin Core', 'Title')) . ' Collection'; ?></h2>
                             <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
                                <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'))); ?>
                                <?php endif; ?>
                         </div>   
                    </div>
                   <div class="row"> 
                        <div class="col-sm-12">     
                            <ul class="nav nav-pills collection-button">
                                    <li class="active">
                                       <?php echo link_to_items_browse('Browse '.metadata('collection', 'total_items').' items', $browseParams = array('collection' => metadata($collection, 'id'))); ?>
                                    </li>   
                            </ul> 
                        </div>   
                    </div>
                    <div class="row">
                        <?php $get_opt["collection_id"] = metadata($collection, 'id');
                            $params = array_merge($get_opt);
                            $items = get_records('Item', $params ,4);
                            set_loop_records('sample_items',$items);
                            foreach (loop('sample_items') as $item){
                                set_current_record('item',$item);
                                echo '<div class="item col-xs-6 col-sm-3 col-md-3 col-lg-2">';
                                echo link_to_item(item_image('square_thumbnail',array('title'=>metadata('item', array('Dublin Core', 'Title'))),'item')); 
                                echo '<h4>'. link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink'),'item'). '</h4>';
                                echo '<p>'.metadata('item', array('Dublin Core', 'Date'));
                                $creator = metadata('item', array('Dublin Core', 'Creator'));
                                 if ($creator) echo " &middot ".$creator; 
                                echo '</div>'; 
                            }
                        ?>
                    </div>    
                    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'collection' => $collection)); ?>
                    
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p><?php echo 'No collections added, yet.'; ?></p>
        <?php endif; ?>
    </div>
    <?php echo pagination_links(); ?>   
</div>     

<?php fire_plugin_hook('public_collections_browse', array('collections'=> $collections, 'view' => $this)); ?>
<?php echo foot(); ?>
