<?php 

$request = Zend_Controller_Front::getInstance()->getRequest();

// Get the address, latitude, longitude, and the radius from parameters
$address = trim($request->getParam('geolocation-address'));
$currentLat = trim($request->getParam('geolocation-latitude'));
$currentLng = trim($request->getParam('geolocation-longitude'));
$radius = trim($request->getParam('geolocation-radius'));

if (empty($radius)) {
    $radius = 10; // 10 miles
}


?>
<div class="row">
    <div class="span8">
        <fieldset> 
            <legend><i class="icon-globe"></i> Location Search</legend>
            <div class="row">
                <div class="span4">
                    <div class="field">
                        <?php echo $this->formLabel('geolocation-address', __('Location')); ?>
                        <div class="inputs">
                            <?php echo $this->formText('geolocation-address',  $address, array('name'=>'geolocation-address','placeholder' => 'e.g. City, State','id'=>'geolocation-address','class'=>'textinput span3')); ?>
                            <?php echo $this->formHidden('geolocation-latitude', $currentLat, array('name'=>'geolocation-latitude','id'=>'geolocation-latitude')); ?>
                            <?php echo $this->formHidden('geolocation-longitude', $currentLng, array('name'=>'geolocation-longitude','id'=>'geolocation-longitude')); ?>
                            <?php echo $this->formHidden('geolocation-radius', $radius, array('name'=>'geolocation-radius','id'=>'geolocation-radius')); ?>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="field">
                            <?php echo $this->formLabel('geolocation-radius', __('Radius from location (in miles)')); ?>
                            <div class="inputs">
                            <?php echo $this->formText('geolocation-radius', $radius, array('name'=>'geolocation-radius','id'=>'geolocation-radius','class'=>'textinput span3')); ?>
                        </div>
                    </div>
                </div>
                <div class="span4">

                </div>
            </div>
    </div>
</div>




<script type="text/javascript">
    jQuery(document).ready(function() {
	    jQuery('#<?php echo $searchButtonId; ?>').click(function(event) {
	            	        
	        // Find the geolocation for the address
	        var address = jQuery('#geolocation-address').val();
            if (jQuery.trim(address).length > 0) {
                var geocoder = new google.maps.Geocoder();	        
                geocoder.geocode({'address': address}, function(results, status) {
                    // If the point was found, then put the marker on that spot
            		if (status == google.maps.GeocoderStatus.OK) {
            			var gLatLng = results[0].geometry.location;
            	        // Set the latitude and longitude hidden inputs
            	        jQuery('#geolocation-latitude').val(gLatLng.lat());
            	        jQuery('#geolocation-longitude').val(gLatLng.lng());
                        jQuery('#<?php echo $searchFormId; ?>').submit();
            		} else {
            		  	// If no point was found, give us an alert
            		    alert('Error: "' + address + '" was not found!');
            		}
                });
                
                event.stopImmediatePropagation();
    	        return false;
            }                
	    });
    });
</script>
