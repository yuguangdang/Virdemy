
var latLng = document.getElementById('latLng');
var location = document.getElementById('location');
var show_location = document.getElementById("show_location");
var load = document.getElementById("load");
location.style.display = "none";

function success(pos) {
    var crd = pos.coords;

    console.log('Your current position is:');
    console.log(`Latitude : ${crd.latitude}`);
    console.log(`Longitude: ${crd.longitude}`);
    console.log(`More or less ${crd.accuracy} meters.`);

    latLng.innerHTML = "Latitude: " + crd.latitude + 
            "<br>Longitude: " + crd.longitude;

    initMap(crd.latitude, crd.longitude);
    load.style.display = "none";
}

function error(err) {
        latLng.innerHTML = "Geolocation is not supported by this browser.";
}

let map;

function initMap(lat, lng) {
    const myLatLng = { lat: lat, lng: lng }; 
    map = new google.maps.Map(document.getElementById("map"), {
    center: myLatLng,
    zoom: 8,
  });
  new google.maps.Marker({
    position: myLatLng,
    map,
    title: "I am here!",
  });
}

show_location.addEventListener("click", function() {
    console.log("click");
    if (location.style.display == "none") {
        location.style.display = "block";
        show_location.innerHTML = "Hide my location";
        load.style.display = "block";
        navigator.geolocation.getCurrentPosition(success, error);
        
    } else {
        location.style.display = "none";
        show_location.innerHTML = "Show my location";
    }
});

var user = document.getElementById("user");
var user_section = document.getElementById("user_section");
var manage_course = document.getElementById("manage_course");
var dashboard = document.getElementById("dashboard");
var course_section = document.getElementById("manage_course_section");
course_section.style.display = 'none';


user.addEventListener("click", function() {
  console.log("click");
  
});

user.addEventListener("click", function() {
  dashboard.classList.remove('active');
  manage_course.classList.remove('active');
  user.classList.add('active');
  user_section.style.display = 'block';
  course_section.style.display = 'none';
});

manage_course.addEventListener("click", function() {
  user.classList.remove('active');
  dashboard.classList.remove('active');
  manage_course.classList.add('active');
  user_section.style.display = 'none';
  course_section.style.display = 'block';
});

dashboard.addEventListener("click", function() {
  user.classList.remove('active');
  manage_course.classList.remove('active');
  dashboard.classList.add('active');
  user_section.style.display = 'none';
  course_section.style.display = 'none';
});


let edit = document.getElementById("edit");
let save = document.getElementById("save");
let name_input = document.getElementById("name_input");

edit.addEventListener("click", function(){
  console.log("click");
  edit.style.display = 'none';
  name_input.readOnly = false;
  name_input.focus();
  save.style.display = 'inline-block';
})



