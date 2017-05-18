jQuery(function($){
	/* UFCLAS People Theme 2: Fix problem when widget is in a sidebar < 250px wide */
	if ( $('.widget-gcl-jobs').length ){
		$('.widget-gcl-jobs').parent('#secondary').css({"min-width": "280px"});
		$('.widget-gcl-jobs').parent('#secondary').prev('#primary').css({"max-width": "440px"});
	}
});
