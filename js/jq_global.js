// JavaScript Document


//jquery


$(document).ready(function(){

	
		var regemail = $('input#register-email').val();
		var regname = $('input#register-name').val();
		var reglastname = $('input#register-lastname').val();
		var regpass = $('input#register-password').val();
		var regreppass = $('input#register-repeat-password').val();
							
			
  $("#register-password").blur(function(){
										  
	if($(this).val().length < 6) {
		
		$('#less-six:not(:has(div))').append('<div class="errors">Password must be at least <strong>6</strong> characters lenght</div>'); //Asking if the element does exists and creating it if dont
		$(this).val('');
		$(this).focus();
	
		} else {
		$('#less-six').empty();
		$('#dont-match').empty();
	}
	 });
  
 
   $("#register-repeat-password").blur(function(){
										  
	if($(this).val() != $('input#register-password').val()) {
		
		$('#dont-match:not(:has(div))').append('<div class="errors">Passwords don\'t match</div>'); //Asking if the element does exists and creating it if dont
		$(this).val('');
	    $('input#register-password').val('');
		$('input#register-password').focus();
	
		} else {
		$('#dont-match').empty();
		$('#less-six').empty();
	}
	 });
  
	 
	 
function notallowed() {
    if (isNaN($(this).val())) {
        $('#non-cero').empty();
        $('#non-positive').empty();
        //alert('a number');
        $('#non-number:not(:has(div))').append('<div class="errors"> Just numbers allowed </div>'); //Asking if the element does exists and creating it if dont
        $(this).val('');
        $(this).focus();

    } else {
        $('#non-number').empty();


        if ($(this).val() < 0) {
            $('#non-number').empty();
            $('#non-cero').empty();

            $('#non-positive:not(:has(div))').append('<div class="errors"> Negative values are not allowed </div>'); //Asking if the element does exists and creating it if dont
            $(this).val('');
            $(this).focus();
        } else {

            $('#non-positive').empty();


            if ($(this).val() == 0) {
                $('#non-positive').empty();
                $('#non-number').empty();

                $('#non-cero:not(:has(div))').append('<div class="errors"> This value can not be cero </div>'); //Asking if the element does exists and creating it if dont
                $(this).val('');
                $(this).focus();

            } else {
                $('#non-cero').empty();

            }

        }

    }
}
	

	//SET not allowed
	$("#qua-item").blur(notallowed);
	$("#cos-it").blur(notallowed);
	$("#pri-it").blur(notallowed);
	 $("#did-qua").blur(notallowed);

$('#removetext').click(function(){
								
$("br#br-feat").remove(); 
$("input#input-feat:last").remove();
$("input#input-feat:last").focus();

});


//Cost less than price
	 
	  $("#up-item-submit").mouseover(function(){
								  
	if($("#pri-it").val() < $("#cos-it").val()) {
                $('#non-positive').empty();
                $('#non-number').empty();
                $('#non-cero').empty();
				
	 $('#cos-menor-pri:not(:has(div))').append('<div class="errors"> El costo no puede ser mayor que el precio </div>'); //Asking if the element does exists and creating it if dont
	
		 } else {
		 $('#cos-menor-pri').empty();
		 }
	 });  

//Check and uncheck post values

//var atLeastOneIsChecked = $('#checkArray :checkbox:checked').length > 0;



//MENU CATEGORIES

// //Occations
// $("#occ-det").hide();
// $("#col-det").hide();
// $("#pri-det").hide();

// $("#occ").mouseover(function () {
    // $("#occ-det").slideDown('slow');
// });

// $("#occ-det").mouseleave(function () {
    // $("#occ-det").slideUp('slow');
	// $("#col-det").slideUp('slow');
	// $("#pri-det").slideUp('slow');
// });


// //Colors
// $("#col").mouseover(function () {
    // $("#col-det").slideDown('slow');
// });

// $("#col-det").mouseleave(function () {
    // $("#occ-det").slideUp('slow');
	// $("#col-det").slideUp('slow');
	// $("#pri-det").slideUp('slow');
// });


// //Prices
// $("#pri").mouseover(function () {
    // $("#pri-det").slideDown('slow');
// });

// $("#pri-det").mouseleave(function () {
    // $("#occ-det").slideUp('slow');
	// $("#col-det").slideUp('slow');
	// $("#pri-det").slideUp('slow');
// });
 
//END MENU CATEGORIES

$(".tes_ico").css({ opacity: 0.5 });

$( ".test_hover" ).mouseover(function() {
	$(".tes_ico").css({ opacity: 1 });
});

$( ".test_hover" ).mouseleave(function() {
  $(".tes_ico").css({ opacity: 0.5 });
});


$( ".test_mes_hover" ).mouseover(function() {
	$(".tes_ico").css({ opacity: 1 });
});

$( ".test_mes_hover" ).mouseleave(function() {
  $(".tes_ico").css({ opacity: 0.5 });
});

   
}); //Document.ready ends

/* Login */

$( "#login" ).mouseover(function() {
  $( "#loginForm" ).slideDown( "slow" );
});

$( "#login" ).mouseleave(function() {
  $( "#loginForm" ).slideUp(  "slow" );
});


/* End login */

  
 var showWidth = 1;
  if (showWidth == 1) {
	  $(document).ready(function() {
		  $(window).resize(function() {
		  var width = $(window).width();
		  document.getElementById('output_width').innerHTML="Window width:"+width.toString();
		  
	  });
  });
  
  /* filter by */
var fclicked = true;

  $("#filterByDiv").click(function () {
        if (fclicked == true) {
			 $( "#accordionDiv" ).slideDown( "slow" );
			 $('.filterBy').css('background-image','url(../images/icons/Arrow/small_arrow_light.png)');
            fclicked = false;
           return;
        }
        else {
            $( "#accordionDiv" ).slideUp( "slow" );
			 $('.filterBy').css('background-image','url(../images/icons/Arrow/small_arrow.png)');
			fclicked = true;
        }
    });
	
	// Size
	var sclicked = true;

  $("#Psize").click(function () {
        if (sclicked == true) {
			 $( "#Csize" ).slideDown( "slow" );
            sclicked = false;
           return;
        }
        else {
            $( "#Csize" ).slideUp( "slow" );
			sclicked = true;
        }
    });
	
	
	// Color
	var cclicked = true;

  $("#Pcolor").click(function () {
        if (cclicked == true) {
			 $( "#Ccolor" ).slideDown( "slow" );
            cclicked = false;
           return;
        }
        else {
            $( "#Ccolor" ).slideUp( "slow" );
			cclicked = true;
        }
    });
	
	// Price
	var pclicked = true;

  $("#Pprice").click(function () {
        if (pclicked == true) {
			 $( "#Cprice" ).slideDown( "slow" );
            pclicked = false;
           return;
        }
        else {
            $( "#Cprice" ).slideUp( "slow" );
			pclicked = true;
        }
    });
	

  	
  /* End filter by */

  
  }
  
 





