<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ontmoet de Oudegracht – Het Utrechts Archief</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&family=Barlow:wght@400;600&display=swap">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <a class="skip" href="#filmVlak">Ga naar de film</a>

  <main class="scherm">
    <h1 class="verborgen" id="titel">Ontmoet de Oudegracht</h1>

    <div class="film-vlak" id="filmVlak" role="region" aria-label="Filmbeelden van de Oudegracht">
      <video class="video" src="assets/video/oudegracht.mp4" id="video" autoplay muted playsinline loop preload="auto"
             aria-label="Oude filmbeelden van de Oudegracht"></video>
    </div>

    <div class="boven-links">
      <img class="logo" src="assets/img/logo-hua.webp" alt="Het Utrechts Archief" height="48">
      <button type="button" class="knop knop-rond" id="colofonKnop">Over deze applicatie</button>
    </div>

    <aside class="minimap-blok" aria-label="Kaart met plekken">
      <div class="minimap" id="minimap"></div>
    </aside>

    <button type="button" class="pijl pijl-links" id="vorige" aria-label="Vorige plek">&#9664;</button>
    <button type="button" class="pijl pijl-rechts" id="volgende" aria-label="Volgende plek">&#9654;</button>

    <div class="balk">
      <div class="info" id="info" aria-live="polite"></div>
      <button type="button" class="knop knop-accent" id="speel">Pauzeer</button>
      <label class="tijdlijn-label" for="tijdlijn">Tijd in de film</label>
      <input type="range" id="tijdlijn" min="0" max="100" step="0.1" value="0">
    </div>
  </main>

  <dialog id="startDialog" aria-labelledby="startTitel">
    <h2 id="startTitel"></h2>
    <p id="startUitleg"></p>
    <button type="button" class="knop knop-accent knop-groot" id="startKnop">Start</button>
  </dialog>

  <dialog id="colofonDialog" aria-labelledby="colofonTitel">
    <img class="logo logo-donker" src="assets/img/logo-hua.svg" alt="Het Utrechts Archief" height="48">
    <h2 id="colofonTitel"></h2>
    <p id="colofonTekst"></p>
    <button type="button" class="knop knop-accent" id="colofonSluit">Sluiten</button>
  </dialog>

  <script src="assets/js/app.js"></script>
</body>
</html>
