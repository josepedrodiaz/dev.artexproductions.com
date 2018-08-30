jQuery(function ($) {

	function getScrollbarWidth() {
		var div=$('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div></div>');$('body').append(div);var w1=$('div',div).innerWidth();div.css('overflow-y','auto');var w2=$('div',div).innerWidth();$(div).remove();return(w1-w2);
	}

	function debounce( fn, threshold ) {
		var timeout;
		return function debounced() {
			if ( timeout ) {
				clearTimeout( timeout );
			}
			function delayed() {
				fn();
				timeout = null;
			}
			setTimeout( delayed, threshold || 100 );
		};
	}
	$.fn.isOnScreen = function(){

		var win = $(window);

		var viewport = {
			top : win.scrollTop(),
			left : win.scrollLeft()
		};
		viewport.right = viewport.left + win.width();
		viewport.bottom = viewport.top + win.height();

		var bounds = this.offset();
		bounds.right = bounds.left + this.outerWidth();
		bounds.bottom = bounds.top + this.outerHeight();

		return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

	};

	function WorkList(isoFun) {
		$(".hide-temp").removeClass("visible");
		var curT = $(".works-list .container > .items");
		isoFun.isotope();
		var curHeight = curT.outerHeight();
		$(".hide-temp").addClass("visible");
		isoFun.isotope();
		curT.height(curHeight);

	}

	function lazyImages() {
		$(".works-list .item:visible img.lazy").each(function(index) {
			var cur = $(this);
			if (!cur.hasClass("loaded")) {
				if (cur.isOnScreen()) {
					cur.attr("src", cur.attr("data-original")).addClass("loaded");
				};
				$(window).scroll(function() {
					if (cur.isOnScreen()) {
						cur.attr("src", cur.attr("data-original")).addClass("loaded");
					};
				});
			};
		});
	}


	var referalls;
	var teamS;

	function mobileCheck() {
			
	//$(".home-featured").css({ height: $(window).height() });
	// $(".about-section").css({ height: $(window).height()-52 });
	$(".scraps-over").css({ height: $(window).height()-53 });
	$(".scraps").css({ height: $(window).height()-52-15 });

	$(".scraps-over").css({ width: $(window).width() });
	if ($(".page-template-page-contacts").length) {
		var halfPaddig = ($(window).height()-52-$(".contacts .container").outerHeight())/2;
		$(".contacts").css({ paddingTop: Math.floor(halfPaddig), paddingBottom: Math.floor(halfPaddig) })
	};

	$(".body-post hr").each(function(index) {
		$(".parallax-holder").eq(index).css({ top: $(this).offset().top-$(".parallax-holder").eq(index).height() , bottom: "auto" })
	});

	var winWidth = $(window).width();
	
	if (winWidth>=767){
	
		$(".home-featured").css({ height: $(window).height() });		
		
		if ( $('#home-video').attr('src') != videoDesktop){
			$('#home-video').attr('src', videoDesktop);
			if (typeof $("#home-video")[0] !== 'undefined' ){
				$("#home-video")[0].load();
				$("#home-video")[0].play();		
			}
		}
	}
	else{
	
		$(".home-featured").css({ height: 0 });
		
		if ( $('#home-video').attr('src') != videoMobile){			
			$('#home-video').attr('src', videoMobile);
			if (typeof $("#home-video")[0] !== 'undefined' ){
				$("#home-video")[0].load();
				$("#home-video")[0].play();			
			}
		}
	}

		/*
	teamS = $(".team .items").bxSlider({
			controls: false,
			minSlides: 2,
			maxSlides: 2,
			slideWidth: 650,
			slideMargin: 0,
			infiniteLoop: false,
			auto: true,
			autoHover: true,					
			touchEnabled: false
		});
		*/
		
	referalls = $(".referalls .items").bxSlider({
			controls: false,					
			minSlides: 1,
			maxSlides: 1,
			//slideWidth: 650,
			slideMargin: 0,
			auto: true,
			autoHover: true,
			touchEnabled: false
		});			
};


$(document).ready(function() {
	document.addEventListener( 'wpcf7invalid', function( event ) {
		$(".wpcf7-form").removeClass("loading");
	}, false );
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		$(".wpcf7-form").removeClass("loading");
		$(".wpcf7-form, .contacts .form").addClass("sent");
	}, false );
	$(".contacts .form").append("<span class='form-new'>SEND ANOTHER MESSAGE</span>");
	$(document).on('click', ".form-new", function () {
		$(".wpcf7-form, .contacts .form").removeClass("loading sent");
		$(".wpcf7-form").trigger('reset');
		return false;
	});
	$('body').jpreLoader();

	$(document).on('click', ".contacts .form button", function () {
		$("form input[aria-required=true]").each(function() {
			if ($(this).val() == "") {
				$(this).addClass("wpcf7-not-valid");
			} else {
				$(this).removeClass("wpcf7-not-valid");
				if ($(".form .black input").val() == $(".form .black input").attr("id")) {
					$(".form .black input").removeClass("wpcf7-not-valid")
				} else {
					$(".form .black input").addClass("wpcf7-not-valid")
				};
			};
		});
		if ($(".contacts input.wpcf7-not-valid").length) {
			return false;
		} else {
			$(".wpcf7-form").addClass("loading");
		};
	});

	$(document).on('keyup', ".form .black input", function () {
		if ($(".form .black input").val() == $(".form .black input").attr("id")) {
			$(this).removeClass("wpcf7-not-valid")
		} else {
			$(this).addClass("wpcf7-not-valid")
		};
	});

	$(".hr-left").each(function(index) {
		$(".entry hr").eq(index).after('<div class="bl">'+$(this).html()+'</div>');
		$(this).remove();
	});

	$(".disciplines img").click(function() {
		$(this).parent(".col").toggleClass("active");
		return false;
	});

	$(".disciplines p a").click(function() {
		$(this).parentsUntil(".col").parent().toggleClass("active");
		return false;
	});

	$(".team .btn-all").click(function() {
		if ($(this).hasClass("less")) {
			$(".team").removeClass("view-all");
			$(".team .bx-pager a:first").trigger("click");
		} else {
			$(".team").addClass("view-all");
		};
		return false;
	});

	$(".menu-item-type-custom a").click(function() {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top - 52
		}, 1000);
		$("#menu .trigger").removeClass("active").next().removeClass("active");
		if ($anchor.attr('href') == "#team") {
			$(".team").addClass("view-all");
		};
		return false;
	});

	$(".h-works .down").click(function() {
		$("#menu-home-page a:first").trigger("click")
		return false;
	});

	if (/*@cc_on !@*/false && (
		document.documentMode === 9)
		) {
		// IE 9 or 10 (not 8 or 11!)
	document.documentElement.className += ' ie9';
}

