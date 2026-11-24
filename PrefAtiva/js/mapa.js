const mapa = L.map('mapa').setView([-21.208889, -50.432778], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; OpenStreetMap'
}).addTo(mapa);

// Clique no mapa para escolher o local
let marcador;
mapa.on('click', (e) => {
  const { lat, lng } = e.latlng;
  if (marcador) mapa.removeLayer(marcador);
  marcador = L.marker([lat, lng]).addTo(mapa);
  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
});

// Carregar problemas do banco e montar o mapa de calor
fetch('api/problemas.php')
  .then(r => r.json())
  .then(problemas => {
    problemas.forEach(p => {
      L.marker([p.latitude, p.longitude])
        .addTo(mapa)
        .bindPopup(`<b>${p.titulo}</b><br>${p.descricao}`);
    });

    const pontos = problemas.map(p => [p.latitude, p.longitude, 0.5]);
    L.heatLayer(pontos, { radius: 25 }).addTo(mapa);
  });