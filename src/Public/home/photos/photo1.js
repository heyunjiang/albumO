 

var Deg=360/($("#wang-wrp img").size());

$(document).ready(function(){
 var play_img=function(){
  $(".wang-play-style>img").each(function(index){
   $(this).css({"transform":"rotateY("+Deg*index+"deg) translateZ(350px) ",
     "transition":($('.wang-play-style>img').length-index)*0.1+'s'
               }).attr("ondragstart","return false")//添加ondragstart="return false"使图片不可拖动
 });
  var roY=0,roX=-10,xN,yN,x_,y_;
               $(document).mousedown(function(ev){//当鼠标指针移动到元素上方，并按下鼠标按键时，会发生 mousedown 事件。
                  //clearInterval(timer);
                  ev.preventDefault();
                  x_=ev.clientX;
                  y_=ev.clientY;
               $(this).on("mousemove",function(ev){//on()函数用于为指定元素的一个或多个事件绑定事件处理函数。//此外，该函数可以为同一元素、同一事件类型绑定多个事件处理函数
                 ev.preventDefault();
                 x=ev.clientX;
                 y=ev.clientY;
                     //wconsole.log("x");
                     xN=x-x_;
                     yN=y-y_;
                     roY=roY+xN*0.2;
                     roX=roX-yN*0.2;
                     
                     $(".wang-play-style").css(
                      "transform","perspective(800px) rotateX("+roX+"deg)  rotateY("+roY+"deg)"
                      );
                     //$("body").append('<div style="width:0;height:0;position:absolute;top:'+y+'px;left:'+x+'px;"></div>')
                     x_=ev.clientX;
                     y_=ev.clientY;
                   })
               }).mouseup(function(){//与 click 事件不同，mouseup 事件仅需要放松按钮
                  $(this).off("mousemove");//要删除通过on()绑定的事件，请使用off()函数。
                  var timer=setInterval(function(){
                   xN*=0.95;
                   yN*=0.95;
                   if(Math.abs(xN)<0.5&&Math.abs(yN)<0.5){
                    clearInterval(timer);
                  }
                  roY=roY+xN*0.2;
                  roX=roX-yN*0.2;
                  $(".wang-play-style").css(
                    "transform","perspective(800px) rotateX("+roX+"deg)  rotateY("+roY+"deg)"
                    );
                },30);
                });
             }

                         //绑定鼠标点击事件
                         var change_paly1=function(){
                           $("#wang-wrp").removeClass("wang-no-style").addClass ("wang-play-style");
                           $("#wang-wrp>img").addClass("wang-img-style");                             
                           $("#wang-btn").html("falls");}

                           var change_paly2=function(){
                            $("#wang-wrp").removeClass("wang-play-style").addClass ("wang-no-style");                             
                            $("#wang-wrp>img").removeClass("wang-img-style");
                            $("#wang-btn").html("play");}



                            $("#wang-btn").on("click",function(ev){
                             ev.preventDefault();
                             var class_Name=$("#wang-wrp").attr('class');

                             if (class_Name=="wang-no-style") {
                               $("#wang-wrp").removeAttr("style");
                               $("#wang-wrp>img").removeAttr("style");

                               change_paly1();
                               play_img();

                             }
                             if(class_Name=="wang-play-style"){
                                window.location.reload();
                             }
                           })
                          });


