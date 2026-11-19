
<?php

function my_project_setup() {
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'my_project_setup');


function my_project_assets() {
    wp_enqueue_style(
        'my-project-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600&family=Barlow:wght@400;600&display=swap'
    );

    wp_enqueue_style(
        'my-project-style',
        get_theme_file_uri('assets/css/style.css'),
        array('my-project-fonts'),
        '1.0'
    );

    wp_enqueue_script(
        'my-project-app',
        get_theme_file_uri('assets/js/app.js'),
        array(),
        '1.0',
        true
    );

    wp_localize_script('my-project-app', 'myProject', array(
        'apiUrl' => get_theme_file_uri('api/data.php')
    ));
}
add_action('wp_enqueue_scripts', 'my_project_assets');
