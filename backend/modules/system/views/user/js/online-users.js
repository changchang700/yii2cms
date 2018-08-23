layui.config({
	base : "js/"
}).use(['layer','jquery'],function(){
	var layer = parent.layer === undefined ? layui.layer : parent.layer;
		$ = layui.jquery;
});

$(document).ready(function () {	
	connect();
	function connect() {
	   ws = new WebSocket("wss://socket.alilinet.com:9999");
	   ws.onopen = onopen;
	   ws.onmessage = onmessage; 
	   ws.onclose = function() {
		  console.log("连接关闭，定时重连");
		  connect();
	   };
	   ws.onerror = function() {
		  console.log("连接出错");
	   };
	}
	function onopen(){
		var login_data = '{"action":"getuids"}';
		ws.send(login_data);
	}
    
    function pushdata(group,msg){
		msg=msg.replace(/\r\n/g,"<br>"); 
        msg=msg.replace(/\n/g,"<br>");
        var push_data = '{"action":"push","group":"'+group+'","msg":"'+msg+'"}';
        return ws.send(push_data);
    }
    
	function onmessage(e){
        var msg = e.data;
        var msg_obj = eval('(' + msg + ')');
        var action = msg_obj.action;
        
        switch(action){
            case "online":
                $('#online_box').html(msg_obj.msg);
                break;
            case "getuids":
                for (var key in msg_obj.msg) {  
                    var html = '';
                    html = '<tr id="uid_'+key+'"><td style="text-align: center;">'+key+'</td><td style="text-align: center;" id="uid_num_'+key+'">'+msg_obj.msg[key].num+'</td><td style="text-align: center;">'+msg_obj.msg[key].info.REMOTE_ADDR+'</td><td style="text-align: center;">'+msg_obj.msg[key].info.REMOTE_PORT+'</td><td style="text-align: center;">'+msg_obj.msg[key].info.GATEWAY_ADDR+'</td><td style="text-align: center;">'+msg_obj.msg[key].info.GATEWAY_PORT+'</td><td class="text-center">'+msg_obj.msg[key].info.GATEWAY_CLIENT_ID+'</td><td><a class="layui-btn layui-btn-normal layui-btn-xs layui-default-sendmsg" data-uid="'+key+'" href="javascript:;">推送消息</a> <a class="layui-btn layui-btn-danger layui-btn-xs layui-default-offline" data-uid="'+key+'" href="javascript:;">踢下线</a></td></tr>';
                    $(".userinfo_list").append(html);
                }
                bindClick();
                break;
            case "uidsonline":
                var is_exist = $("#uid_"+msg_obj.msg.info.uid).html();
                if(is_exist){
                    var num = $("#uid_num_"+msg_obj.msg.info.uid).html();
                    var newnum = parseInt(num)+1;
                    $("#uid_num_"+msg_obj.msg.info.uid).html(newnum);
                }else{
                    html = '<tr id="uid_'+msg_obj.msg.info.uid+'"><td style="text-align: center;">'+msg_obj.msg.info.uid+'</td><td style="text-align: center;" id="uid_num_'+msg_obj.msg.info.uid+'">'+msg_obj.msg.info.num+'</td><td style="text-align: center;">'+msg_obj.msg.info.info.REMOTE_ADDR+'</td><td style="text-align: center;">'+msg_obj.msg.info.info.REMOTE_PORT+'</td><td style="text-align: center;">'+msg_obj.msg.info.info.GATEWAY_ADDR+'</td><td style="text-align: center;">'+msg_obj.msg.info.info.GATEWAY_PORT+'</td><td class="text-center">'+msg_obj.msg.info.info.GATEWAY_CLIENT_ID+'</td><td><a class="layui-btn layui-btn-normal layui-btn-xs layui-default-sendmsg" data-uid="'+msg_obj.msg.info.uid+'" href="javascript:;">推送消息</a> <a class="layui-btn layui-btn-danger layui-btn-xs layui-default-offline" data-uid="'+msg_obj.msg.info.uid+'" href="javascript:;">踢下线</a></td></tr>';
                    $(".userinfo_list").append(html);
                    bindClick();
                }
                break;
            case "uidsoffline":
                var nn_num = $("#uid_num_"+msg_obj.msg.uid).html();
                if(nn_num>1){
                    nn_num = nn_num-1;
                    $("#uid_num_"+msg_obj.msg.uid).html(nn_num);
                }else{
                    $("#uid_"+msg_obj.msg.uid).remove();
					bindClick();
                }
                break;
        }
	}
    
    function bindClick(){
		$("#summary").html($(".layui-table").find("tr").length-1);
		$(".layui-default-sendmsg").unbind();
        $(".layui-default-offline").unbind();
        $(".layui-default-sendmsg").click(function(){
            var group = $(this).data('uid');
            //prompt层
            layer.prompt({title: '发送消息给'+group, formType: 2}, function(msg, index){
                pushdata(group,msg);
                layer.close(index);
                layer.msg('发送成功');
            });
        });
		$(".layui-default-offline").click(function(){
            layer.msg("用户不多，禁止踢人哦！");
        });
    }
});