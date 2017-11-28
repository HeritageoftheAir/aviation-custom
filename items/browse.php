<?php
    $pageTitle = __('Browse Items');
    echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<div id="content" class="container">
    <?php $params = Zend_Controller_Front::getInstance()->getRequest()->getParams(); 

    ?>

    <h1><?php if (isset($params['tag'])) echo 'Browse items tagged "' . $params['tag'] . '"';
              else if (isset($params['collection'])){ 
                    $coll = get_record_by_id('Collection', $params['collection']);
                    $colltitle = metadata($coll,array('Dublin Core','Title'));
                    echo 'Browse items from the ' . $colltitle . ' Collection';
                }
             else echo 'Browse all items'; ?>
    </h1>

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

    <div class="browse-items">
        <?php if ($total_results > 0): ?>
        <?php
            $sortLinks[__('Title')] = 'Dublin Core,Title';
            $sortLinks[__('Creator')] = 'Dublin Core,Creator';
            ?>

            
            <div class="row">
                <?php foreach (loop('items') as $item): ?>
                <?php if (metadata('item', 'item_type_name') != 'Person'):?>
                <div class="item col-xs-6 col-sm-3 col-md-3 col-lg-2">

                        <?php echo link_to_item(item_image('square_thumbnail',array('title'=>metadata('item', array('Dublin Core', 'Title'))))); ?>
                                  
                        <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h4>
                        <p><?php $date = metadata('item', array('Dublin Core', 'Date'));
                                 $creator = metadata('item', array('Dublin Core', 'Creator'));
                                 if ($date){
                                    echo($date);
                                    if ($creator) echo " &middot ";
                                 }
                                 echo $creator;
                            ?></p>
               

                
                    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                </div>
                <?php endif?>
                <?php endforeach; ?>
            </div>

    </div>

    <?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>
            <hr>
            <div id="outputs">
                <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
                <?php echo output_format_list(false); ?>
            </div>
        <?php else : ?>
            <p><?php echo 'No items added, yet.'; ?></p>
        <?php endif; ?>

</div>
<?php echo foot(); ?>
