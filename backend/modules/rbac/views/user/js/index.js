layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;

//	添加系统用户
    $(".layui-default-add").click(function(){
        var index = layui.layer.open({
            title : "添加系统用户",
            type : 2,
            area: ['400px', '520px'],
            content : ["<?= yii\helpers\Url::to(['signup']); ?>",'no'],
            end: function () {
                location.reload();
            }
        });	
    });
//  全选
	form.on('checkbox(allChoose)', function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		child.each(function(index, item){
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});

//  通过判断文章是否全部选中来确定全选按钮是否选中
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
 
//  查看用户操作
	$("body").on("click",".layui-default-view",function(){
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "查看用户",
            type: 2,
            area: ['400px', '380px'],
            content : [href, 'no']
        });	
        return false;
	});
//  启用用户操作
	$("body").on("click",".layui-default-active",function(){  
        var href = $(this).attr("href");
		layer.confirm('确定启用此用户吗？',{icon:3, title:'提示信息'},function(index){
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
//  禁用用户操作
	$("body").on("click",".layui-default-inactive",function(){
        var href = $(this).attr("href");
		layer.confirm('确定禁用此用户吗？',{icon:3, title:'提示信息'},function(index){
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
//  修改用户操作
	$("body").on("click",".layui-default-update",function(){
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "修改用户",
            type : 2,
            area:['400px', '520px'],
            content :[href,"no"],
            end: function () {
                location.reload();
            }
        });	
        return false;
	});    
//  删除用户操作
	$("body").on("click",".layui-default-delete",function(){
        var href = $(this).attr("href");
		layer.confirm('确定删除此用户吗？',{icon:3, title:'提示信息'},function(index){
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
