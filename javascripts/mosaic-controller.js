var mosaicApp = angular.module('aviationMosaic', ['ngAnimate']);

mosaicApp.controller('mosaicControl', ['$scope','$http','$interval', function($scope,$http,$interval){

	$scope.works = harvest;

	$scope.decades = [];

	for (var d=1900; d < 1980; d+=10){

		$scope.decades.push({ decade:d, slideitems:[], items:[], idx:0 });
	}


	// $http.get('data/aviation-harvest.json')
	// .success(function(data){

	// 	$scope.works = data;

		//$scope.works.forEach(function(w){ console.log(w.date)}); 

		$scope.decades.forEach(function(d){
			d.items = $scope.works.filter(function(w){ 
					if (!w.date) return false;
					return w.date.toString().substr(0,3)*10 == d.decade
				});

			var randomidx = Math.floor(Math.random()*d.items.length);
			d.idx = randomidx;
			d.slideitems = [d.items[randomidx]];
		});

		$interval(function(){
			var randomdecade = Math.floor(Math.random()*8);
			$scope.decades[randomdecade].idx ++;

			if ($scope.decades[randomdecade].idx > $scope.decades[randomdecade].items.length){
				$scope.decades[randomdecade].idx = 0;
			}

			$scope.decades[randomdecade].slideitems = [ $scope.decades[randomdecade].items[$scope.decades[randomdecade].idx] ];

		},5000);



	//});

	$scope.nextImg = function(decade){
		decade.idx++;
		if (decade.idx >= decade.items.length) decade.idx = 0;
		decade.slideitems = [decade.items[decade.idx]];
	}

	// 	$scope.nextSlide = function(y){
	// 	y.slide++;
	// 	if (y.slide >= y.items.length ) y.slide = 0;
	// 	y.slideitems = [y.items[y.slide]];
	// }
	
	// $scope.prevSlide = function(y){
	// 	y.slide--;
	// 	if (y.slide < 0) y.slide = y.items.length-1;
	// 	y.slideitems = [y.items[y.slide]];
	// }


		

}]);




	
