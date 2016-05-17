;
!function(){
	$(document).on('click','.wang-no-style img',function(){
		// console.log($(this).data('id'))
		bigShow(this);
		sendMsg($(this).data('id'));
		// imgClick($(this).data('id'));
		clickInit($(this).data('id'));
	});
	//big show
	function bigShow(img) {
		$("body").css({overflow:"hidden"});
		$(".bigPicBox").removeClass("hidden");
		$(".bigPicBox").css("top",document.body.scrollTop);

		$(".imgBox img").attr("src",img.src);
		var ImgObj=new Image();
		ImgObj.src = img.src;
		var bigImg = $(".imgBox img")[0];
		if(ImgObj.width < (screen.width*0.9)/2){
			bigImg.style.width = ImgObj.width+"px";
		}else {
			bigImg.style.width = (screen.width*0.9)/2+"px";
		}

		//get pic info
		$(".imgCommentList").empty();
		$.get("/albumO/src/Home/Index/getPicInfor",{
            img_id: $(img).data('id')
        },function(data,status){
            if(data.length >0){
            	var md = data[0];
            	$(".imgUser img").attr("src","/albumO/src"+md['headurl']);
            	$(".imgUser .user-name").text(md['nickname']);
            	$(".imgUser .time").text(md['img_add_time']);
            	$(".imgdis").text(md['img_description']);
            	$(".love_count").text(md['img_click']);
            	//get message list
            	$.get("/albumO/src/Home/Index/getMsgInfor",{
            		img_id: $(img).data('id')
            	},function(data,status){
            		if(data.length >0){
            			var message_content = '';
            			for (var i = 0; i < data.length; i++) {
            				message_content += '<div class="commentList">';
            				message_content += '<img src="/albumO/src'+data[i]["headurl"]+'"><span class="user-name">'+data[i]["nickname"]+'</span>';
            				message_content += '<p class="commentText">'+data[i]["m_content"]+'</p>';
            				message_content += '</div>';
            			}
            			$(".imgCommentList").append(message_content);

            		}
            	});
            }
        });
		$(".close-btn").on('click',function(e){
			bigHidden();
		});
	}
	//big hidden
	function bigHidden() {
		$(".bigPicBox").addClass("hidden");
		$("body").css({overflow:""});
	}
	//send message
	function sendMsg(img_id){
		$(document).off('click','.imgComment .commit');
		$(document).on('click','.imgComment .commit',function(){
			var msg = $("#imgComment-input").val();
			if(msg == ""){
				sweetAlert("评论不能为空");
				return false;
			}
			$.post("/albumO/src/Home/Index/addMsg",{
				img_id: img_id,
				m_content: msg
			},function(data,status){
				if(data != 0 ){
					sweetAlert("评论成功");
					var addContent = '';
					addContent += '<div class="commentList">';
					addContent += '<img src="/albumO/src'+data["headurl"]+'"><span class="user-name">'+data["nickname"]+'</span>';
					addContent += '<p class="commentText">'+msg+'</p>';
					addContent += '</div>';
					$(".imgCommentList").append(addContent);
				}else{
					sweetAlert("评论失败");
					return ;
				}
			});
			$("#imgComment-input").val("");//empty
		});
	}
	//add click
	function imgClick(img_id){
		$(".imgclick .click").off('click');
		$(".imgclick .click").on('click',function(){
			$.post("/albumO/src/Home/Index/addClick",{
				img_id: img_id
			},function(data,status){
				if(data != 0 ){
					sweetAlert("点赞成功");
					$(".love_count").text(parseInt($(".love_count").text())+1);
					localStorage.setItem("img_click_"+img_id,"1");
					clickDisable();
				}else{
					sweetAlert("点赞失败");
					return ;
				}
			});
		});
	}
	function clickInit(img_id){
		if(localStorage['img_click_'+img_id]&&localStorage['img_click_'+img_id]==1){
			clickDisable();
		}else{
			clickAble(img_id);
		}
	}
	function clickDisable(){
		$(".imgclick .click").removeClass("glyphicon-heart-empty");
		$(".imgclick .click").addClass("glyphicon-heart");
		$(".imgclick .click").off('click');
		$(".imgclick .click").on('click',function(){
			sweetAlert("您已点过赞，请勿重复点赞");
		});
	}
	function clickAble(img_id){
		imgClick(img_id);
		$(".imgclick .click").removeClass("glyphicon-heart");
		$(".imgclick .click").addClass("glyphicon-heart-empty");
	}
}();