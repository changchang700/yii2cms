layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;
    
	//添加
    $(".layui-default-add").click(function(){
        var index = layui.layer.open({
            title : "添加菜单",
            type : 2,
            area: ['400px', '560px'],
            content : ["<?= yii\helpers\Url::to(['create']); ?>",'no'],
            end: function () {
                location.reload();
            }
        });	
    });

	//批量删除
	$(".layui-default-delete-all").click(function(){
		var keys = $("#grid").yiiGridView("getSelectedRows");
        var url = "<?= yii\helpers\Url::to(['delete-all']); ?>";
		if(keys.length!==0){
			layer.confirm('确定删除选中的信息？',{icon:3, title:'提示信息'},function(index){
				var index = layer.msg('删除中，请稍候',{icon: 16,time:false,shade:0.8});
	            setTimeout(function(){
                    $.post(url,{"keys":keys},function(data){
                        if(data.code===200){
                            layer.msg(data.msg);
                            layer.close(index);
                            setTimeout(function(){
                               location.reload();
                            },500);
                        }else{
                            layer.close(index);
                            layer.msg(data.msg);
                        }
                    },"json").fail(function(a,b,c){
						if(a.status==403){
							layer.msg('没有权限');
						}else{
							layer.msg('系统错误');
						}
					});
	            },800);
	        });
		}else{
			layer.msg("请选择需要删除的菜单");
		}
	});

	//全选
	form.on('checkbox(allChoose)', function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		child.each(function(index, item){
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});

	//通过判断文章是否全部选中来确定全选按钮是否选中
	form.on("checkbox(choose)",function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
		if(childChecked.length === child.length){
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
		}else{
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
		}
		form.render('checkbox');
	});
 
	//操作
	$("body").on("click",".layui-default-view",function(){  //查看
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "查看菜单",
            type: 2,
            area: ['400px', '250px'], //宽高
            content : [href, 'no'],
        });	
        return false;
	});
    
	$("body").on("click",".layui-default-update",function(){  //修改
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "修改菜单",
            type : 2,
            area: ['400px', '560px'],
            content : [href,"no"],
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500);
            },
            end: function () {
                location.reload();
            }
        });	
        return false;
	});

	$("body").on("click",".layui-default-delete",function(){  //删除
        var href = $(this).attr("href");
		layer.confirm('确定删除此菜单吗？',{icon:3, title:'提示信息'},function(index){
            $.post(href,function(data){
                if(data.code===200){
                    layer.msg(data.msg);
                    layer.close(index);
                    setTimeout(function(){
                       location.reload();
                    },500);
                }else{
                    layer.close(index);
                    layer.msg(data.msg);
                }
            },"json").fail(function(a,b,c){
                if(a.status==403){
                    layer.msg('没有权限');
                }else{
                    layer.msg('系统错误');
                }
            });
		});
        return false;
	});
});
