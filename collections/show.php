<?php
    $collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
    echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show'));
?>

<div id="content" class="container">
    <h1><?php echo $collectionTitle; ?></h1>

        <?php echo metadata('collection',array('Dublin Core', 'Description')) ?>
        <h2><?php echo link_to_items_browse(__('Items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
        <div class="row" id="collection-items">
            
            <?php if (metadata('collection', 'total_items') > 0): ?>

                <?php foreach (loop('items') as $item): ?>
                <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
                <div class="item col-sm-3 col-md-3 col-lg-2">
                        <?php echo link_to_item(item_image('square_thumbnail',array('title'=>metadata('item', array('Dublin Core', 'Title'))))); ?>
                        <h4><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h4>
                        <p><?php echo metadata('item', array('Dublin Core', 'Date'))?>
                        <?php
                            $creator = metadata('item', array('Dublin Core', 'Creator'));
                            if ($creator) echo " &middot ".$creator 
                        ?></p>
                </div>
                <?php endforeach; ?>
        </div>        
        <?php else: ?>
            <p><?php echo __("There are currently no items within this collection."); ?></p>
        <?php endif; ?>
    </div><!-- end collection-items -->

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
<?php echo foot(); ?>
