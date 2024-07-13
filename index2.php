<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tugas SIG | Muh Gibran Fitrah H E1E121076</title>
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
      <h2 class="text-center mb-4">Tugas Final SIG | Muh Gibran Fitrah H. E1E121076</h2>
      
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

  var markers = [];
  var lokasi_array = [
    ["BLUD RS KONAWE", -3.8682691, 122.0751814, 'img/Blud_Rs_Konawe.jpg', 'Rumah sakit umum di Kabupaten Konawe yang menyediakan berbagai layanan kesehatan.'],
    ["Rumah Sakit Bahteramas Kendari", -4.0338098, 122.4891944, 'https://www.halosultra.com/wp-content/uploads/2023/10/WhatsApp-Image-2023-10-06-at-21.42.05.jpeg', 'Rumah sakit rujukan utama di Kendari dengan fasilitas lengkap.'],
    ["Rumah Sakit Bhayangkara Kendari", -3.9724534, 122.503127, 'https://rsbkendari.id/img/rsbk.jpg', 'Rumah sakit yang dikelola oleh Kepolisian Negara Republik Indonesia.'],
    ["RSUD KOTA KENDARI", -3.9900381, 122.5310795, 'https://cdn-assetd.kompas.id/m7dOIKrDKT1icMJv1uP6_KxrWTw=/1024x576/https%3A%2F%2Fsilo.kompas.id%2Fwp-content%2Fuploads%2F2020%2F08%2F20200810_151010_1597045259.jpg', 'Rumah sakit umum daerah di kota Kendari.'],
    ["Rumah Sakit Santa Anna Kendari", -3.9693924, 122.5720809, 'https://medicastore.com/images/faskes/RUMAH-SAKIT-SANTA-ANNA-KENDARI-MEDICASTORE.jpg', 'Rumah sakit swasta dengan pelayanan medis lengkap.'],
    ["Rumah Sakit Kabupaten Kolaka Timur", -4.154946, 121.9132098, 'https://zonasultra.id/wp-content/uploads/2019/01/rsud_koltim.jpg', 'Rumah sakit utama di Kabupaten Kolaka Timur.'],
    ["Rumah Sakit Kabupaten Buton", -5.1671424, 122.5446659, 'https://pict.sindonews.net/dyn/620/pena/news/2020/06/24/174/80436/direktur-2-dokter-dan-25-tenaga-medis-rsud-buton-positif-covid19-bkm.jpg', 'Rumah sakit yang melayani masyarakat Kabupaten Buton.'],
    ["Rumah Sakit Kabupaten Muna", -4.8341882, 122.7223849, 'https://i1.wp.com/oborsejahtera.com/wp-content/uploads/2022/04/Picsart_22-03-31_02-27-27-725.jpg?fit=640%2C366&ssl=1', 'Rumah sakit utama di Kabupaten Muna.'],
    ["Rumah Sakit Kabupaten Wakatobi", -5.3418377, 123.5523305, 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/105/2024/03/15/20240315_090203_863-3926485955.jpeg', 'Rumah sakit yang melayani masyarakat di Kepulauan Wakatobi.']
  ];

  lokasi_array.forEach(function(location) {
    var marker = L.marker([location[1], location[2]], {icon: iconYellow})
      .bindPopup(`<b>${location[0]}</b><br><img src="${location[3]}" width="100" /><br>${location[4]}`)
      .addTo(map);
    markers.push(marker);
    addLocationToList(location[0], location[1], location[2], location[3], location[4]);
  });

  function addLocationToList(name, lat, lng, imgUrl, description) {
    var li = document.createElement('li');
    li.className = 'list-group-item d-flex justify-content-between align-items-center';
    li.innerHTML = `${name} (Lat: ${lat}, Lng: ${lng})<br><small>${description}</small>`;
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
