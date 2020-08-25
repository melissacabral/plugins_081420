//WordPress' JQuery runs in "noconflict" mode. we have to define $
jQuery(document).ready(function( $ ){
	$(".high-dismiss").click( function(){
		$("#high-bar").fadeOut();
	} );
});


