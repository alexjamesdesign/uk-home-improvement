<?php
    $context = Timber::get_context();
    $timber_post = new Timber\Post();

    $args = array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'parent' => 0
    );

    $parent = $post->post_parent;

    $queryargs = array (
        // 'taxonomy' => 'category',
        'field'=>'slug',
        'terms'=> $args,
        // 'operator'=>'IN',
    );

    $childargs = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_parent' => $parent,
    );

    $side_menu = [
        'post_type'         => 'page',
        'posts_per_page'    => -1,
        'orderby'           => 'name',
        'order'             => 'ASC',
        'paged'             => $paged,
        'post_parent'       => $parent, 
        'hierarchical'      => 0,
        'tax_query'         => $queryargs,
    ];

    $context['side_menu'] = new Timber\PostQuery($side_menu);
    
    $context['childs'] = Timber::get_terms($childargs);
  

    $context['categories'] = Timber::get_terms($args);
    $context['post'] = $timber_post;

    $context['posts'] = new Timber\PostQuery();
    $context['tax'] = new Timber\Term();

    Timber::render( [ 'index.twig' ], $context );