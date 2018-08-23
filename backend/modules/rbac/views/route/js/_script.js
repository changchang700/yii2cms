layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;


	$('i.glyphicon-refresh-animate').hide();
	function updateRoutes(r) {
		_opts.routes.available = r.available;
		_opts.routes.assigned = r.assigned;
		search('available');
		search('assigned');
	}

	$('#btn-new').click(function () {
		var $this = $(this);
		var route = $('#inp-route').val().trim();
		if (route != '') {
			$this.children('i.glyphicon-refresh-animate').show();
			$.post($this.attr('href'), {route: route}, function (r) {
				$('#inp-route').val('').focus();
				updateRoutes(r);
			}).always(function () {
				$this.children('i.glyphicon-refresh-animate').hide();
			}).fail(function(a,b,c){
					if(a.status==403){
						layer.msg('没有权限');
					}else{
						layer.msg('系统错误');
					}
				});
		}
		return false;
	});

	$('.btn-assign').click(function () {
		var $this = $(this);
		var target = $this.data('target');
		var routes = $('select.list[data-target="' + target + '"]').val();

		if (routes && routes.length) {
			$this.children('i.glyphicon-refresh-animate').show();
			$.post($this.attr('href'), {routes: routes}, function (r) {
				updateRoutes(r);
			}).always(function () {
				$this.children('i.glyphicon-refresh-animate').hide();
			}).fail(function(a,b,c){
					if(a.status==403){
						layer.msg('没有权限');
					}else{
						layer.msg('系统错误');
					}
				});
		}
		return false;
	});

	$('#btn-refresh').click(function () {
		var $icon = $(this).children('span.glyphicon');
		$icon.addClass('glyphicon-refresh-animate');
		$.post($(this).attr('href'), function (r) {
			updateRoutes(r);
		}).always(function () {
			$icon.removeClass('glyphicon-refresh-animate');
		}).fail(function(a,b,c){
					if(a.status==403){
						layer.msg('没有权限');
					}else{
						layer.msg('系统错误');
					}
				});
		return false;
	});

	$('.search[data-target]').keyup(function () {
		search($(this).data('target'));
	});

	function search(target) {
		var $list = $('select.list[data-target="' + target + '"]');
		$list.html('');
		var q = $('.search[data-target="' + target + '"]').val();
		$.each(_opts.routes[target], function () {
			var r = this;
			if (r.indexOf(q) >= 0) {
				$('<option>').text(r).val(r).appendTo($list);
			}
		});
	}

	// initial
	search('available');
	search('assigned');
});