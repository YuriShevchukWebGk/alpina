$(document).ready(function(){
   function addMarker(location, map, i) {

        var marker = new google.maps.Marker({
            position: location,
            icon: "/img/contactMark.png",
            map: map,
            label: ""
        });
        marker.ind = i;
        marker.window_id = location.window_id;

}

    function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: new google.maps.LatLng(55.774820, 37.520774),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.TERRAIN
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        addMarker({lat: 55.774820, lng: 37.520774}, map, 0);
      }
      google.maps.event.addDomListener(window, 'load', initialize);


      
})

   