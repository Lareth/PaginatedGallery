jQuery.fn.extend({
    gsPaginationGallery: function (options) {
        "use strict";
        var optionen = $.extend({
            changeSpeed : 500
        }, options);
        return this.each(function () {
            var $this = $(this),
				$thumbnails = $this.find('.thumbnails'),
				$thumblinks = $thumbnails.find('a'),
				$bigpicture = $this.find('.bigpicture'),
				$currentPicture = $bigpicture.find(':first-child');
			init();
			function init() {
				positionElements();
			}
			function positionElements(){
				$bigpicture.find('img').css({
					'position' : 'absolute',
					'top' : 0,
					'left' : 0
				}).hide();
				$bigpicture.css({
					'position' : 'relative'
				});
				$currentPicture.show();
			}
			$thumblinks.on('click', function(e){
				e.preventDefault();
				var anchor = $(this),
					$target = anchor.attr('href'),
					$tempCurrentPicture = $currentPicture,
					$newCurrentPicture = $bigpicture.find($target);
					
					$currentPicture.fadeOut(optionen.changeSpeed);
					$newCurrentPicture.fadeIn(optionen.changeSpeed);
					$currentPicture = $newCurrentPicture;
					
			});
        });
    }
});