<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blockhaus-categories-list-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blockhaus-taxonomy-list';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>


<?php


$taxonomy = get_field('taxonomy');

if(!isset($taxonomy)):
  
  // default to series_category is no taxonomy has been chosen
  $taxonomy = 'series_category';
endif;

$terms = get_terms( array(
  'taxonomy'   => $taxonomy,
  'hide_empty' => false,
) );


?>

<div class="taxonomy-list grid grid-cols-fill gap-6">

<?php 

foreach($terms as $term) { ?>

  <a class="rounded-md text-sm inline-block w-fit bg-contrast text-white px-6 py-2 ring-2 ring-offset-2 ring-transparent ring-offset-neutral-light-100 hover:ring-contrast focus:ring-contrast" href="<?php echo esc_url(get_term_link($term->term_id));?>">
    <h2 class="col-span-full text-lg font-black"><?php echo $term->name ;?></h2>
  </a>
  


<?php
}?>
</div>
