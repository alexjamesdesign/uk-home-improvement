<?php 
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('production', get_theme_file_uri() . '/dist/production-dist.js', ['jquery'], '', true);

        // Addon scripts that should only be loaded on certain pages...
        wp_enqueue_script( 'news', get_stylesheet_directory_uri() .'/dist/production-news.js?v=1','','', true  );

        wp_localize_script('news', 'newsglobal', array(
            'news_api' => home_url( '/wp-json/news/v1/news' )
        ));    

        // Localize the themeURL to our production file so we can use it to complete file paths
        wp_localize_script('production', 'themeURL', array(
          'themeURL' => get_stylesheet_directory_uri()
          )
		);
    });
