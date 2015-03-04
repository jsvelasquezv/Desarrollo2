$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$(".dropdown-button").dropdown();
	$('.modal-trigger').leanModal();
	$('select').material_select();
	$('.tooltipped').tooltip({delay: 50});
});

$("#edit").on('click', function() {
   $('#modal1').openModal();
});

