
let map, infoWindow;

async function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
     center: { lat: 56.1304, lng: -106.3468 },
     zoom: 9,
     streetViewControl: false,
     mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        mapTypeIds: ["roadmap", "terrain"],
      },
    });

    // loading pop-up
    const loadingText = document.createElement("text");
    loadingText.textContent = "Loading Location...";
    loadingText.classList.add("loading-text");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(loadingText);

    //array of AQHI markers
    const icons = [];
    for(let i=0; i<=11; i++){
      icons[i] = "vector/AQHI" + i.toString() + ".svg";
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
    ];

    const infoText = ["Low Risk: Ideal air quality for outdoor activities.", "Moderate Risk: No need to modify your usual outdoor activities unless you experience symptoms", "High Risk: Consider reducing or rescheduling strenuous activities outdoors if you experience symptoms", "Very High Risk: Reduce or reschedule strenuous activities outdoors"]
    const numConv = [0, 0, 0, 0, 1, 1, 1, 2, 2, 2, 2, 3];

    const x = await getAQHINum();
    console.log(x);
    const marker = [];
    const infowindow2 = [];

    for(let i=0; i<features.length; i++){
      marker[i] = new google.maps.Marker({
        position: features[i].position,
        icon: icons[x[i]],
        map,
      });
      const infowindow2 = new google.maps.InfoWindow({
        content: infoText[numConv[x[i]]],
      });
      marker[i].addListener("mouseover", () => {
        infowindow2.open({
          anchor: marker[i],
          map,
        });
      });
      marker[i].addListener("mouseout", () => {
        infowindow2.close();
      })
    }
    
    //getting the user's current location
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

async function getAQHINum(){
  const response= await fetch("getAQHI.php", {
    method: "GET",
    headers: { "Content-Type": "application/json" },
  });
  console.log(response);
  const data= await response.json();
  console.log(data);
  const AQHI = [];
  for(let i=0;i<10;i++){
    if(data[i][1]!=0)AQHI[i]=Math.round(data[i][0]/data[i][1]); //round
    else AQHI[i]=0;
  }
  return AQHI;
}


window.initMap = initMap;