var myMap = {
  map:null,
  userInfo: null,
  advertInfo: null,
  schoolMarker: null,
  advertMarker:null,
  userMarker:null,
  flightPlan: null,
  flightPath: null,

  init: function() {
    this.map = new google.maps.Map(document.getElementById('map'), {
      center: {
          lat: 45.5885098,
          lng: 2.74221179999995
      },
      zoom: 17
    });
    this.userMarker = [];
    this.advertMarker = [];

    myMap.getInfoMap();
    myMap.createSchoolMarker();

  },
  getInfoMap: function() {
    $.ajax({
      url: "http://pedibus/app_dev.php/map/mapservice",
      method: "GET",
      success: function (data) {

        myMap.createAdvertMarker(data.AdvertInfo);
        myMap.createUserMarker(data.UserInfo);
      }
    });
  },
  createSchoolMarker: function() {
    myMap.schoolMarker = new google.maps.Marker({
      position: new google.maps.LatLng(45.5883080, 2.7417770),
      map: myMap.map,
      title: "Ecole primaire de La Bourboule"
    });
  },
  createAdvertMarker: function(data) {
      var advert = data;

      for(i=0; i < advert.length; i++) {
        myMap.advertMarker = new google.maps.Marker({
          position: new google.maps.LatLng(advert[i][0], advert[i][1]),
          map: myMap.map,
          //Ajout image
        });
        myMap.flightPlan = [
          {lat:45.5883081, lng:2.741777 },
          {lat: advert[i][0], lng: advert[i][1]}
      ];
        myMap.flightPath = new google.maps.Polyline({
        path: myMap.flightPlan,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
      });
        myMap.flightPath.setMap(myMap.map);
      }

  },
  createUserMarker: function(data) {
    var user = data;
    console.log(user);
    console.log('user data', user[0][1]);
    for(i=0; i < user.length; i++) {
      myMap.userMarker = new google.maps.Marker({
        position: new google.maps.LatLng(user[i][1],user[i][2]),
        map: myMap.map,
      })
    }
  }

}

$(function() {
   myMap.init();
})
