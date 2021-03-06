var app = angular.module('oumbox', ['oumboxModule']);
var oumboxModule = angular.module('oumboxModule',[]);
oumboxModule.controller('oumboxController',function($scope,dataService) {   
    $scope.aa='khalid';
    $scope.partenaires = null;
    dataService.getData(function(dataResponse) {
        $scope.partenaires = dataResponse['result'];
    });
});
oumboxModule.controller('oumboxControllerMaBox',function($scope,SBListeVilleService) {


    $scope.villes=null;
     SBListeVilleService.getData(function(dataResponse) {
         $scope.villes=dataResponse;
          
       /*  for (var i = 0; i < dataResponse.length; i++) {
         $("#ville ul ").append('<li class=""><span>'+dataResponse[i]+'</span></li>');
         };*/

         /*$("#ville ul ").append('<li class=""><span>'+dataResponse[1]+'</span></li>');
         $("#ville ul ").append('<li class=""><span>'+dataResponse[1]+'</span></li>');*/
    });

   
});
oumboxModule.service('dataService', function($http) {
    delete $http.defaults.headers.common['X-Requested-With'];
    this.getData = function(callbackFunc) {
        $http({
            method: 'POST',
            
            params:{
                methode:'getAllShop'
            },
            url: 'gestion/lib/util.php'
           /* headers: {'Authorization': 'Token token=xxxxYYYYZzzz'}*/
        }).success(function(data){
            // With the data succesfully returned, call our callback
            for (var i = 0; i < data['result'].length; i++) {
              data['result'][i]['showName']='';
              data['result'][i]['showAdresse']='';
            }; 
            callbackFunc(data);
            initMap(data['result']);
        }).error(function(){
            alert("error");
        });
     }

});
oumboxModule.service('SBListeVilleService', function($http) {
    
    this.getData = function(callbackFunc) {
        $http({
            method: 'GET',
            url: 'https://api.speedbox.ma/api/listevilles/'
        }).success(function(data){
            /*$('#ville select option').remove();
            $('#ville select').append('<option value="0" disabled="" selected="">Ville</option>');
            for (var i=1; i<=data.length; i++) {
               $('#ville select').append('<option value="'+i+'">'+data[i]+'</option>');
            }*/
            callbackFunc(data);

        }).error(function(){
            alert("error");
        });
     }

});


// scroll to map
oumboxModule.directive('scrollOnClick', function() {
 
  var scrollOnClick = {
    restrict: 'A',
    link: function(scope, $elm,attrs) {
        $elm.on('click', function() {
        $("body").animate({scrollTop: $("#map").offset().top}, "slow");
        //console.log(attrs.scrollOnClick);
        var lat =scope.partenaires[attrs.scrollOnClick].lat;
        var lng =scope.partenaires[attrs.scrollOnClick].lng; 
        var Name =scope.partenaires[attrs.scrollOnClick].Name; 
        var adresse =scope.partenaires[attrs.scrollOnClick].adresse; 
        var adresse =scope.partenaires[attrs.scrollOnClick].gsm; 
        $(".Nom").text(Name);
        $(".adresse").text(adresse);
        //$(".gsm").text(gsm);
        locatePartner(lat,lng,Name);
      });
    }
  }
  return scrollOnClick;
});


// localiser un seul partenaire
function locatePartner(lat,lng,Name){
       
        
        var flag= {lat: parseFloat(lat), lng:parseFloat(lng)};


        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: flag
        });

        var markerF = new google.maps.Marker({
          icon:'http://maps.google.com/mapfiles/ms/icons/purple-dot.png',
          position: flag,
          map: map,
          title: Name
        });
}



 // add Marker to map
 function initMap($data) {

       var map,myLatLng,marker,myIcon;   
       oumboxFlag = {lat: parseFloat($data[0].lat),lng: parseFloat($data[0].lng)};
       map = new google.maps.Map(document.getElementById('map'), {
                 zoom: 13,
                 center: oumboxFlag
        });    
       for (var i = 0; i < $data.length; i++) {
           
            myLatLng = {lat: parseFloat($data[i].lat),lng: parseFloat($data[i].lng)};
            if($data[i].type=="Points de retrait")
                 myIcon='http://maps.google.com/mapfiles/ms/icons/green-dot.png';
            else if($data[i].type=="Cliniques")
                 myIcon='http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
            else
                 myIcon='http://maps.google.com/mapfiles/ms/icons/red-dot.png';
            marker = new google.maps.Marker({
             icon:myIcon,
             position: myLatLng,
             map: map,
             title: $data[i].Name
           });
       }

 }









// get lng and lat from adresse ! à utiliser pour plutard
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = "47 bd Sidi Mohamed Ben Abdellah casablanca";
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

      lat=results[0].geometry.location.lat();
      lng=results[0].geometry.location.lng();
      } 

      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }  