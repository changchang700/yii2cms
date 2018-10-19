layui.config({
	base : "/js/"
}).use(['form','layer'],function(){
	layer = layui.layer;
    layer.alert('账号:demo 密码:123456', {icon: 6});
});
