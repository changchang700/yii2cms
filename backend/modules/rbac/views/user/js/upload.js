layui.use(['upload','layer'], function(){
  var upload = layui.upload,layer = parent.layer === undefined ? layui.layer : parent.layer;

    upload.render({
        elem: '#test3',
        url: "<?=yii\helpers\Url::to(['/tools/upload'])?>",
        done: function(res){
            if(res.code==200){
                //修改上传成功后需要修改的地方
                $("#signup-head_pic").val(res.data);
                $("#user-head_pic").val(res.data);
                $(".userinfo_head_pic").attr('src',res.data);
                //修改父窗口数据
                parent.$('.header_user_head_pic').attr('src',res.data);
                layer.msg("上传成功");
            }else{
                layer.msg("上传失败");
            }
        },
        error: function(){
            layer.msg("请求异常");
        }
    });
});