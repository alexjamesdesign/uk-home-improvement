<?php
    $context = Timber::get_context();
    $timber_post = new Timber\Post();

    $args = array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => 0
    );

    $context['categories'] = Timber::get_terms($args);
    $context['post'] = $timber_post;

    $context['posts'] = new Timber\PostQuery();
    $context['tax'] = new Timber\Term();

    Timber::render( [ 'index.twig' ], $context );