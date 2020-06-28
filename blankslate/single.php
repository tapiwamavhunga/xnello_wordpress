



<?php get_header();?>

<?php get_sidebar();?>
  <div id="page-content-wrapper">
            <div class="container-fluid">

            	<nav class="navbar navbar-light bg-white">
			        <h1 class="navbar-brand">Courses</h1>



			    </nav>


				<div class="entry-content">
					<?php if (have_posts()): while (have_posts()): the_post();?>
									<?php get_template_part('entry');?>
									<?php if (comments_open() && !post_password_required()) {comments_template('', true);}?>
									<?php endwhile;endif;?>

				    </div>






            </div>
        </div>







<?php get_footer();?>