layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;
 
//  查看用户操作
	$("body").on("click",".layui-default-view",function(){
        var href = $(this).attr("href");
        console.log(href);
        var index = layui.layer.open({
            title : "查看日志",
            type: 2,
            area: ['800px', '600px'],
            content : [href, 'no']
        });	
        return false;
	});
});
