<?php
    $context = Timber::get_context();

    $args = array(
        'taxonomy' => 'category',
        'hide_empty' => false,
    );

    $context['categories'] = Timber::get_terms($args);

    Timber::render( [ 'index.twig' ], $context );