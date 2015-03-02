$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$(".dropdown-button").dropdown();
	$('.modal-trigger').leanModal();
	$('select').material_select();
});

$("#edit").on('click', function() {
   $('#modal1').openModal();
});
