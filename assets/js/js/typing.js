var clock;
var start;

$(document).ready(function() {
	clock = $('.clock').FlipClock({
        clockFace: 'MinuteCounter',
        autoStart: false,
    });
});    

$('#start').click(function(e) {
	if($(this).text() == 'RESTART TYPING'){
		location.reload();
	}else{
		$("#type").prop('disabled', false);
    	$("#type").focus();
    	clock.start();
    	
    	start = new Date().getTime();

    	$('#start').text('RESTART TYPING');
    	$('#start').removeClass('btn-success');
    	$('#start').addClass('btn-warning');
	}
	
});


//Space and final calculations
$("#type").keyup(function( event ) {
	
	var writtenText = $('#type').val();
	var lastTypedWord = writtenText[writtenText.length -1]; 

  	if(lastTypedWord == ' '){
		  	//Remove current 
		  	var currentType = $('#type').val();
		  	currentType = currentType.substring(0, currentType.length - 1)
		  	
		  	//On space key skip the current one 
	  		var nextActive = 0;
	  		$('.texttowrite').each(function(){
	  			
	  			if(nextActive == 1){
	  				$(this).addClass('highlight');
	  				return false;
	  			}

	  			if($(this).hasClass('highlight')){
	  				$(this).addClass('done');
	  				$(this).removeClass('highlight');
	  				nextActive = 1;

	  				console.log($(this).text());
	  				console.log(currentType);

	  				if($(this).text() == currentType){
	  					$(this).addClass('correct');
	  				}else{
	  					$(this).addClass('wrong');
	  				}
	  			}
	  		});

	  		//For Help Text
	  		var nextActiveHelp = 0;
	  		$('.help-text').each(function(){
	  			
	  			if(nextActiveHelp == 1){
	  				$(this).addClass('highlight-help-show');
	  				return false;
	  			}

	  			if($(this).hasClass('highlight-help-show')){
	  				$(this).removeClass('highlight-help-show');
	  				nextActiveHelp = 1;
	  			}

	  		});

	  		$('#type').val('');
		  }

  //If done 
		if($('.highlight').length == 0){

			//Remove View Type class 
			$('.typing-section').removeClass('switch_display');
			$('.typing-section').addClass('switch_finish');

			//Hide Help Section
			$('#helpSection').hide();

			//STOP CLOCK
			clock.stop();
			$("#type").prop('disabled', true);

			//Accuracy Calculation 
			var totalWords = $('.texttowrite').length;
			var correctWords = $('.correct').length;

			var accuracy = 100 * correctWords / totalWords;
			accuracy = Math.round(accuracy * 100) / 100;

			var end = new Date().getTime();
		var time = (end - start) / 1000;

		var wordperMin = 1 * totalWords / (time / 60);
		wordperMin = Math.round(wordperMin * 100) / 100;

		var timeInSeconds = clock.getTime().time;
		var timeCompleted = fancyTimeFormat(clock.getTime().time - 1);

		//
		var accuracyClass = 'label-warning';
		if(accuracy < 50){
			accuracyClass = 'label-danger';
		}
		if(accuracy > 70){
			accuracyClass = 'label-success';
		}

		var speedClass = 'label-warning';
		if(wordperMin > 30){
			speedClass = 'label-success';
		}
		if(wordperMin < 10){
			speedClass = 'label-danger';
		}

		$('#accuracy').text(accuracy+'%');
		$('#accuracy').addClass(accuracyClass);

		$('#speed').addClass(speedClass);
		$('#speed').text(wordperMin);


		$('#time_result').addClass('label-warning');
		$('#time_result').text(timeCompleted);

		//Save Data to Database
		onComplete(accuracy, wordperMin, timeInSeconds);
		

		}

});

$("#type").keypress(function( event ) {
  	var writtenText = $('#type').val();
	var lastTypedWord = writtenText[writtenText.length -1]; 

	console.log(lastTypedWord);
  if ( event.which == 13 ) {
     event.preventDefault();
  }

  if(lastTypedWord == ' '){
  	//Remove current 
  	var currentType = $('#type').val();
  	
  	//On space key skip the current one 
		var nextActive = 0;
		$('.texttowrite').each(function(){
			
			if(nextActive == 1){
				$(this).addClass('highlight');
				return false;
			}

			if($(this).hasClass('highlight')){
				$(this).addClass('done');
				$(this).removeClass('highlight');
				nextActive = 1;

				console.log($(this).text());
				console.log(currentType);

				if($(this).text() == currentType){
					$(this).addClass('correct');
				}else{
					$(this).addClass('wrong');
				}
			}

		});

  }

});


function fancyTimeFormat(time)
{   
    // Hours, minutes and seconds
    var hrs = ~~(time / 3600);
    var mins = ~~((time % 3600) / 60);
    var secs = time % 60;

    // Output like "1:01" or "4:03:59" or "123:03:59"
    var ret = "";

    if (hrs > 0) {
        ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
    }

    ret += "" + mins + ":" + (secs < 10 ? "0" : "");
    ret += "" + secs;
    return ret;
}
