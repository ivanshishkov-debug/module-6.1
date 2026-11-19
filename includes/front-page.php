
<?php get_header(); ?>

<main class="scherm">

    <h1 class="verborgen" id="titel">
        Ontmoet de Oudegracht
    </h1>

    <div class="film-vlak" id="filmVlak"
         role="region"
         aria-label="Filmbeelden van de Oudegracht">

        <video
            class="video"
            src="<?php echo esc_url(get_theme_file_uri('assets/video/oudegracht.mp4')); ?>"
            id="video"
            autoplay
            muted
            playsinline
            loop
            preload="auto"
            aria-label="Oude filmbeelden van de Oudegracht">
        </video>

    </div>

    <div class="boven-links">

        <img
            class="logo"
            src="<?php echo esc_url(get_theme_file_uri('assets/img/logo-hua.webp')); ?>"
            alt="Het Utrechts Archief"
            height="48">

        <button type="button" class="knop knop-rond" id="colofonKnop">
            Over deze applicatie
        </button>

    </div>

    <aside class="minimap-blok" aria-label="Kaart met plekken">
        <div class="minimap" id="minimap"></div>
    </aside>

    <button type="button" class="pijl pijl-links"
            id="vorige" aria-label="Vorige plek">
        &#9664;
    </button>

    <button type="button" class="pijl pijl-rechts"
            id="volgende" aria-label="Volgende plek">
        &#9654;
    </button>

    <div class="balk">

        <div class="info" id="info" aria-live="polite"></div>

        <button type="button" class="knop knop-accent" id="speel">
            Pauzeer
        </button>

        <label class="tijdlijn-label" for="tijdlijn">
            Tijd in de film
        </label>

        <input
            type="range"
            id="tijdlijn"
            min="0"
            max="100"
            step="0.1"
            value="0">

    </div>

</main>

<dialog id="startDialog" aria-labelledby="startTitel">

    <h2 id="startTitel"></h2>

    <p id="startUitleg"></p>

    <button type="button"
            class="knop knop-accent knop-groot"
            id="startKnop">
        Start
    </button>

</dialog>

<dialog id="colofonDialog" aria-labelledby="colofonTitel">

    <img
        class="logo logo-donker"
        src="<?php echo esc_url(get_theme_file_uri('assets/img/logo-hua.svg')); ?>"
        alt="Het Utrechts Archief"
        height="48">

    <h2 id="colofonTitel"></h2>

    <p id="colofonTekst"></p>

    <button type="button"
            class="knop knop-accent"
            id="colofonSluit">
        Sluiten
    </button>

</dialog>

<?php get_footer(); ?>
