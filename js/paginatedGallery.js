(function($){
  jQuery.fn.extend({
      paginatedGallery: function (options) {
          "use strict";
          var optionen = $.extend({
              changeSpeed : 500,
              thumbNailClass: '.thumbnails',
              bigPictureClass: '.bigpicture'
          }, options);
          return this.each(function () {
              var $this = $(this),
  				$thumbnails = $this.find(optionen.thumbNailClass),
  				$thumblinks = $thumbnails.find('a'),
  				$bigpicture = $this.find(bigPictureClass),
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
})( jQuery );
