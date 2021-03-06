var map;
var schoolMarker;
var userMarker;
var advertMarker;
var userLocation = JSON.parse('{{Ulocation|raw}}');
var advertLocation = JSON.parse('{{Alocation|raw}}');
function initMap() {
map = new google.maps.Map(document.getElementById('map'), {
      center:
      {lat:45.5885098 , lng:2.74221179999995},
      zoom:17
});
schoolMarker = new google.maps.Marker({
    position: new google.maps.LatLng(45.5883080, 2.7417770),
    map: map,
    title: "Ecole primaire de La Bourboule",
    icon: "{{asset('lib/img/iconschool1.png')}}"
});
for(i=0; i< userLocation.length; i++) {
    if (userLocation[i][3] !== null) {

    } else {
    userMarker = new google.maps.Marker({
        position: new google.maps.LatLng(userLocation[i][1], userLocation[i][2]),
        map:map,
        icon: "{{asset('/lib/img/marker-48-bleu.png')}}"
    });
    }
}
var infowindow = new google.maps.InfoWindow();
for(i=0; i < advertLocation.length; i++) {
    advertMarker = new google.maps.Marker({
        position: new google.maps.LatLng(advertLocation[i][0], advertLocation[i][1]),
        map:map,
        icon: "{{asset('/lib/img/marker-48-vert.png')}}"
    });
    var idloc = advertLocation[i][2];
    var contentString = Routing.generate('view', {id: idloc});
    var url = '<a href="'+contentString+'">' + "Voir l'annonce" + '</a>';
    google.maps.event.addListener(advertMarker, 'click', (function(advertMarker, i, url) {
        return function() {
            infowindow.setContent(url);
            infowindow.open(map, advertMarker);
        }
    })(advertMarker, i, url));
    var flightPlan = [
        {lat:45.5883081, lng:2.741777 },
        {lat: advertLocation[i][0], lng: advertLocation[i][1]}
    ];
    var flightPath = new google.maps.Polyline({
        path: flightPlan,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    flightPath.setMap(map);

}
}