$('.scraps a, .image-gallery').fancybox({
	padding: 0,
	margin: 40,
	beforeShow: function(){
			// var retinaWidth = this.width / 2;
			// if (retinaWidth > 1920) {
			// 	retinaWidth = retinaWidth/2
			// };
			// if (retinaWidth > 1920) {
			// 	retinaWidth = retinaWidth/2
			// };
			// $(".fancybox-overlay").addClass("gallery-fancy");
			// $(".fancybox-image").css({"width":retinaWidth,"height":"auto"});
			// this.width = retinaWidth;
			// console.log($(".fancybox-image").innerHeight());
			// this.height = $(".fancybox-image").innerHeight();
		}
	});

$('.widget_wordpress-insta a').fancybox({
	padding: 0,
	margin: 40,
	beforeShow: function(){
		$(".fancybox-overlay").addClass("gallery-fancy");
	}
});

$('.works-list .list a:not(.image-gallery), .recent-works .item a:not(.image-gallery)').fancybox({
	maxWidth    : 10000,
	maxHeight   : 10000,
	padding     : 0,
	margin: 40,
	fitToView   : false,
	width       : '100%',
	height      : '100%',
	autoSize    : false,
	closeClick  : false,
	openEffect  : 'none',
	closeEffect : 'none',
	helpers : {
		media : {}
	}
});


mobileCheck();
$(window).resize(function() {
	mobileCheck();
});

$("input[type=checkbox], input[type=radio]").crfi();
$("select").crfs();

$("#menu .trigger").click(function() {
	$(this).toggleClass("active").next().toggleClass("active")
});

$(".entry p > img").each(function() {
	$(this).parent().addClass("wp-full");
});

$(".pagination .current").parent().addClass("active");

});

