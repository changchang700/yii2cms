layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;
 
	//操作
	$("body").on("click",".layui-default-view",function(){  //查看
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "分配权限",
            type : 2,
            area: ['100%', '100%'], //宽高
            content : href,
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500);
            }
        });	
        layui.layer.full(index);//全屏当前弹出层
        return false;
	});
});
