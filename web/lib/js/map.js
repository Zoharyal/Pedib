var map;
var schoolMarker;

    function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
          center: 
          {lat:45.5885098 , lng:2.74221179999995},
          zoom:17
    });
    schoolMarker = new google.maps.Marker({
        position: new google.maps.LatLng(45.5883080, 2.7417770),
        map: map,
        title: "Ecole primaire de La Bourboule"
    });
    $.ajax({
        url: "http://pedi/app_dev.php/geometry",
        dataType: "text",
        method: "get",
        success: function(data){
            console.log(data[0]);
            }
        });
        
    }