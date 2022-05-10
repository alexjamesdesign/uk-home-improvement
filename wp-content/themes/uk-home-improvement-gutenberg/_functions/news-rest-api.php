<?php 

/* ========================================================================================================================

News Rest

======================================================================================================================== */

add_action( 'rest_api_init', 'getNews' );

function getNews() {
    register_rest_route( 'news/v1', '/news', array(
        'methods' => 'GET',
        'callback' => 'rest_api_news',
    ) );
}

function rest_api_news($request) {


    if ( empty( $request['cat'] ) ) {
        $cat = null;
    } else {
        $cat = $request['cat'];
    }

    $results = new WP_Query( array(
        'post_type' => array('articles','post'),
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $request['page'],
        'category__in' => $cat
        //'taxonomy' => array('advice_centre', 'categories',),
        
    ) );

    $resultsArray = array();

    while($results->have_posts()) {
        $results->the_post();

        $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');

        $fallbackImage = get_field('fallback_image', 'options');

        $fallback = $fallbackImage['sizes']['medium'];

        if ($image) {
            $img = '<img class="object-cover w-full h-32 lazy object-position-center lg:h-64 lazyload" data-src="' . $image . '" alt="title" width="600" height="200" />';
        } else {
            $img = '<img class="object-cover w-full h-32 lazy object-position-center lg:h-64 lazyload" data-src="' . $fallback . '" alt="title" width="600" height="200" />';
        }
        
        // Get category Name
        $category = get_the_category();
        $firstCategory = $category[0]->cat_name;

        array_push($resultsArray, array(
            'title' => get_the_title(),
            'img' => $img,
            'date' => get_the_date(),
            'link' => get_the_permalink(),
            'cat' => $firstCategory,
            'excerpt' => wp_trim_words( get_the_content(), 20 ),
        ));
    }

    if ( !empty( $resultsArray ) ) {
        return $resultsArray;
    }
}

?>
