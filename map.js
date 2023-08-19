// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
let map, infoWindow;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
     center: { lat: 56.1304, lng: -106.3468 },
     zoom: 9,
     streetViewControl: false,
     mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        mapTypeIds: ["roadmap", "terrain"],
      },
    });

    const loadingText = document.createElement("text");
    loadingText.textContent = "Loading Location...";
    loadingText.classList.add("loading-text");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(loadingText);
    
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
    (position) => {
        const pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
        };

        loadingText.classList.add("hide");
        new google.maps.Marker({
            position: pos,
            map: map,
          });
        map.setCenter(pos);
    },
    () => {
        handleLocationError(true, infoWindow, map.getCenter());
    },
    );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
  
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation.",
  );
  infoWindow.open(map);
}


window.initMap = initMap;