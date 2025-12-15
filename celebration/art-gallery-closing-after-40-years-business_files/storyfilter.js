var storyfilter = {
	imceWindow: undefined,
	browseForImage: function () {
		if (typeof storyfilter.imceWindow == 'undefined' || storyfilter.imceWindow.closed) {
			storyfilter.imceWindow = window.open('/imce?app=storyfilter|imceload@storyfilter.onloadIMCE', 'myName', 'width=640,height=480');
		}
	},
	onloadIMCE: function (win) {
		win.imce.setSendTo('Set as Banner Image', storyfilter.handleImage);
	},
	handleImage: function (file, win) {
		$('#edit-title-image').val(file.url);
		win.close();
	},
	displayFullsizeImage: function (sURL, iWidth, iHeight, oExtra) {
		var iWidth = 800,
			iHeight = 600;
		$('body').append(
			$('<div id="storyfilter-background"></div>').css({opacity: '0.7'}).click(function () {
				storyfilter.removePopup();
			})
		).css({overflow: 'hidden'});
		$("#storyfilter-background").fadeIn('slow', function () {
			// Image
			var oPopup = $('<div id="storyfilter-popup"></div>').append(
				$('<img>').attr({src: sURL, width: iWidth, height: iHeight, id: 'storyfilter-popup-image'})
			).hide().click(function (e) {
				e.stopPropagation();
				return false;
			});
			$('body').append(oPopup);
			// Close button
			$('body').append(
				$('<img>').attr({src: '/sites/all/modules/storyfilter/close-button.gif', width: 35, height: 35, id: 'storyfilter-popup-close-button'}).click(function () {
					storyfilter.removePopup();
				})
			);
			if ($(oExtra)) {
				var oOverlay = $('<div class="storyfilter-overlay" id="storyfilter-overlay"></div>');
				if ($(oExtra).children('.byline').html() || $(oExtra).children('.cutline').html()) {
					$('body').append(oOverlay);
				}
				if ($(oExtra).children('.byline').html()) {
					oOverlay.append($('<div class="storyfilter-byline">' + $(oExtra).children('.byline').html() + '</div>'));
				}
				if ($(oExtra).children('.cutline').html()) {
					oOverlay.append($('<div class="storyfilter-cutline">' + $(oExtra).children('.cutline').html() + '</div>'));
				}
			}
			storyfilter.centerPopup();
			$(window).bind('resize', storyfilter.centerPopup);
			oPopup.fadeIn();
		});
	},
	centerPopup: function (event) {
		//request data for centering
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = $("#storyfilter-popup").height();
		var popupWidth = $("#storyfilter-popup").width();
		//centering
		$("#storyfilter-popup").css({
			"top": (windowHeight / 2 - popupHeight / 2) + $(window).scrollTop(),
			"left": windowWidth / 2 - popupWidth / 2
		});
		//only need force for IE6
		$("#storyfilter-background").css({
			"height": windowHeight
		});
		$('#storyfilter-popup-close-button').css({
			"top": ((windowHeight / 2 - popupHeight / 2) + $(window).scrollTop() + 5),
			"left": windowWidth / 2 + popupWidth / 2 - 35
		});
		$("#storyfilter-overlay").css({
			"top": ((windowHeight / 2 - popupHeight / 2) + $(window).scrollTop() + $("#storyfilter-popup").height() - $("#storyfilter-overlay").height() + 2),
			"left": windowWidth / 2 - popupWidth / 2
		});
	},
	preloadImage: function (sSrc) {
		var oImg = document.createElement('img');
		oImg.src = sSrc;
	},
	removePopup: function () {
		$("#storyfilter-overlay").remove();
		$("#storyfilter-popup").remove();
		$('#storyfilter-popup-close-button').remove();
		$("#storyfilter-background").fadeOut('slow', function () {
			$("#storyfilter-background").remove();
			$('body').css({overflow: 'auto'})
		});
		$(window).unbind('resize', storyfilter.centerPopup);
	},
	slideshow_current: 0,
	slideshow_timeout: null,
	slideshow_init: function() {
		if ($('.storyfilter-slideshow > .storyfilter-slideshow-images > .storyfilter-slideshow-image').length) {
			$('.storyfilter-slideshow').show();
		}
		$('.storyfilter-slideshow-image').css({top: 0, left: 0});
		$('.storyfilter-slideshow-image').hide();
		$('.storyfilter-slideshow-image-blurb').hide();
		$('.storyfilter-slideshow-image-text').hide();
		$('.storyfilter-slideshow-image-0').show();
		$('.storyfilter-slideshow-image-0 > .storyfilter-slideshow-image-blurb').show();
		$('.storyfilter-slideshow-image-0 > .storyfilter-slideshow-image-text').show();
		$('.storyfilter-slideshow').each(function (i) {
			storyfilter.slideshow_createControls(this);
			storyfilter.slideshow(this);
		});
	},
	slideshow: function() {
		storyfilter.slideshow_timeout = setTimeout(function () {
			$('.storyfilter-slideshow-image-' + storyfilter.slideshow_current + ' > .storyfilter-slideshow-image-blurb').fadeOut();
			$('.storyfilter-slideshow-image-' + storyfilter.slideshow_current + ' > .storyfilter-slideshow-image-text').fadeOut();
			$('.storyfilter-slideshow-image-' + storyfilter.slideshow_current).fadeOut('slow');
			$('.storyfilter-slideshow-controls table > tbody > tr > td > div.numbers > span').removeClass('selected');
			$(this).children('.storyfilter-slideshow-image-blurb').hide();
			$(this).children('.storyfilter-slideshow-image-text').hide();
			setTimeout(function () {
				$('.storyfilter-slideshow-image-' + storyfilter.slideshow_fetchNext()).fadeIn(null, function () {
					$(this).children('.storyfilter-slideshow-image-' +  storyfilter.slideshow_current + ' > .storyfilter-slideshow-image-blurb').fadeIn('fast');
					$(this).children('.storyfilter-slideshow-image-' +  storyfilter.slideshow_current + ' > .storyfilter-slideshow-image-text').fadeIn('fast');
				});
				$('.storyfilter-slideshow-controls table > tbody > tr > td > div.numbers > span').eq(storyfilter.slideshow_current).addClass('selected');
				storyfilter.slideshow_play();
			}, 500);
		}, 5000);
	},
	slideshow_displaySlide: function (i) {
		$('storyfilter-slideshow-number-0' + i).addClass('selected');
		$('.storyfilter-slideshow-image-' + storyfilter.slideshow_current + ' > .storyfilter-slideshow-image-blurb').fadeOut();
		$('.storyfilter-slideshow-image-' + storyfilter.slideshow_current + ' > .storyfilter-slideshow-image-text').fadeOut();
		$('.storyfilter-slideshow-image-' + storyfilter.slideshow_current).fadeOut('slow');
		$('.storyfilter-slideshow-controls table > tbody > tr > td > div.numbers > span').removeClass('selected');
		storyfilter.slideshow_current = i;
		setTimeout(function () {
			$('.storyfilter-slideshow-image-' + i).fadeIn(null, function () {
				$('.storyfilter-slideshow-image-' + i + ' > .storyfilter-slideshow-image-blurb').fadeIn('fast');
				$('.storyfilter-slideshow-image-' + i + ' > .storyfilter-slideshow-image-text').fadeIn('fast');
			});
			$('.storyfilter-slideshow-controls table > tbody > tr > td > div.numbers > span').eq(i).addClass('selected');
		}, 500);
	},
	slideshow_createControls: function () {
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls table > tbody > tr > td > div.numbers > span').eq(0).addClass('selected');
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls table > tbody > tr > td > div.numbers > span').click(storyfilter.slideshow_selectSlide);
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(0).click(storyfilter.slideshow_play);
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(0).children('img').attr('src', $('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(0).children('img').attr('src').replace('controls-play.png', 'controls-play-selected.png'));
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(1).click(storyfilter.slideshow_pause);
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(2).click(storyfilter.slideshow_previous);
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(3).click(storyfilter.slideshow_next);
	},
	slideshow_fetchNext: function () {
		if (!$('.storyfilter-slideshow-image-' + (storyfilter.slideshow_current + 1)).length) {
			storyfilter.slideshow_current = 0;
		} else {
			storyfilter.slideshow_current++;
		}
		return storyfilter.slideshow_current;
	},
	slideshow_next: function (event) {
		var i = 0;
		if ($('.storyfilter-slideshow-image-' + (storyfilter.slideshow_current + 1)).length) {
			i = storyfilter.slideshow_current + 1;
		}
		storyfilter.slideshow_displaySlide(i);
		storyfilter.slideshow_pause();
	},
	slideshow_pause: function (event) {
		if (event) {
			storyfilter.slideshow_resetControls();
			$(this).addClass('selected');
			$(this).children('img').attr('src', $(this).children('img').attr('src').replace('controls-pause.png', 'controls-pause-selected.png'));
		}
		clearTimeout(storyfilter.slideshow_timeout);
	},
	slideshow_play: function (event) {
		if (event) {
			storyfilter.slideshow_displaySlide(storyfilter.slideshow_current);
			storyfilter.slideshow_resetControls();
			$(this).addClass('selected');
			$(this).children('img').attr('src', $(this).children('img').attr('src').replace('controls-play.png', 'controls-play-selected.png'));
		}
		storyfilter.slideshow_timeout = setTimeout(function () {
			storyfilter.slideshow();
		}, 5000);
	},
	slideshow_previous: function (event) {
		var i = 0;
		if ((storyfilter.slideshow_current - 1) >= 0) {
			i = storyfilter.slideshow_current - 1;
		}
		storyfilter.slideshow_displaySlide(i);
		storyfilter.slideshow_pause();
	},
	slideshow_resetControls: function () {
		$('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').each(function () {
			$(this).removeClass('selected');
		});
		var oPlay = $('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(0).children('img');
		oPlay.attr('src', oPlay.attr('src').replace('controls-play-selected.png', 'controls-play.png'));
		var oPause = $('.storyfilter-slideshow > .storyfilter-slideshow-controls > table > tbody > tr > td.control').eq(1).children('img');
		oPause.attr('src', oPause.attr('src').replace('controls-pause-selected.png', 'controls-pause.png'));
	},
	slideshow_selectSlide: function (event) {
		storyfilter.slideshow_displaySlide(($(this).text() - 1));
		storyfilter.slideshow_pause();
	}
};