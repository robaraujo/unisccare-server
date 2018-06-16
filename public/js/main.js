jQuery(function() {
	jQuery.ajaxSetup({
    	headers: {
	        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    }
	});
});	

function loaderPresent(overlay) {
	var $loader = jQuery('.loading-gif').show();
	$loader.toggleClass('overlay', !!overlay);
}
function loaderDismiss() {
	jQuery('.loading-gif').hide();	
}
function getLastId(items) {
    return items && items.length ? items[items.length -1].id : 0;
}
function scrollBottom(elem, time) {
	var $elem = jQuery(elem);
	
	if (time === 0) {
		return $elem.scrollTop( $elem.prop("scrollHeight") );
	} 
	
    $elem.animate({ scrollTop: $elem.prop("scrollHeight")}, time || 1000);
}