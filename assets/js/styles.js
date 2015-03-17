$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$(".dropdown-button").dropdown({
		constrain_width: false,
		hover: false,
		belowOrigin: true
	});
	$('.modal-trigger').leanModal();
	$('select').material_select();
	$('.tooltipped').tooltip({delay: 50});
});

$("#edit").on('click', function() {
	$('#modal1').openModal();
});

