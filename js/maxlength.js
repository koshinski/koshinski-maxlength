jQuery(document).ready(function($){
	$('[maxlength]').each(function(){
		var $this = $(this),
			maxlength = $this.attr('maxlength'),
			maxlengthClassName = 'koshinski-maxlength-rest';
			
		$this.after( $('<span/>').addClass(maxlengthClassName) );
		$this.next('.'+maxlengthClassName).css({ top: 0, right: '10px', opacity: 0 });
		
		$this.on('keyup focusin', function(e){
			var val = $this.val().replace(/\r\n|\r|\n/g, '\r\n').slice(0, maxlength);
			$this.val(val);
			$this.next('.'+maxlengthClassName).html(maxlength - val.length + ' Zeichen');
		});
	});
	$(document).on('focusin focusout', '[maxlength]', function(e){
		var maxlengthClassName = 'koshinski-maxlength-rest',
			$anzeige = $(this).next('.'+maxlengthClassName);

		if( typeof e.type !== undefined && e.type == 'focusin' ){
			$anzeige.animate({opacity: 1}, 250);
		}else{
			$anzeige.animate({opacity: 0}, 250);
		}
	});
});
