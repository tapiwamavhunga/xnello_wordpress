<?php get_header();?>

<?php get_sidebar();?>
  <div id="page-content-wrapper">
            <div class="container-fluid">

            	<nav class="navbar navbar-light bg-white">
			        <h1 class="navbar-brand">Courses</h1>


			           <form id="type-search" class="form-inline">
				            <input type="text" class="text-search" placeholder="Search books..." />
				            <input type="submit" value="Search" id="submit-search" />
				        </form>
			    </nav>


				<div class="entry-content">

				        <div id="type-filter">
				            <?php echo get_type_filters(); ?>
				        </div>
				        <div class="mt-3">
				        	<div id="type-results" class="row"></div>
				        </div>

				    </div>






            </div>
        </div>







<?php get_footer();?>