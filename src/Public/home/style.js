;
!function(){
	$(document).on('click','.wang-no-style img',function(){
		// console.log($(this).data('id'))
		bigShow(this);
	});
	function bigShow(img) {
		$("body").css({overflow:"hidden"});
		$(".bigPicBox").removeClass("hidden");
		$(".close-btn").on('click',function(e){
			bigHidden();
		});
		$(".imgBox img").attr("src",img.src);
		var ImgObj=new Image();
		ImgObj.src = img.src;
		var bigImg = $(".imgBox img")[0];
		if(ImgObj.width < (screen.width*0.9)/2){
			bigImg.style.width = ImgObj.width+"px";
		}else {
			bigImg.style.width = (screen.width*0.9)/2+"px";
		} 

	}
	function bigHidden() {
		$(".bigPicBox").addClass("hidden");
		$("body").css({overflow:""});
	}
}();