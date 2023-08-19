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

    //array of AQHI markers
    const markerBase = "vector/AQHI";
    const markers = [];
    for(let i=0; i<=11; i++){
      markers[0] = markerBase + i + ".svg";
    }

    //array of places
    const features = [
      {name:"Toronto",
      position: new google.maps.LatLng(43.653225, -79.383186),
      },
      {name:"Brampton",
      position: new google.maps.LatLng(43.731548, -79.762421),
      },
      {name:"Hamilton",
      position: new google.maps.LatLng(43.255722, -79.871101),
      },
      {name:"Markham",
      position: new google.maps.LatLng(43.8563707,-79.3376825),
      },
      {name:"Vaughan",
      position: new google.maps.LatLng(43.7941544,-79.5268023),
      },
      {name:"Oakville",
      position: new google.maps.LatLng(43.447436,-79.666672),
      },
      {name:"Richmond Hill",
      position: new google.maps.LatLng(43.8801166,-79.4392925),
      },
      {name:"Burlington",
      position: new google.maps.LatLng(43.3248924,-79.7966835),
      },
      {name:"Oshawa",
      position: new google.maps.LatLng(43.3248924,-79.7966835),
      },
      {name:"Mississauga",
      position: new google.maps.LatLng(43.5896231,-79.6443879),
      },
    ]

  
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