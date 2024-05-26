jQuery(function($) {

	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 10000,
			pause: false
		});
	});

	 
			$(function(){
			    
			    $("#main-contact-form").on('submit', function(e){
			            e.preventDefault();
			    });
			});		
			
			
			
	$("#main-contact-form").submit(function() {
		$("#serverMessage").slideUp();
		
		$formData = $("#main-contact-form").serialize();
		$url =$("#main-contact-form").attr('action');
		$.ajax({
			type : "POST",
			url : $url,
			data : $formData,
			success : function(response) {
				var json = jQuery.parseJSON(response);
				$("#serverMessage").text(json.message);
				$("#serverMessage").slideDown();
				document.getElementById("main-contact-form").reset();
			},
			error : {
			
				
			}

		});
		
	});
	
	


	//smooth scroll
	$('.navbar-nav > li').click(function(event) {
		/*event.preventDefault();
		var target = $(this).find('>a').prop('hash');
		$('html, body').animate({
			scrollTop: $(target).offset().top
		}, 500);*/
	});

	//scrollspy
	$('[data-spy="scroll"]').each(function () {
		var $spy = $(this).scrollspy('refresh')
	})

	//PrettyPhoto
	$("a.preview").prettyPhoto({
		social_tools: false
	});

	//Isotope
	$(window).load(function(){
		$portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : 'li',
			layoutMode : 'fitRows'
		});
		$portfolio_selectors = $('.portfolio-filter >li>a');
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});
});

