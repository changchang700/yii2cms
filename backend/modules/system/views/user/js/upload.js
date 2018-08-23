layui.use(['upload','layer'], function(){
  var upload = layui.upload,
      layer = parent.layer === undefined ? layui.layer : parent.layer;
  //执行实例
  var uploadInst = upload.render({
    elem: '#test3',
    url: "<?=yii\helpers\Url::to(['/tools/upload'])?>",
    done: function(res){
        if(res.code==200){
            $("#user-head_pic").val(res.data);
            $(".userinfo_head_pic").attr('src',res.data);
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