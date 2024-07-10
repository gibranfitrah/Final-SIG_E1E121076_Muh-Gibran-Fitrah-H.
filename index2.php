<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tugas SIG | Gibran 076</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style type="text/css">
      #map {
        height: 80vh;
      }
    </style>
  </head>
  <body>
    <div class="container mt-4">
      <h2 class="text-center mb-4">Tugas SIG | Gibran 076</h2>
      
      <div id="map" class="mb-4"></div>

      <form id="locationForm" class="form-inline mb-4">
        <div class="form-group mr-2">
          <label for="name" class="mr-2">Nama</label>
          <input type="text" id="name" class="form-control" required />
        </div>
        <div class="form-group mr-2">
          <label for="lat" class="mr-2">Lat</label>
          <input type="text" id="lat" class="form-control" required />
        </div>
        <div class="form-group mr-2">
          <label for="lng" class="mr-2">Lng</label>
          <input type="text" id="lng" class="form-control" required />
        </div>
        <div class="form-group mr-2">
          <label for="imgUrl" class="mr-2">Gambar URL</label>
          <input type="text" id="imgUrl" class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Tambah</button>
      </form>

      <ul id="locationList" class="list-group"></ul>
    </div>

    <script type="text/javascript">
  var map = L.map('map').setView([-3.8526158, 122.0712067], 5);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  var iconYellow = L.icon({
    iconUrl: 'img/yellow.png',
    iconSize: [60, 60]
  });

  var iconRed = L.icon({
    iconUrl: 'img/red.png',
    iconSize: [25, 25]
  });

  var markers = [];
  var lokasi_array = [
    ["SMA 1 Kendari", -3.9628107, 122.5394034, 'img/sma1.jpg'],
    ["SMA 5 Kendari", -4.0414107, 122.4906404, 'img/sma5.jpeg']
  ];

  lokasi_array.forEach(function(location) {
    var marker = L.marker([location[1], location[2]], {icon: iconYellow})
      .bindPopup(`<b>${location[0]}</b><br><img src="${location[3]}" width="100" />`)
      .addTo(map);
    markers.push(marker);
    addLocationToList(location[0], location[1], location[2], location[3]);
  });

  function addLocationToList(name, lat, lng, imgUrl) {
    var li = document.createElement('li');
    li.className = 'list-group-item d-flex justify-content-between align-items-center';
    li.textContent = `${name} (Lat: ${lat}, Lng: ${lng})`;
    var deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger btn-sm';
    deleteButton.textContent = 'Hapus';
    deleteButton.addEventListener('click', function() {
      deleteMarker(name, lat, lng);
      li.remove();
    });
    li.appendChild(deleteButton);
    document.getElementById('locationList').appendChild(li);
  }

  function deleteMarker(name, lat, lng) {
    markers = markers.filter(function(marker) {
      if (marker.getLatLng().lat === parseFloat(lat) && marker.getLatLng().lng === parseFloat(lng)) {
        map.removeLayer(marker);
        return false;
      }
      return true;
    });
  }
</script>
  </body>
</html>
