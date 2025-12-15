$(document).ready(function () {
	$('.main-menu a.has-drop').click(function (e) {
		$('.main-menu a.has-drop').next('ul.menu').fadeOut(200);
		$('.main-menu a.has-drop').removeClass('selected');
		e.stopPropagation();
		revealHeaderMenu(e.currentTarget);
		return false;
	});
	$('.main-menu a.has-drop ul').click(function (e) {
		e.stopPropagation();
	});
});
function revealHeaderMenu (oParent) {
	var oDrop = $(oParent).next('ul.menu');
	oDrop.css('left', $(oParent).position().left - oDrop.outerWidth() + $(oParent).outerWidth() + 7 + 'px');
	oDrop.css('top', $(oParent).position().top + $(oParent).outerHeight() - 3 + 'px');
	oDrop.fadeIn(200);
	$(oParent).addClass('selected');
	$(document).bind('click', hideHeaderMenu); 
	return false;
}
function hideHeaderMenu (e) {
	$('.main-menu a.has-drop').next('ul.menu').fadeOut(200);
	$('.main-menu a.has-drop').removeClass('selected');
}