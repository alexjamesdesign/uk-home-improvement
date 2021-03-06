<?php

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$args = array(
    'taxonomy' => 'category',
    'hide_empty' => false,
    'parent' => 0
);

$context['categories'] = Timber::get_terms($args);

$context['posts'] = new Timber\PostQuery();
$context['tax'] = new Timber\Term();

Timber::render( [ 'page-'.$timber_post->slug.'.twig', 'page.twig' ], $context );
