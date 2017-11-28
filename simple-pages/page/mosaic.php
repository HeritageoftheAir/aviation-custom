
<?php echo js_tag("lib/angular.min")?>
<?php echo js_tag("lib/angular-animate.min")?>
<?php echo js_tag("mosaic-controller")?>
<?php echo js_tag("data/aviation-harvest")?>

<!-- <script src="lib/angular.min.js"></script>
<script type="text/javascript" src="mosaic-controller.js"></script> -->
<div id="content" class="container simple-page" ng-App="aviationMosaic" >
	<div class="row mosaic-intro">
		<div class="col-sm-6">
			<p>This mosaic compiles thousands of aviation images from the collection of the National Library of Australia. It provides a continually shifting impression of how aviation in Australia has changed in its first hundred years, and how it has changed and connected the nation.</p> 
		</div>
		<div class="col-sm-6">
			<p>Click on the image caption to see the full record in a new window; click a mosaic tile to see the next image from that decade; or just sit back and watch the images change.</p>
		</div>
	</div>
	<div class="row" ng-controller="mosaicControl">
		<div class="col-sm-12 col-md-12">
	   		<ul id ="mosaic-ul">
		      <li ng-repeat="d in decades" class="mosaic-tile" ng-style="{'width': (170 + d.items.length*0.65)+'px'}" ng-click="nextImg(d)">
		        <div ng-repeat="i in d.slideitems" class="mosaic-slideimg" style="background-image: url('{{i.links[0].value}}-v')">
		        <div class="decadelabel">{{d.decade}} - {{d.items.length}} items</div>  
		    	 <a target="new" href="{{d.items[d.idx].links[0].value}}" > <div class="title">{{d.items[d.idx].title}} ({{d.items[d.idx].date}})</div></a>
		        <!-- {{d.decade}} - {{d.items.length}} -->
		      </li>
		    </ul>
		</div>
	</div>
</div>