$(window).load(function() {
	if ($(".scraps").length) {

		var scraps;

		$(".scraps .item").each(function() {
			var height = $(".scraps").height()/6;
			$(this).find("a").removeAttr("style");
			var size = 1;
			if ($(this).hasClass("big")) {
				size = 2;
			};
			if ($(this).hasClass("huge")) {
				size = 3;
			};
			var width = height*1.773333;
			$(this).find("a").width(Math.floor(width)*size);
			$(this).find("a").height(Math.floor(height*size));
		});
		window.setTimeout(function() {
			scraps = $('.scraps').isotope({
				layoutMode: 'masonryHorizontal',
				itemSelector: '.item',
				masonryHorizontal: {
					columnWidth: 1,
					rowHeight: 1
				}
			});
			var $scsdf = $(".scraps-over").tinyscrollbar({ axis: "x"});
			var scsdf = $scsdf.data("plugin_tinyscrollbar");
			$(".tr-hol .trigger").click(function() {

				var left = 0

				function frame() {

				    left++; // update parameters
				    scsdf.update(left);

				    $(".tr-hol").fadeOut(600);
			    if (left == $(".scraps .big:first a").width())  // check finish condition
			    	clearInterval(id)
			}

				  var id = setInterval(frame, 1) // draw every 10ms

				  return false;
				});
			$scsdf.bind("move", function()
			{
				if (scsdf.contentPosition > 50) {
					$(".tr-hol").fadeOut(600);
				};
			});
			// $("#loading").fadeOut(300, function() { $("#loading").remove(); });
		}, 300);
		$(window).resize(function() {
			$(".scraps .item").each(function() {
				var height = $(".scraps").height()/6;
				$(this).find("a").removeAttr("style");
				var size = 1;
				if ($(this).hasClass("big")) {
					size = 2;
				};
				if ($(this).hasClass("huge")) {
					size = 3;
				};
				var width = height*1.773333;
				$(this).find("a").width(Math.floor(width)*size);
				$(this).find("a").height(Math.floor(height*size));
			});
			window.setTimeout(function() {
				scraps.isotope('layout');
			}, 300);
		});

	} else {

		// window.setTimeout(function() {
		// 	$("#loading").fadeOut(300, function() { $("#loading").remove(); });
		// }, 10);
	};

	if ($(".home").length) {
		$(window).scroll(function() {
			var offset = $(".about-section").offset();
			if ($(window).scrollTop() > offset.top - 53) {
				$("body").addClass("moved");
			} else {
				$("body").removeClass("moved");
			};
		});
	};
	// if ($(".contacts").length) {
	// 	$(window).scroll(function() {
	// 		var offset = $(".contacts").offset();
	// 		if ($(window).scrollTop() > offset.top - $(window).height() ) {
	// 			$(".contacts").removeClass("contact-map-visible");

	// 		} else {
	// 			$(".contacts").addClass("contact-map-visible");
	// 		};
	// 	});

	// };


	referalls = $(".referalls .items").bxSlider({
		controls: false,
		minSlides: 1,
		maxSlides: 1,
		//slideWidth: 437,
		slideMargin: 0,
		//adaptiveHeight: true,
		auto: true,
		autoHover: true
	});

	/*
	teamS = $(".team .items").bxSlider({
		controls: false,
		minSlides: 3,
		maxSlides: 3,
		slideWidth: 650,
		slideMargin: 0,
		infiniteLoop: true,
		auto: true,
		autoHover: true,
		touchEnabled: false
	});
	*/
		
	$('.team .moving').hover(		
		function(){
			$(this).addClass("overflow-hidden");
		}, function(){
			$(this).removeClass("overflow-hidden");
		}
	);
			
	$("body").removeClass("mobile-v tablet-v");
	mobileCheck();

	$(".recent-awards .item").each(function(index) {
		$(this).wrap("<span class='awi'></span>");
	});

	$(".works-list .item img.lazy").each(function(index) {
		var cur = $(this);
		if (!cur.hasClass("loaded")) {
			cur.attr("src", "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADhAQMAAADceHFfAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAANQTFRF////p8QbyAAAAAF0Uk5TAEDm2GYAAAAiSURBVBgZ7cExAQAAAMIg+6deDB9gAAAAAAAAAAAAAAA/ASzTAAGcOjEZAAAAAElFTkSuQmCC");
		};
	});

	$(".works-list .items").clone().appendTo(".works-list .before,.works-list .after");

	$('.works-list .before .items, .works-list .after .items').isotope({
		itemSelector: '.item',
		masonry: {
			columnWidth: 1
		}
	});

	var qsRegex;
	var buttonFilter;

	var $container = $('.works-list .container > .items').isotope({
		itemSelector: '.item',
		masonry: {
			columnWidth: 1
		},
		filter: function() {
			var $this = $(this);
			if ($this.hasClass("cloned")) {
				return true
			};
			var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
			var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
			return searchResult && buttonResult;
		}
	});

	var $quicksearch = $('#quicksearch').keyup( debounce( function() {
		qsRegex = new RegExp( $quicksearch.val(), 'gi' );
		lazyImages();
		$container.isotope();
		WorkList($container);
	}) );

	$(".works-header .right-side a.ico-search").click(function() {
		if ($(this).parent().hasClass("current")) {
			$(this).removeClass("current");
			$(this).parent().removeClass("current");
			$(this).parent().find("input").val("");
			qsRegex = new RegExp("", 'gi' );
			lazyImages();
			$container.isotope();
			WorkList($container);
		} else {
			$(this).addClass("current");
			$(this).parent().addClass("current");
			$(this).parent().find("input").focus();
		};
		return false;
	});

	$(".works-header .right-side a.ico-list").click(function() {
		$(".works-header .right-side a.ico-grid").removeClass("current");
		$(".works-list").removeClass("grid-style list-style").addClass("list-style");
		$(this).addClass("current");
		return false;
	});

	$(".works-header .right-side a.ico-grid").click(function() {
		$(".works-header .right-side a.ico-list").removeClass("current");
		$(".works-list").removeClass("grid-style list-style").addClass("grid-style");
		$(this).addClass("current");
		return false;
	});

	$(".works-list").addClass("filter-4");
	$(".filters a").click(function() {
		buttonFilter = $(this).attr("href");
		$(".filters li").removeClass("current");
		$(this).parent().addClass("current");
		if (buttonFilter == ".works_cats-photography") {
			$(".works-list").removeClass("filter-4");
			$(".works-list").addClass("filter-3");
		} else {
			$(".works-list").removeClass("filter-3");
			$(".works-list").addClass("filter-4");
		};
		WorkList($container);
		lazyImages();
		return false;
	});

	$(".works-header .filters a:first").trigger("click");

	$(".recent-works .filter a").click(function() {
		$(".recent-works .tab").hide();
		$("#tab-content-"+$(this).attr("href")).fadeIn(300);
		$(".recent-works .filter li").removeClass("current");
		$(this).parent().addClass("current");
		return false;
	});

	WorkList($container);

	$(window).resize(function() {
		WorkList($container);
		lazyImages();
	});

	$(".demo-video .close").click(function() {
		$(".demo-video").fadeOut(300);
		$("iframe").attr("src", $("iframe").attr("src"))

		$(".demo-video .item iframe").each(function(index) {
			$(this).attr("src", $(this).attr("src"))
		});

		return false;
	});

	$(".home-featured .play a").click(function() {
		$(".demo-video").fadeIn(300);
		$("body").addClass("overflow-hidden");
		return false;
	});

	$(".demo-video .items").bxSlider({
		controls: false,
		pager: false,
		mode: "fade",
		onSlideBefore: function() {
			$(".vjs-play-control.vjs-playing").trigger("click");
		}
	});

	$(".recent-awards .slides").bxSlider({
		controls: false,
		pager: false,
		mode: "fade",
		auto: true,
		autoHover: true
	});

	$(".body-post .post-data iframe").wrap("<div class='embed-container'></div>");

	if ($("body").hasClass("home")) {
		if(window.location.hash) {
			var hash = window.location.hash.replace("#","");
			if (hash == "team") {
				$(".team").addClass("view-all");
			};
		};
	};
	if(window.location.hash) {
		var hash = window.location.hash.replace("#","");
		$(".works-list .list > .container >.items").children(".post-"+hash).find("a").trigger("click");
	};
});
});


var mySideNav = document.getElementById("mySideNav")
//Instead of repeating this statement again and again,
// I just created a variable that I'm going to call anytime
// I need to do document.getElementById("mySideNav")

function openNav(){
    mySideNav.style.height="0vh";


}

function closeNav(){
    mySideNav.style.height="0";
}


