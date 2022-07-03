<?php 

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$context['categories'] = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

$side_menu = [
  'post_type'         => 'page',
  'posts_per_page'    => -1,
  'orderby'           => 'name',
  'order'             => 'ASC',
  'paged'             => $paged,
  'post_parent'       => $post->post_parent, 
  'hierarchical'      => 0,
];

$context['side_menu'] = new Timber\PostQuery($side_menu);

Timber::render( [ 'single.twig' ], $context );

if (is_single()) { ?>
<script type="text/javascript">
  document.querySelector('.current_page_parent').classList.add('current-menu-item');
</script>
<?php }
