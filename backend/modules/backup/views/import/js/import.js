layui.config({
	base : "js/"
}).use(['layer','jquery'],function(){
    var form = layui.form,$form = $("#export-form"), $export = $("#export"),layer = parent.layer === undefined ? layui.layer : parent.layer;
    
	$("body").on("click",".layui-default-delete",function(){  //删除
        var href = $(this).attr("href");
		layer.confirm('确定删除此备份吗？',{icon:3, title:'提示信息'},function(index){
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
            },"json");
		});
        return false;
	});
    
    $(".db-import").click(function(){
        var self = this, status = ".";
        $.post(self.href, success, "json");
        window.onbeforeunload = function(){ return "正在还原数据库，请不要关闭！"; };
        return false;

        function success(data){
            console.log(data);
            if(data.status){
                if(data.gz){
                    data.info += status;
                    if(status.length === 5){
                        status = ".";
                    } else {
                        status += ".";
                    }
                }
                if(data.info=='还原完成！'){
                    data.info ='<i class="layui-icon" style="font-size: 14px; color: green;">&#xe618;</i>';
                }                
                $(self).parent().prev().html(data.info);
                if(data.part){
                    $.post("<?= \yii\helpers\Url::to(['start'])?>",
                        {"part" : data.part, "start" : data.start},
                        success,
                        "json"
                    );
                }  else {
                    window.onbeforeunload = function(){ return null;};
                }
            } else {
                $.modal.error(data.info);
            }
        }
    });
});