const mapa = L.map('mapa').setView([-21.20889, -50.43278], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; OpenStreetMap'
}).addTo(mapa);

// Clique no mapa para escolher o local
let marcador;

async function buscarEndereco(lat, lng) {
  const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=pt-BR`;

  try {
    const resposta = await fetch(url);
    if (!resposta.ok) throw new Error('Erro na consulta');
    const dados = await resposta.json();

    const a = dados.address || {};
    const rua = a.road || 'Rua não identificada';
    const bairro = a.suburb || a.neighbourhood || '';
    const cidade = a.city || a.town || a.village || '';

    return {
      curto: [rua, bairro, cidade].filter(Boolean).join(', '),
      completo: dados.display_name
    };
  } catch (erro) {
    return null;
  }
}

mapa.on('click', async (e) => {
  const { lat, lng } = e.latlng;

  if (marcador) mapa.removeLayer(marcador);
  marcador = L.marker([lat, lng]).addTo(mapa);

  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
  document.getElementById('local-selecionado').textContent = 'Buscando endereço...';

  const endereco = await buscarEndereco(lat, lng);

  if (endereco) {
    document.getElementById('local-selecionado').textContent = endereco.curto;
    document.getElementById('endereco').value = endereco.curto;
  } else {
    document.getElementById('local-selecionado').textContent =
      `Local: ${lat.toFixed(5)}, ${lng.toFixed(5)}`;
    document.getElementById('endereco').value = '';
  }
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

// Validação do formulário
document.querySelector('form').addEventListener('submit', (e) => {
  if (!document.getElementById('lat').value) {
    e.preventDefault();
    alert('Clique no mapa para marcar o local do problema.');
  }
});