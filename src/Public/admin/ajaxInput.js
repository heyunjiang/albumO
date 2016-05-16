;
!function(){
    //ac add
    $("#add_ac_submit").on('click',function(){
        if($("#add_ac_name").val() == ''){
            sweetAlert("请填写名称");
            return false;
        }
        $.post("/albumO/src/Admin/Admin/addCtr",{
            ac_name:$("#add_ac_name").val(),
            ac_description:$("#add_ac_description").val(),
            type:"add_ac"
        },function(data,status){
            if(data != 0){
                sweetAlert({title: "添加成功"},function(){window.location.href = "/albumO/src/Admin/Admin/album";})
            }else{
                sweetAlert("添加失败");
            }
        });
    });
    //ask for pic information
    $("#pic-choose-album-change").on('change',function(){
        $("#pic-table-info").empty();
        var ac_id = $("#pic-choose-album-change").val();
        if(ac_id == -1){
            return ;
        }
        $.get("/albumO/src/Admin/Admin/getImgInfo",{
            ac_id: ac_id
        },function(data,status){
            if(data.length > 0){
                var content = ""
                for(var i=0;i<data.length;i++){
                    content+= "<tr>";
                    content+="<td>"+(i+1)+"</td>";
                    content+="<td><img src='/albumO/src/"+data[i]['img_url']+"' style='height:40px;width:40px'></td>";
                    content+="<td>"+data[i]['img_name']+"</td>";
                    content+="<td>"+data[i]['img_description']+"</td>";
                    content+="<td>"+data[i]['img_click']+"</td>";
                    content+="<td>"+data[i]['img_main']+"</td>";
                    content+="<td>"+data[i]['img_add_time']+"</td>";
                    content+="<td><a href='/albumO/src/Admin/Admin/picUp?img_id="+data[i]['img_id']+"' class='btn btn-success'>编辑</a>&nbsp;<a href='#' class='pic_delete btn btn-danger' data-img_id='"+data[i]['img_id']+"'>删除</a>&nbsp;<a href='#' class='pic_main btn btn-warning' data-img_id='"+data[i]['img_id']+"' data-ac_id='"+data[i]['ac_id']+"'>设为封面</a></td>";
                    content+="</tr>"
                }
                $("#pic-table-info").append(content)
            }
        });
    });
    //update albumcategory
    $("#up_ac_submit").on('click',function(){
        $.post("/albumO/src/Admin/Admin/up",{
            ac_id: $("#up_ac_id").val(),
            ac_name:$("#up_ac_name").val(),
            ac_description:$("#up_ac_description").val(),
            type:"up_ac"
        },function(data,status){
            if(data != 0){
                sweetAlert({title: "添加成功"},function(){window.location.href = "/albumO/src/Admin/Admin/album";})
            }else{
                sweetAlert("添加失败");
            }
        });
    });
    $(document).on("click",".ac_delete",function(){
        var ac_id = $(this).data("ac_id");
        $.get("/albumO/src/Admin/Admin/del",{
            ac_id: ac_id,
            type: 'del_ac'
        },function(data,status){
            if(data != 0){
                sweetAlert({title: "删除成功"},function(){window.location.href = "/albumO/src/Admin/Admin/album";})
            }else{
                sweetAlert("删除失败");
            }
        });
    });
    $(document).on("click",".pic_delete",function(){
        var img_id = $(this).data("img_id");
        $.get("/albumO/src/Admin/Admin/del",{
            img_id: img_id,
            type: 'del_img'
        },function(data,status){
            if(data != 0){
                sweetAlert({title: "删除成功"},function(){window.location.href = "/albumO/src/Admin/Admin/pic";})
            }else{
                sweetAlert("删除失败");
            }
        });
    });
    $(document).on("click",".user_delete",function(){
        var user_id = $(this).data("user_id");
        $.get("/albumO/src/Admin/Admin/del",{
            user_id: user_id,
            type: 'del_user'
        },function(data,status){
            if(data != 0){
                sweetAlert({title: "删除成功"},function(){window.location.href = "/albumO/src/Admin/Admin/user";})
            }else{
                sweetAlert("删除失败");
            }
        });
    });
    //set this pic to main
    $(document).on("click",".pic_main",function(){
        var img_id = $(this).data("img_id");
        var ac_id = $(this).data("ac_id");
        console.log(img_id);
        $.get("/albumO/src/Admin/Admin/pic_main",{
            img_id: img_id,
            ac_id: ac_id
        },function(data,status){
            if(data == 1){
                sweetAlert({title: "设置成功"},function(){window.location.href = "/albumO/src/Admin/Admin/pic";})
            }else{
                sweetAlert("设置失败");
            }
        });
    });
}();