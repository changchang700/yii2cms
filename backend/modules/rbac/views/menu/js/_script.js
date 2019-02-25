layui.config({
	base : "js/"
}).use(['form','layer','jquery'],function(){
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		$ = layui.jquery;
		var url = ["<?= yii\helpers\Url::to(['/tools/ico']); ?>",'yes'];
		
		$('.open-icon').click(function(){
			layer.open({title:'图标选择', type: 2, area: ['630px', '530px'], fix: true, maxmin: false, content: url});
		});
		
});

$('#parent_name').autocomplete({
    source: function (request, response) {
        var result = [];
        var limit = 10;
        var term = request.term.toLowerCase();
        $.each(_opts.menus, function () {
            var menu = this;
            if (term == '' || menu.name.toLowerCase().indexOf(term) >= 0 ||
                (menu.parent_name && menu.parent_name.toLowerCase().indexOf(term) >= 0) ||
                (menu.route && menu.route.toLowerCase().indexOf(term) >= 0)) {
                result.push(menu);
                limit--;
                if (limit <= 0) {
                    return false;
                }
            }
        });
        response(result);
    },
    focus: function (event, ui) {
        $('#parent_name').val(ui.item.name);
        return false;
    },
    select: function (event, ui) {
        $('#parent_name').val(ui.item.name);
        $('#parent_id').val(ui.item.id);
        return false;
    },
    search: function () {
        $('#parent_id').val('');
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    return $("<li>")
        .append($('<a>').append($('<b>').text(item.name)).append('<br>')
            .append($('<i>').text(item.parent_name + ' | ' + item.route)))
        .appendTo(ul);
};

$('#route').autocomplete({
    source: _opts.routes,
});