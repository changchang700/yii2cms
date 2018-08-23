layui.config({
	base : "js/"
}).use(['layer','form','jquery'],function(){
    var form = layui.form,$form = $("#export-form"), $export = $("#export"),layer = parent.layer === undefined ? layui.layer : parent.layer;

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

    //优化表
    $(".table_optimize").click(function(){
        var href = $(this).attr("href");
        $.post(href,function(data){
            if(data.code===200){
                layer.msg(data.msg);
                layer.close(index);
                setTimeout(function(){
                   location.reload();
                },500);
            }else{
                layer.msg(data.msg);
            }
        },"json");
        return false;
    });
    //修复表
    $(".table_repair").click(function(){
        var href = $(this).attr("href");
        $.post(href,function(data){
            if(data.code===200){
                layer.msg(data.msg);
                layer.close(index);
                setTimeout(function(){
                   location.reload();
                },500);
            }else{
                layer.msg(data.msg);
            }
        },"json");
        return false;
    });
    //备份表
    $export.click(function(){
        if ($('#grid').yiiGridView('getSelectedRows').length <= 0) {
            layer.msg('请选择要备份的表');
            return false;
        }
        $export.parent().children().addClass("disabled");
        $export.html("正在发送备份请求...");
        var that = this;
        $.post(
            $form.attr("action"),
            $form.serialize(),
            function(data){
                if(data.status){
                    tables = data.tables;
                    $export.html(data.info + "开始备份，请不要关闭本页面！");
                    backup.call(that, data.tab);
                    window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！";};
                } else {
                    layer.msg(data.info);
                    $export.parent().children().removeClass("disabled");
                    $export.html("立即备份");
                    setTimeout(function(){
                        $(that).removeClass('disabled').prop('disabled',false);
                    },1500);
                }
            },
            "json"
        );
        return false;
    });

    function backup(tab, status){
        $.post("<?= \yii\helpers\Url::to(['start'])?>", tab, function(data){
            console.log(data.name);
            if($.isPlainObject(data.tab)){
                if(!data.info || data.info=='备份完成'){
                    data.info ='<i class="layui-icon" style="font-size: 14px; color: green;">&#xe618;</i>';
                }
                if(data.info=='正在备份...(90%)'){
                    data.info ='<i class="layui-icon" style="font-size: 14px; color: green;">&#xe618;</i>';
                }
                $(".tb_process_"+data.name).html(data.info);
            }
            if(data.status){
                if(data.end){
                    $export.parent().children().removeClass("disabled");
                    $export.html("备份完成，点击重新备份");
                    window.onbeforeunload = function(){ return null;};
                    return;
                }
                
                backup(data.tab, tab.id != data.tab.id);
            } else {
                layer.msg(data.info);
                $export.parent().children().removeClass("disabled");
                $export.html("立即备份");
                setTimeout(function(){
                    $(this).removeClass('disabled').prop('disabled',false);
                },1500);
            }
            }, "json");
    }
});