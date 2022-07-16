<?php

/* Template Name: Privacy Policy */

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

Timber::render( [ 'page-privacy-policy.twig', 'page-privacy-policy.twig' ], $context );
