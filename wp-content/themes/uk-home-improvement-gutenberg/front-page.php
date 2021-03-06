<?php

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$args = array(
    'taxonomy' => 'category',
    'hide_empty' => false,
    // 'parent' => 0
);

$context['featured'] = new Timber\PostQuery(array(
    'post_type' => 'post',
    'posts_per_page' => 1,
));

$context['categories'] = Timber::get_terms($args);

$context['posts'] = new Timber\PostQuery();
$context['tax'] = new Timber\Term();

Timber::render( [ 'frontpage.twig', 'frontpage.twig' ], $context );
