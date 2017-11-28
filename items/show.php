<?php 
    
    // queue_js_file('audiotranscript');
    echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show'));
?>
<div id="content" class="container">
    <h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

    <div class="row">
        <div class="col-sm-12 col-md-12">
                    <?php if (metadata('item', 'has files')): ?>
                <div id="itemfiles" class="element">
                    <!-- <h3><?php echo __('Files'); ?></h3> -->
                    <div class="element-text"><?php echo files_for_item(array('imageSize' => 'fullsize','imageAttributes'=>array('class','item-image'))); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">
             <!-- this grabs related item (creator for oral histories) and displays portrait and biog -->

            

            <!-- show only dublin core metadata -->
            <!-- <p> Item Type Name: <?php echo metadata('item','item_type_name')?></p> -->
            <?php echo all_element_texts('item',array('show_element_sets' => 'Dublin Core','partial'=>'common/record-metadata-nocontainer.php')); ?> 

            
            <!-- If the item belongs to a collection, the following creates a link to that collection. -->
            <?php if (metadata('item', 'Collection Name')): ?>
                <div id="collection" class="element">
                    <h3><?php echo __('Collection'); ?></h3>
                    <?php 
                        $collection = get_collection_for_item();
                    ?>
                    <div class="element-text"><p><?php echo link_to_items_browse(metadata($collection, array('Dublin Core', 'Title')), $browseParams = array('collection' => metadata($collection, 'id'))); 
 ?></p></div>
                </div>
            <?php endif; ?>
            
            <!-- The following prints a list of all tags associated with the item -->
            <?php if (metadata('item', 'has tags')): ?>
                <div id="item-tags" class="element">
                    <h3><?php echo __('Tags'); ?></h3>
                    <div class="element-text"><?php echo tag_string('item','items/browse',' '); ?></div>
                </div>
            <?php endif;?>
            <?php if (current_user() != null): ?>
                
                <p>
                   <!-- show link to download mp3s for logged in users only -->
                     <?php 
                     $files = $item->Files;
                     if (isset($files[0])){
                        if ($files[0]->mime_type == "audio/mpeg"){
                            $filestring = str_replace(".jpg",".mp3",file_display_url($files[0]));
                            $filestring = str_replace("fullsize","original",$filestring);
                            echo "<a download href='" . $filestring ."'>download mp3 file</a>"; 
                        }
                    }

                     ?> 
                </p>

             <?php endif;?>

            <?php
                // find a related person record and grab the biography details
                $relations_json =  get_specific_plugin_hook_output('ItemRelations', 'public_items_show', array('view' => $this,'item' => $item));
                $relations = json_decode($relations_json,'array');
                if (isset($relations["objectRelations"][0]["subject_item_id"])){
                    $related = get_record_by_id('Item',$relations["objectRelations"][0]["subject_item_id"]);
                    $bdate = metadata($related, array('Item Type Metadata','Birth Date'));
                    $ddate = metadata($related, array('Item Type Metadata','Death Date'));
                    $datestr = ($bdate || $ddate) ? "(".$bdate." - ".$ddate.")" : "";
                    echo "<div id='biog' class='element'>";
                        echo "<h3>Biography</h3>";
                        echo "<div class='element-text'>";
                            echo files_for_item(array('linkToFile'=>false,'imageSize'=>'thumbnail','imgAttributes'=>array('class'=>'biog-portrait')),null,$related);
                            echo "<h4>" . metadata($related, array('Dublin Core','Title')) . " " .$datestr."</h4>";
                            echo "<p>" . metadata($related, array('Item Type Metadata','Biographical Text')) ."</p>";
                        echo "</div>";    
                    echo "</div>";
                }
            ?>

<!--             <div id="item-citation" class="element">
                <h3><?php echo __('Citation'); ?></h3>
                <div class="element-text"><p><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></p></div>
            </div> -->
        </div>

        <div class="col-md-8" id="trove-related">
                <?php if (metadata('item','item_type_name') == "Still Image"){

                    $baseurl = "http://api.trove.nla.gov.au/result?encoding=json&l-australian=y&l-availability=y/f&zone=picture&n=5";
                    $query = tag_string('item',$link=null, $delimiter=" OR ");

                    if ($query){
                        $apikey ='vl6ahuf5l47j4vaq';
                        $uri = $baseurl .'&q='. urlencode($query) . '&key=' . $apikey;  
                        // echo ($uri); 
                        $data = file_get_contents($uri);
                        $results = json_decode($data,true);
                        if ($results["response"]["zone"][0]["records"]["total"] > 0){
                            $works = array_filter($results["response"]["zone"][0]["records"]["work"], function($w){ return $w["relevance"]["score"] > 0.2 && isset($w["identifier"][1]);});
                            if (count($works) > 0){
                                echo "<h3>Possibly Related</h3><ul>";
                               foreach ($works as $w){

                                    echo "<li>";
                                    echo "<a target='_blank' href='".$w["identifier"][0]["value"]."'><img class='trovethumb' src='".$w["identifier"][1]["value"]."'></a>";
                                    echo "<p class='title'>" . $w["title"] . "</p>";
                                    echo "</li>";
                                }
                                echo "<li><a href='http://trove.nla.gov.au'><img id='trovelogo' alt='Trove logo' src='". img('Trove_logo_colour-180.png')."'></a></li>";
                                echo "</ul>";
                            }
                        }
                    }    
                } ?>
            </div>



         <div class="col-md-6">
            <?php if (metadata('item',array('Item Type Metadata','Transcription'))){
                $transcript_json = metadata('item',array('Item Type Metadata','Transcription'),array('no_escape' => true));
                $transcript = json_decode($transcript_json);
                $summary = $transcript->summary;
                echo ("<div id='audio-transcript'>");
                    echo("<h3>Timed Summary</h3>");
                    foreach($summary as $s){
                        echo ("<div class='transcript-segment'>");
                            $keywdstr = "";
                            $summarystr = "";
                            if (isset($s->summary)) $summarystr = $s->summary;
                            if (isset($s->keywords)) $keywdstr = "<p class='keywords'>keywords: <span class='keyword'>" . join($s->keywords,"</span> <span class='keyword'>") . "</span></p>" ;
                            echo("<p><span class='starttime'>" . $s->start . "</span> - " . $summarystr . "</p>" . $keywdstr );
                        echo ("</div>");
                    }
                echo ("</div>");
            }
            ?>
        </div> 
    </div>
    
   
    <ul class="pager">
        <li class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>
</div>

<?php echo foot(); ?>
