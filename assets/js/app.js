const $ = (id) => document.getElementById(id);
const video = $('video');
let punten = [], teksten = {}, actief = -1;

const t = (sleutel) => teksten[sleutel] || '';

async function laad(taal = 'nl') {
  try {
    const res = await fetch('api/data.php?taal=' + taal);
    const data = await res.json();
    punten = data.punten.map(p => ({ ...p, tijd: parseFloat(p.tijd_in_film) }));
    teksten = data.teksten;
    video.src = data.instellingen.video_bestand;
    vulTeksten();
    bouwMinimap();
  } catch (e) {
    $('info').textContent = 'De gegevens konden niet worden geladen. Probeer de pagina te verversen.';
  }
}

function vulTeksten() {
  $('titel').textContent = t('start_titel');
  $('startTitel').textContent = t('start_titel');
  $('startUitleg').textContent = t('start_uitleg');
  $('startKnop').textContent = t('start_knop');
  $('colofonKnop').textContent = t('colofon_knop');
  $('colofonTitel').textContent = t('colofon_titel');
  $('colofonTekst').textContent = t('colofon_tekst');
}

function bouwMinimap() {
  const kaart = $('minimap');
  kaart.innerHTML = '';
  punten.forEach((p, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.className = 'stip';
    b.textContent = i + 1;
    b.style.left = p.positie_x + '%';
    b.style.top = p.positie_y + '%';
    b.setAttribute('aria-label', t(p.titel_key));
    b.addEventListener('click', () => ga(i));
    kaart.appendChild(b);
  });
}

function ga(i) {
  if (!punten[i]) return;
  video.currentTime = punten[i].tijd;
}

function toonActief() {
  let nu = -1;
  punten.forEach((p, i) => { if (video.currentTime >= p.tijd) nu = i; });
  if (nu === actief) return;
  actief = nu;
  document.querySelectorAll('.stip').forEach((s, i) =>
    i === nu ? s.setAttribute('aria-current', 'true') : s.removeAttribute('aria-current'));
  const info = $('info');
  info.innerHTML = '';
  if (nu >= 0) {
    const h = document.createElement('h2'); h.textContent = t(punten[nu].titel_key);
    const p = document.createElement('p'); p.textContent = t(punten[nu].tekst_key);
    info.append(h, p);
  }
}

// Tijdlijn en knoppen
video.addEventListener('loadedmetadata', () => { $('tijdlijn').max = video.duration; });
video.addEventListener('timeupdate', () => { $('tijdlijn').value = video.currentTime; toonActief(); });
$('tijdlijn').addEventListener('input', (e) => { video.currentTime = e.target.value; });

$('speel').addEventListener('click', () => {
  if (video.paused) { video.play(); $('speel').textContent = 'Pauzeer'; }
  else { video.pause(); $('speel').textContent = 'Speel af'; }
});
$('volgende').addEventListener('click', () => ga(Math.min(actief + 1, punten.length - 1)));
$('vorige').addEventListener('click', () => {
  // Meer dan 2 seconden in een plek: eerst terug naar het begin van die plek
  const begin = punten[actief] ? punten[actief].tijd : 0;
  ga(video.currentTime - begin > 2 ? actief : Math.max(actief - 1, 0));
});

// Slepen met je vinger: horizontaal scrubben door de film
let startX = null, startTijd = 0;
const vlak = $('filmVlak');
vlak.addEventListener('pointerdown', (e) => {
  if (e.target.closest('button')) return;
  startX = e.clientX; startTijd = video.currentTime;
  vlak.setPointerCapture(e.pointerId);
});
vlak.addEventListener('pointermove', (e) => {
  if (startX === null || !video.duration) return;
  const delta = (e.clientX - startX) / vlak.clientWidth;
  video.currentTime = Math.min(Math.max(startTijd - delta * video.duration, 0), video.duration);
});
['pointerup', 'pointercancel'].forEach(ev => vlak.addEventListener(ev, () => { startX = null; }));

// Pop-ups
$('startKnop').addEventListener('click', () => $('startDialog').close());
$('colofonKnop').addEventListener('click', () => $('colofonDialog').showModal());
$('colofonSluit').addEventListener('click', () => $('colofonDialog').close());

laad().then(() => $('startDialog').showModal());
