
$(document).ready(function() {

	// check boxes
	$('#selectAllBoxes').click(function(event) {
		if (this.checked) {
			$('.checkBoxes').each(function() {
				this.checked = true;
			});
			
		}else {
			$('.checkBoxes').each(function() {
				this.checked = false;
			});
		}
	});

	// LOADER SCREEN
	var div_box = "<div id='load-screen'><div id='loading'><span></span></div></div>";
	$("body").prepend(div_box);

	$('#load-screen').delay(1500).fadeOut(600, function() {
		$(this).remove();
	});


	// auto refresh users online
	function loadUsersOnline(){
		$.get("inc/functions.php?OnlineUsers=result", function(data) {
			$(".usersonline").text(data);
		});
	}

	setInterval(function() {
		loadUsersOnline();
	}, 500);

	

});