<?php
    $pageTitle = __('Search Results ') . __('(%s total)', $total_results);
    echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
    $searchRecordTypes = get_search_record_types();
?>

<div id="content" class="container">
    <?php $params = Zend_Controller_Front::getInstance()->getRequest()->getParams();
     $r = 'results';
     if ($total_results == 1) $r = 'result';
    ?>
    <h1><?php echo $total_results . ' search ' . $r . ' for "' . $params["query"] .'"' ?></h1>

        

    <?php if ($total_results): ?>

         <div class="row">
            <?php $filter = new Zend_Filter_Word_CamelCaseToDash; ?>
            <?php foreach (loop('search_texts') as $searchText): ?>
            <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
            <?php $recordType = $searchText['record_type']; ?>
            <?php set_current_record($recordType, $record); ?>
            <div class="item col-sm-3 col-md-3 col-lg-2">

                        <?php if ($recordImage = record_image($recordType, 'square_thumbnail')): ?>
                            <?php echo link_to($record, 'show', $recordImage, array('class' => 'image')); ?>
                        <?php endif; ?>

                        <?php if ($recordType == "SimplePagesPage"): ?>
                            <img src="<?php echo img('page-icon.png')?>">
                        <?php endif;?>
                        <h4><a href="<?php echo record_url($record, 'show'); ?>"><?php echo $searchText['title'] ? $searchText['title'] : '[Unknown]'; ?></a></h4>
                        <?php if ($recordType == 'Item'): ?>
                            <p><?php echo metadata($record, array('Dublin Core', 'Date'))?>
                            <?php
                                $creator = metadata($record, array('Dublin Core', 'Creator'));
                                if ($creator) echo " &middot ".$creator ;
                            ?></p>
                        <?php endif;?>
                        
            </div>
            <?php endforeach; ?>
         </div>
    <?php else: ?>
        <p><?php echo __('Your query returned no results.');?></p>
    <?php endif; ?>
</div>
<?php echo foot(); ?>