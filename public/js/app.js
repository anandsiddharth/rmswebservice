var app = angular.module('SimpleMarker', ['ngMap']);

app.controller("DefaultController", function($scope, NgMap, $window){
    var map = null;
    var self = this;
    angular.element($window).bind('resize', function(){
        
        $scope.locationChange();
    });
    $scope.hiddenForm = {
        lat : 0,
        lng : 0,
        comment : ''
    };


    $scope.init = function(){
        NgMap.getMap().then(function(m){
            map = m;
            map.setZoom(17);
            map.addListener('dragend',$scope.locationChange);
            map.addListener('zoom_changed', $scope.locationChange);
            $scope.getMyLocation();
        });
    };

    $scope.locationChange = function(){
        center = map.getCenter();
        
        $scope.hiddenForm.lat = center.lat();
        $scope.hiddenForm.lng = center.lng();
        $scope.$apply();
    };

    $scope.getMyLocation = function(){
        if(typeof navigator.geolocation == "undefined"){
            console.error("Your browser doesnot support geolocation");
            return false;
        }
        navigator.geolocation.getCurrentPosition(function(location){
            $scope.setLocation({
                lat : location.coords.latitude,
                lng : location.coords.longitude
            });
        });
    };

    $scope.setLocation = function(location){
        $scope.hiddenForm.lat = location.lat;
        $scope.hiddenForm.lng = location.lng;
        $scope.$apply();
        if (location){
            
            map.setCenter(location);
        }
    };
});