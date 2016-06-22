var $ = jQuery.noConflict();

var placeSearch, autocomplete;
var componentForm = {
  route: 'long_name',
  street_number: 'long_name',
  neighborhood: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'short_name',
  postal_code: 'short_name'
};
// Create the autocomplete object, restricting the search
// to geographical location types.
/** @type {HTMLInputElement} */
function autofill_initialize() 
{
	autocomplete = new google.maps.places.Autocomplete((document.getElementById("route")),{ types: ['geocode'] });
// When the user selects an address from the dropdown,
// populate the address fields in the form.
	google.maps.event.addListener(autocomplete, 'place_changed', function() 
	{
		fillInAddress();
	});
}

// [START region_fillform]
// Get the place details from the autocomplete object.
function fillInAddress() 
{
	var place = autocomplete.getPlace();
// Get each component of the address from the place details
// and fill the corresponding field on the form.
	var address=""; 
	console.log(place);
	for (var i = 0; i < place.address_components.length; i++) 
	{
		var addressType = place.address_components[i].types[0];
		if ( componentForm[addressType] ) 
		{
			var val = place.address_components[i][componentForm[addressType]];
			if ( $("#"+addressType).length )
			{
				$("#"+addressType).val( val );
			}
			else
			{
				address += ", "+ place.address_components[i].long_name;
			}
		}

	}
	$("#route").val( $("#route").val()+address );
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the users geographical location,
// as supplied by the browsers navigator.geolocation\' object.
function geolocate() {
	if (navigator.geolocation) 
	{
		navigator.geolocation.getCurrentPosition(function(position) {
		  var geolocation = new google.maps.LatLng(
				position.coords.latitude, position.coords.longitude);
		  var circle = new google.maps.Circle({
				center: geolocation,
				radius: position.coords.accuracy
		  });
		  autocomplete.setBounds(circle.getBounds());
		   fillInAddress();
		});
	}
}
// [END region_geolocation]