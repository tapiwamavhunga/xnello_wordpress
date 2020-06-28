//type Ajax Filtering
jQuery(function($)
{
	//Load posts on page load
	type_get_posts();

	//If list item is clicked, trigger input change and add css class
	$('#type-filter li').live('click', function(){
		var input = $(this).find('input');
		
		if ( $(this).attr('class') == 'clear-all' )
		{
			$('#type-filter li').removeClass('selected').find('input').prop('checked',false);
			type_get_posts();
		}
		else if (input.is(':checked'))
		{
			input.prop('checked', false);
			$(this).removeClass('selected');
		} else {
			input.prop('checked', true);
			$(this).addClass('selected');	
		}

		input.trigger("change");
	});
	
	//If input is changed, load posts
	$('#type-filter input').live('change', function(){
		type_get_posts(); //Load Posts
	});
	
	//Find Selected types
	function getSelectedTypes()
	{
		var types = [];
	
		$("#type-filter li input:checked").each(function() {
			var val = $(this).val();
			types.push(val);
		});		
		
		return types;
	}
	
	//Fire ajax request when typing in search
	$('#type-search input.text-search').live('keyup', function(e){
		if( e.keyCode == 27 )
		{
			$(this).val('');
		}
		
		type_get_posts(); //Load Posts
	});
	
	$('#submit-search').live('click', function(e){
		e.preventDefault();
		type_get_posts(); //Load Posts
	});
	
	//Get Search Form Values
	function getSearchValue()
	{
		var searchValue = $('#type-search input.text-search').val();	
		return searchValue;
	}
	
	//If pagination is clicked, load correct posts
	$('.type-filter-navigation a').live('click', function(e){
		e.preventDefault();
		
		var url = $(this).attr('href');
		var paged = url.split('&paged=');

		type_get_posts(paged[1]); //Load Posts (feed in paged value)
	});
	
	//Main ajax function
	function type_get_posts(paged)
	{
		var paged_value = paged;
		var ajax_url = ajax_type_params.ajax_url;

		$.ajax({
			type: 'GET',
			url: ajax_url,
			data: {
				action: 'type_filter',
				types: getSelectedTypes,
				search: getSearchValue(),
				paged: paged_value
			},
			beforeSend: function ()
			{
				//Show loader here
			},
			success: function(data)
			{
				//Hide loader here
				$('#type-results').html(data);
			},
			error: function()
			{
				$("#type-results").html('<p>There has been an error</p>');
			}
		});				
	}
	
});