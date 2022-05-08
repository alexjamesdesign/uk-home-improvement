<?php
    $context = Timber::get_context();

    $args = array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => 0
    );

    $context['categories'] = Timber::get_terms($args);

    $context['posts'] = new Timber\PostQuery();
    $context['tax'] = new Timber\Term();


    Timber::render( [ 'index.twig' ], $context );