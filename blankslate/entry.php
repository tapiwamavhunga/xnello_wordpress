<article id="post-<?php the_ID();?>" <?php post_class();?>>
<header>
<?php if (is_singular()) {
	echo '<h1 class="entry-title">';
} else {
	echo '<h2 class="entry-title">';
}?>
<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark"><?php the_title();?></a>
<?php if (is_singular()) {
	echo '</h1>';
} else {
	echo '</h2>';
}?> <?php edit_post_link();?>
<?php if (!is_search()) {get_template_part('entry', 'meta');}?>
</header>
<?php get_template_part('entry', (is_front_page() || is_home() || is_front_page() && is_home() || is_archive() || is_search() ? 'summary' : 'content'));?>
<?php if (is_singular()) {get_template_part('entry-footer');}?>



<?php the_field('start_date');?>
<?php the_field('end_date');?>
<?php the_field('learning_outcome');?>
<?php the_field('course_preview');?>
<?php the_field('course_benefits');?>
<?php the_field('entry_recquirements');?>
<?php $category = get_field('category');?>
<?php if ($category): ?>
	<?php $get_terms_args = array(
	'taxonomy' => 'category',
	'hide_empty' => 0,
	'include' => $category,
);?>
	<?php $terms = get_terms($get_terms_args);?>
	<?php if ($terms): ?>
		<?php foreach ($terms as $term): ?>
			<a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
		<?php endforeach;?>
	<?php endif;?>
<?php endif;?>
<?php the_field('skill_level');?>
<?php the_field('skill_you_will_develop');?>
<?php the_field('price');?>



</article>