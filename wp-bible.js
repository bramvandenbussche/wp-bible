'use strict';


var wp_bible_tagger = {
	
	start: function() {
		jQuery('a.wp-bible-reference').on('mouseover', function(eventObject) {
			// Find nearest bible passage
			var passageReference = jQuery(this).attr('wp-bible-reference');			
			var passageElement = jQuery(this).next('.wp-bible-passage[wp-bible-reference="' + passageReference + '"]');
			
			jQuery('span[wp-bible-reference]').hide();
			jQuery('div[wp-bible-reference]').hide();
			jQuery(passageElement).show();
			
		});
		
		jQuery('.wp-bible-passage').on('click', function(eventObject) {
			jQuery(this).toggle();
		});
	}
};

jQuery(document).ready(function() {
	wp_bible_tagger.start();
});