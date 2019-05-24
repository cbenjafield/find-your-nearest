(function($) {

	$('.fyn-geocode').click(function(e) {
		e.preventDefault();
		var postcode = $('#fyn_postcode').val();
		if(!postcode) return alert('Please enter a postcode.');
		$.ajax({
			url: fyn_admin.ajaxurl,
			type: 'GET',
			dataType: 'json',
			data: {
				postcode: postcode,
				action: 'fyn_geocode_postcode'
			},
			success: function(r) {
				$('#fyn_latitude').val(r.latitude);
				$('#fyn_longitude').val(r.longitude);
			},
			error: function(xhr) {
				return alert('Error ' + xhr.status + ': An error occurred.');
			}
		})
	});

})($);