

    		<div class="card mb">
    			<h1 class="date_month"><?php echo get_the_date(M); ?></h1>
    			<?php echo get_the_date('D-M-Y'); ?>
    			<h2 class="card-title" >
    				<a href="<?php the_permalink();?>"><?php echo limit_words(get_the_title(), '4'); ?></a></h2>

    			 <div class="card-footer" style="background: none; border-color: none;">




    			<?php
$post = get_post();
if ($post) {
	$categories = get_the_category($post->ID);

	foreach ($categories as $category) {?>

					  <a class="current_category" href="#"><?php echo $category->name; ?></a>

											<?php }
}
?>

  </div>
              <img class="card-img-top" src="https://placeimg.com/640/480/tech" alt="Card image cap">
              <div class="card-body mb">
                <p class="card-text">
                	<?php echo limit_words(get_the_excerpt(), '20'); ?></p>
              </div>
            </div>


