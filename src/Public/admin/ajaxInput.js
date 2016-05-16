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
                    content+="<td><a href='/albumO/src/Admin/Admin/picUp?img_id="+data[i]['img_id']+"'>编辑</a><a href='#'>删除</a></td>";
                    content+="</tr>"
                }
                $("#pic-table-info").append(content)
            }
        });
    });
}();