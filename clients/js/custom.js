$(document).on('click','ul#mymenu>li>a',function()
	{
		$(this).siblings('#down-menu').slideToggle();
		$(this).closest('li').siblings('li').find('#down-menu').slideUp();
	})


$(document).on('click','ul#frmdata>li>a',function()
	{
		$(this).siblings('#frmlist').show();
		$(this).closest('li').siblings('li').find('#frmlist').hide();
	})

$(document).ready(function(){
  $("#btn").click(function(){
    $(".disign").fadeOut();
  });
});


$('#frmdata').on('click','li',function(){
	$('.topmenu li.active').removeClass('active');
	$(this).addClass('active');
})

