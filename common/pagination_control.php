<?php if ($this->pageCount > 1): $getParams = $_GET; ?>

<div id="pagination">
    <div class="row">
    <?php if (isset($this->previous)): ?>
        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-1 pagebutton">
            <?php $getParams['page'] = $previous; ?>
            <a rel="prev" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">&larr; prev</a>
        </div>
        <div class="col-xs-4 col-sm-8 col-md-8 col-lg-10" id="pagecount"> <?php echo "page " . $this->current . " of " . $this->last ?> </div>
    <?php else: ?>
         <div class="col-xs-8 col-sm-10 col-md-10 col-lg-11" id="pagecount"> <?php echo "page ". $this->current. " of " . $this->last ?> </div>
    <?php endif; ?>

    

    <!-- <li class="page-input">
        <form action="<?php echo html_escape($this->url()); ?>" method="get" accept-charset="utf-8">
        <?php
            $hiddenParams = array();
            $entries = explode('&', http_build_query($getParams));
            foreach ($entries as $entry) {
                if(!$entry) {
                    continue;
                }
                list($key, $value) = explode('=', $entry);
                $hiddenParams[urldecode($key)] = urldecode($value);
            }
        
            foreach($hiddenParams as $key => $value) {
                if($key != 'page') {
                    echo $this->formHidden($key,$value);
                }
            }
        
            // Manually create this input to allow an omitted ID
            // $pageInput = '<input type="text" name="page" title="'
            //             . html_escape(__('Current Page'))
            //             . '" value="'
            //             . html_escape($this->current) . '">';
            // echo __('%s of %s', $pageInput, $this->last);
        ?>
        </form>
    </li> -->

    <?php if (isset($this->next)): ?>
        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-1 pagebutton">
            <?php $getParams['page'] = $next; ?>
            <a rel="next" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>">next &rarr;</a>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php endif; ?>
