<?php
// Carga estilos del tema padre
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('hello-elementor-style', get_template_directory_uri() . '/style.css'
    );


 // Estilos de theme-rentify-child
    wp_enqueue_style(
        'rentify-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['hello-elementor-style'], // se carga después del padre
        filemtime(get_stylesheet_directory() . '/style.css') // cache busting automático
    );
});