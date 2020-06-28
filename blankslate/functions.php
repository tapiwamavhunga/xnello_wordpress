<?php

//Register Courses post type
function codex_custom_init() {
	$args = array(
		'public' => true,
		'label' => 'Courses',
	);
	register_post_type('course', $args);
}
add_action('init', 'codex_custom_init');

//Register Course type taxonomy
add_action('init', 'create_course_tax');

function create_course_tax() {
	register_taxonomy(
		'type',
		'course',
		array(
			'label' => __('Type'),
			'rewrite' => array('slug' => 'type'),
			'hierarchical' => true,
		)
	);
}

//Get type Filters
function get_type_filters() {
	$terms = get_terms('type');
	$filters_html = false;

	if ($terms):

		$filters_html = '<ul class="row">';

		$filters_html .= '<li  class="clear-all">All</li>';

		foreach ($terms as $term) {
			$term_id = $term->term_id;
			$term_name = $term->name;

			$filters_html .= '<li id="term" class="term_id_' . $term_id . '">' . $term_name . '<input id="term_all" type="checkbox" name="filter_type[]" value="' . $term_id . '"></li>';
		}
		$filters_html .= '</ul>';

		return $filters_html;
	endif;
}

//Enqueue Ajax Scripts
function enqueue_type_ajax_scripts() {
	wp_register_script('type-ajax-js', get_bloginfo('template_url') . '/js/type.js', array('jquery'), '', true);
	wp_localize_script('type-ajax-js', 'ajax_type_params', array('ajax_url' => admin_url('admin-ajax.php')));
	wp_enqueue_script('type-ajax-js');
}
add_action('wp_enqueue_scripts', 'enqueue_type_ajax_scripts');

//Add Ajax Actions
add_action('wp_ajax_type_filter', 'ajax_type_filter');
add_action('wp_ajax_nopriv_type_filter', 'ajax_type_filter');

//Construct Loop & Results
function ajax_type_filter() {
	$query_data = $_GET;

	$type_terms = ($query_data['types']) ? explode(',', $query_data['types']) : false;

	$tax_query = ($type_terms) ? array(array(
		'taxonomy' => 'type',
		'field' => 'id',
		'terms' => $type_terms,
	)) : false;

	$search_value = ($query_data['search']) ? $query_data['search'] : false;

	$paged = (isset($query_data['paged'])) ? intval($query_data['paged']) : 1;

	$course_args = array(
		'post_type' => 'course',
		's' => $search_value,
		'posts_per_page' => 3,
		'tax_query' => $tax_query,
		'paged' => $paged,
	);
	$course_loop = new WP_Query($course_args);

	if ($course_loop->have_posts()):
		while ($course_loop->have_posts()): $course_loop->the_post();
			echo '<div class="col-md-4">';
			get_template_part('content');
			echo '</div>';
		endwhile;

		echo '<div class="type-filter-navigation">';
		$big = 999999999;
		echo paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, $paged),
			'total' => $course_loop->max_num_pages,
		));
		echo '</div>';
	else:
		echo '<div class="col-md-4">';
		get_template_part('content-none');
		echo '</div>';
	endif;
	wp_reset_postdata();

	die();
}

function limit_words($string, $word_limit) {

	$words = explode(' ', $string);

	return implode(' ', array_slice($words, 0, $word_limit));

}
