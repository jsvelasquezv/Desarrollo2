$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$(".dropdown-button").dropdown();
	$('.modal-trigger').leanModal({
      dismissible: true // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() { alert('Ready'); }, // Callback for Modal open
      complete: function() { alert('Closed'); } // Callback for Modal close
    }
  );
});
