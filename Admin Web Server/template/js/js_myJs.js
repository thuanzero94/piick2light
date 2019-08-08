$(document).ready(function(){
	console.log("OKE");
	$(".btn_signIn").click(function(){
		alert("Not public ^_^ !!!");
	});

	if($('.cbUsingSlot').prop('checked')){
      $('.slot-3-4').css('display', 'block');
    }else{
      $('.slot-3-4').css('display', 'none');
    }

     $('.cbUsingSlot').click(function(){
        var checked = $('.cbUsingSlot').prop('checked');
        if(checked==true){
          $('.slot-3-4').css('display', 'block');
        }else{
          $('.slot-3-4').css('display', 'none');
        }
    });
});