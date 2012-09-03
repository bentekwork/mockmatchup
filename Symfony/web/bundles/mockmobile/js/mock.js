$(document).bind('pageinit', function(){
    window.scrollTo(0, 0);

	// if (screen.width>=768) {
	// 	$('.thumb ul li, .thumb ul li, .thumb2 ul li, .thumb2 ul li').addClass('large');
	// } else {
		$('.thumb ul li, .thumb ul li, .thumb2 ul li, .thumb2 ul li').removeClass('large');

			var leftteam = $('#left_team').val();
			var leftobject = $('.thumb ul li[data-team = "' + leftteam +'"]');
			var leftindex = $('.thumb ul li').index(leftobject);
			$('.team1 .show_name').text($(leftobject).attr('title')).css({opacity: 1, 'font-size': '8px'});
						
			var leftcarousel = new Carousel($('.thumb ul'), {
				
				behavior: {
					horizontal: false,
					circular: false,
					keyboardNav: true 				
				},
				initialSlide: leftindex,
				visibleSlides: 1,
				elements: {
					prevNext: false,
					handles: false,
					counter: false,
				},
				animation: {
			        duration: 100,    // milliseconds
			        step: 1          // number of slides per animation (might be lower than number of visible slides)
			    },
			    events: {         // custom callbacks
			        start: function(i){
						$('.team1 .show_name').css({opacity: 0, 'font-size': '3px'});
					},
			        stop: function(i){			
						var newvalue = $('.thumb ul li').eq(i).data('team');
						var teamname = $('.thumb ul li').eq(i).attr('title');
						
						$('#left_team').val(newvalue);
						$('.team1 .show_name').text(teamname).animate({opacity: 1, 'font-size': '8px'}, 300);
						
					}
			    },			
			});
			leftcarousel.init();
			
			$('.thumb ul li').click(function(){
				var clickedIndex = $('.thumb ul li').index($(this));
				leftcarousel.update({
					initialSlide: clickedIndex,
					
				});
				var newvalue = $(this).data('team');
				var teamname = $(this).attr('title');
				$('#left_team').val(newvalue);
				$('.team1 .show_name').text(teamname).animate({opacity: 1, 'font-size': '8px'}, 300);
				
			});
			
			var rightteam = $('#right_team').val();
			var rightobject = $('.thumb2 ul li[data-team = "' + rightteam +'"]');
			var rightindex = $('.thumb2 ul li').index(rightobject);
			
			$('.team2 .show_name').text($(rightobject).attr('title')).css({opacity: 1, 'font-size' : '8px'});
			var carousel = new Carousel($('.thumb2 ul'), {
				behavior: {
					horizontal: false,
					circular: false,
					keyboardNav: true 
				},
				initialSlide: rightindex,
				visibleSlides: 1,
				elements: {
					prevNext: false,
					handles: false,
					counter: false,
				},
				animation: {
			        duration: 100,    // milliseconds
			        step: 1          // number of slides per animation (might be lower than number of visible slides)
			    },
			    events: {         // custom callbacks
			        start: function(i){
						$('.team2 .show_name').css({opacity: 0, 'font-size': '3px'});
					},
			        stop: function(i){
						var newvalue = $('.thumb2 ul li').eq(i).data('team');
						var teamname = $('.thumb2 ul li').eq(i).attr('title');
						$('#right_team').val(newvalue);
						$('.team2 .show_name').text(teamname).animate({opacity: 1, 'font-size': '8px'}, 300);
					}
			    },			
			});
			carousel.init();
			
			$('.thumb2 ul li').click(function(){
				var clickedIndex = $('.thumb2 ul li').index($(this));
				carousel.update({
					initialSlide: clickedIndex,
					
				});
				var newvalue = $(this).data('team');
				var teamname = $(this).attr('title');
				$('#right_team').val(newvalue);
				$('.team2 .show_name').text(teamname).animate({opacity: 1, 'font-size': '8px'}, 300);
				
			});
			
			$("#week").change(function(){ 
				$('#mockmatchform').submit();
			  
			});
//	}
	
});
