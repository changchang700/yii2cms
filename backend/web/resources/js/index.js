var $, tab;
layui.config({
    base: "/resources/js/"
}).use(['tab', 'form', 'element', 'layer', 'jquery'], function () {
    tab = layui.tab();
	$ = layui.jquery;
	var form = layui.form,
        layer = layui.layer,
        element = layui.element;
    
    //切换皮肤
    skins();

    $(".panel a").on("click",function(){
		window.parent.addTab($(this));
	});

    //更换皮肤
    function skins() {
        var skin = window.sessionStorage.getItem("skin");
        if (skin) {  //如果更换过皮肤
            if (window.sessionStorage.getItem("skinValue") != "自定义") {
                $("body").addClass(window.sessionStorage.getItem("skin"));
            } else {
                $(".layui-layout-admin .layui-header").css("background-color", skin.split(',')[0]);
                $(".layui-bg-black").css("background-color", skin.split(',')[1]);
                $(".hideMenu").css("background-color", skin.split(',')[2]);
            }
        }
    }

    $(".changeSkin").click(function () {
        layer.open({
            title: "更换皮肤",
            area: ["310px", "280px"],
            type: "1",
            content: '<div class="skins_box">' +
                '<form class="layui-form">' +
                '<div class="layui-form-item-skin">' +
                '<input type="radio" name="skin" value="默认" title="默认" lay-filter="default" checked="">' +
                '<input type="radio" name="skin" value="橙色" title="橙色" lay-filter="orange">' +
                '<input type="radio" name="skin" value="蓝色" title="蓝色" lay-filter="blue">' +
                '<input type="radio" name="skin" value="自定义" title="自定义" lay-filter="custom">' +
                '<div class="skinCustom">' +
                '<input type="text" class="layui-input topColor" name="topSkin" placeholder="顶部颜色" />' +
                '<input type="text" class="layui-input leftColor" name="leftSkin" placeholder="左侧颜色" />' +
                '<input type="text" class="layui-input menuColor" name="btnSkin" placeholder="顶部菜单按钮" />' +
                '</div>' +
                '</div>' +
                '<div class="layui-form-item-skin skinBtn-skin">' +
                '<a href="javascript:;" class="layui-btn layui-btn-small layui-btn-normal" lay-submit="" lay-filter="changeSkin">确定更换</a>' +
                '<a href="javascript:;" class="layui-btn layui-btn-small layui-btn-primary" lay-submit="" lay-filter="noChangeSkin">我再想想</a>' +
                '</div>' +
                '</form>' +
                '</div>',
            success: function (index, layero) {
                var skin = window.sessionStorage.getItem("skin");
                if (window.sessionStorage.getItem("skinValue")) {
                    $(".skins_box input[value=" + window.sessionStorage.getItem("skinValue") + "]").attr("checked", "checked");
                }
                ;
                if ($(".skins_box input[value=自定义]").attr("checked")) {
                    $(".skinCustom").css("visibility", "inherit");
                    $(".topColor").val(skin.split(',')[0]);
                    $(".leftColor").val(skin.split(',')[1]);
                    $(".menuColor").val(skin.split(',')[2]);
                }
                ;
                form.render();
                $(".skins_box").removeClass("layui-hide");
                $(".skins_box .layui-form-radio").on("click", function () {
                    var skinColor;
                    if ($(this).find("div").text() == "橙色") {
                        skinColor = "orange";
                    } else if ($(this).find("div").text() == "蓝色") {
                        skinColor = "blue";
                    } else if ($(this).find("div").text() == "默认") {
                        skinColor = "";
                    }
                    if ($(this).find("div").text() != "自定义") {
                        $(".topColor,.leftColor,.menuColor").val('');
                        $("body").removeAttr("class").addClass("main_body " + skinColor + "");
                        $(".skinCustom").removeAttr("style");
                        $(".layui-bg-black,.hideMenu,.layui-layout-admin .layui-header").removeAttr("style");
                    } else {
                        $(".skinCustom").css("visibility", "inherit");
                    }
                });
                var skinStr, skinColor;
                $(".topColor").blur(function () {
                    $(".layui-layout-admin .layui-header").css("background-color",$(this).val()+" !important");
                });
                $(".leftColor").blur(function () {
                    $(".layui-bg-black").css("background-color",$(this).val()+" !important");
                });
                $(".menuColor").blur(function () {
                    $(".hideMenu").css("background-color",$(this).val()+" !important");
                });
                form.on("submit(changeSkin)", function (data) {
                    if (data.field.skin != "自定义") {
                        if (data.field.skin == "橙色") {
                            skinColor = "orange";
                        } else if (data.field.skin == "蓝色") {
                            skinColor = "blue";
                        } else if (data.field.skin == "默认") {
                            skinColor = "";
                        }
                        window.sessionStorage.setItem("skin", skinColor);
                    } else {
                        skinStr = $(".topColor").val() + ',' + $(".leftColor").val() + ',' + $(".menuColor").val();
                        window.sessionStorage.setItem("skin", skinStr);
                        $("body").removeAttr("class").addClass("main_body");
                    }
                    window.sessionStorage.setItem("skinValue", data.field.skin);
                    layer.closeAll("page");
                });
                form.on("submit(noChangeSkin)", function () {
                    $("body").removeAttr("class").addClass("main_body " + window.sessionStorage.getItem("skin") + "");
                    $(".layui-bg-black,.hideMenu,.layui-layout-admin .layui-header").removeAttr("style");
                    skins();
                    layer.closeAll("page");
                });
            },
            cancel: function () {
                $("body").removeAttr("class").addClass("main_body " + window.sessionStorage.getItem("skin") + "");
                $(".layui-bg-black,.hideMenu,.layui-layout-admin .layui-header").removeAttr("style");
                skins();
            }
        });
    });

    //退出
    $(".signOut").click(function () {
        window.sessionStorage.removeItem("menu");
        menu = [];
        window.sessionStorage.removeItem("curmenu");
    });

    //隐藏左侧导航
    $(".hideMenu").click(function () {
        $(".layui-layout-admin").toggleClass("showMenu");
        $(".hideMenu").toggleClass("icon-menuunfold");
		$(".logo").toggleClass('hideMenuLogo');
        //渲染顶部窗口
        tab.tabMove();
    });

    //锁屏
    function lockPage() {
        var backend_user_head_pic = $(".header_user_head_pic").attr("src");
        var backend_user_name = $(".header_user_name").html();
        alert('请输入admin解锁，默认密码是admin，正式使用可以去掉或者自己后台认证下密码');
        layer.open({
            title: false,
            type: 1,
            content: '	<div class="admin-header-lock" id="lock-box">' +
                '<div class="admin-header-lock-img"><img src="' + backend_user_head_pic + '"/></div>' +
                '<div class="admin-header-lock-name" id="lockUserName">' + backend_user_name + '</div>' +
                '<div class="input_btn">' +
                '<input type="password" class="admin-header-lock-input layui-input" autocomplete="off" placeholder="请输入[admin]密码解锁.." name="lockPwd" id="lockPwd" />' +
                '<button class="layui-btn" id="unlock">解锁</button>' +
                '</div>' +
                '</div>',
            closeBtn: 0,
            shade: 0.9
        });
        $(".admin-header-lock-input").focus();
    }
    $(".lockcms").on("click", function () {
        window.sessionStorage.setItem("lockcms", true);
        lockPage();
    });
    // 判断是否显示锁屏
    if (window.sessionStorage.getItem("lockcms") == "true") {
        lockPage();
    }
    // 解锁
    $("body").on("click", "#unlock", function () {
        if ($(this).siblings(".admin-header-lock-input").val() == '') {
            layer.msg("请输入[admin]解锁密码！");
            $(this).siblings(".admin-header-lock-input").focus();
        } else {
            if ($(this).siblings(".admin-header-lock-input").val() == "admin") {
                window.sessionStorage.setItem("lockcms", false);
                $(this).siblings(".admin-header-lock-input").val('');
                layer.closeAll("page");
            } else {
                layer.msg("密码错误，请重新输入！");
                $(this).siblings(".admin-header-lock-input").val('').focus();
            }
        }
    });
    $(document).on('keydown', function () {
        if (event.keyCode == 13) {
            $("#unlock").click();
        }
    });

    //手机设备的简单适配
    var treeMobile = $('.site-tree-mobile'),
        shadeMobile = $('.site-mobile-shade');

    treeMobile.on('click', function () {
        $('body').addClass('site-mobile');
    });

    shadeMobile.on('click', function () {
        $('body').removeClass('site-mobile');
    });

    // 添加新窗口
    $("body").on("click", ".layui-nav .layui-nav-item a,.panel_box a", function () {
        //如果不存在子级
        if ($(this).siblings().length == 0) {
            addTab($(this));
            $('body').removeClass('site-mobile');  //移动端点击菜单关闭菜单层
        }
        $(this).parent("dd").siblings().removeClass("layui-nav-itemed");
    });

    //公告层
    function showNotice() {
        layer.open({
            type: 1,
            title: "系统公告",
            closeBtn: false,
            area: '310px',
            shade: 0.8,
            id: 'LAY_layuipro',
            btn: ['立即查看'],
            moveType: 1,
			content: '<div style="padding:15px 20px; text-align:justify; line-height: 22px; text-indent:2em;border-bottom:1px solid #e2e2e2;"><p>亲爱的，欢迎使用本系统，新增在线音乐功能。<div style="text-align:center;margin-top: -25px;"><br><a target="_blank" style="color:blue;" href="http://www.alilinet.com">前台博客地址</a><br><a target="_blank" style="color:blue;" href="https://github.com/changchang700/yii2cms">后台开源地址</a><br><a target="_blank" style="color:blue;" href="http://qm.qq.com/cgi-bin/qm/qr?k=N9JkOSj4KvWRtb_7fa_YBAYrjziuBSTm">加入群群嗨皮</a></div></p></div>',
            success: function (layero) {
                var btn = layero.find('.layui-layer-btn');
                btn.css('text-align', 'center');
                btn.on("click", function () {
                    window.sessionStorage.setItem("showNotice", "true");
                });
                if ($(window).width() > 432) {  //如果页面宽度不足以显示顶部“系统公告”按钮，则不提示
                    btn.on("click", function () {
                        layer.tips('系统公告在这里', '#showNotice', {
                            tips: 3
                        });
                    });
                }
            }
        });
    }
    //判断是否处于锁屏状态(如果关闭以后则未关闭浏览器之前不再显示)
    if (window.sessionStorage.getItem("lockcms") != "true" && window.sessionStorage.getItem("showNotice") != "true") {
        showNotice();
    }
    $(".showNotice").on("click", function () {
        showNotice();
    });

    //刷新后还原打开的窗口
    if (window.sessionStorage.getItem("menu") != null) {
        menu = JSON.parse(window.sessionStorage.getItem("menu"));
        curmenu = window.sessionStorage.getItem("curmenu");
        var openTitle = '';
        for (var i = 0; i < menu.length; i++) {
            openTitle = '';
            if (menu[i].icon) {
                if (menu[i].icon.split("-")[0] == 'icon') {
                    openTitle += '<i class="layui-icon ' + menu[i].icon + '"></i>';
                } else {
                    openTitle += '<i class="iconfont">' + menu[i].icon + '</i>';
                }
            }
            openTitle += '<cite>' + menu[i].title + '</cite>';
            openTitle += '<i class="layui-icon layui-unselect layui-tab-close" data-id="' + menu[i].layId + '">&#x1006;</i>';
            element.tabAdd("tab", {
                title: openTitle,
                content: "<iframe src='" + menu[i].href + "' data-id='" + menu[i].layId + "'></frame>",
                id: menu[i].layId
            });
            //定位到刷新前的窗口
            if (curmenu != "undefined") {
                if (curmenu == '' || curmenu == "null") {  //定位到后台首页
                    element.tabChange("tab", '');
                } else if (JSON.parse(curmenu).title == menu[i].title) {  //定位到刷新前的页面
                    element.tabChange("tab", menu[i].layId);
                }
            } else {
                element.tabChange("tab", menu[menu.length - 1].layId);
            }
        }
        //渲染顶部窗口
        tab.tabMove();
    }

    //刷新当前
    //此处添加禁止连续点击刷新一是为了降低服务器压力
    //另外一个就是为了防止超快点击造成chrome
    //本身的一些js文件的报错(不过貌似这个问题还是存在，不过概率小了很多)
    $(".refresh").on("click", function () {
        if ($(this).hasClass("refreshThis")) {
            $(this).removeClass("refreshThis");
            $(".clildFrame .layui-tab-item.layui-show").find("iframe")[0].contentWindow.location.reload(true);
            setTimeout(function () {
                $(".refresh").addClass("refreshThis");
            }, 2000);
        } else {
            layer.msg("您点击的速度超过了服务器的响应速度，还是等两秒再刷新吧！");
        }
    });

    //关闭其他
    $(".closePageOther").on("click", function () {
        if ($("#top_tabs li").length > 2 && $("#top_tabs li.layui-this cite").text() != "后台首页") {
            var menu = JSON.parse(window.sessionStorage.getItem("menu"));
            $("#top_tabs li").each(function () {
                if ($(this).attr("lay-id") != '' && !$(this).hasClass("layui-this")) {
                    element.tabDelete("tab", $(this).attr("lay-id")).init();
                    //此处将当前窗口重新获取放入session，避免一个个删除来回循环造成的不必要工作量
                    for (var i = 0; i < menu.length; i++) {
                        if ($("#top_tabs li.layui-this cite").text() == menu[i].title) {
                            menu.splice(0, menu.length, menu[i]);
                            window.sessionStorage.setItem("menu", JSON.stringify(menu));
                        }
                    }
                }
            });
        } else if ($("#top_tabs li.layui-this cite").text() == "后台首页" && $("#top_tabs li").length > 1) {
            $("#top_tabs li").each(function () {
                if ($(this).attr("lay-id") != '' && !$(this).hasClass("layui-this")) {
                    element.tabDelete("tab", $(this).attr("lay-id")).init();
                    window.sessionStorage.removeItem("menu");
                    menu = [];
                    window.sessionStorage.removeItem("curmenu");
                }
            });
        } else {
            layer.msg("没有可以关闭的窗口了！");
        }
        //渲染顶部窗口
        tab.tabMove();
    });
    //关闭全部
    $(".closePageAll").on("click", function () {
        if ($("#top_tabs li").length > 1) {
            $("#top_tabs li").each(function () {
                if ($(this).attr("lay-id") != '') {
                    element.tabDelete("tab", $(this).attr("lay-id")).init();
                    window.sessionStorage.removeItem("menu");
                    menu = [];
                    window.sessionStorage.removeItem("curmenu");
                }
            });
        } else {
            layer.msg("没有可以关闭的窗口了！");
        }
        //渲染顶部窗口
        tab.tabMove();
    });

    //修改个人资料
    $(".userInfo").click(function () {
        var href = $(this).attr("href");
        layui.layer.open({
            title: "修改信息",
            type: 2,
            area: ['430px', '520px'], //宽高
            content: [href, "no"]
        });
        //直接阻止A连接跳转
        return false;
    });
});
//打开新窗口
function addTab(_this) {
	tab.tabAdd(_this);
}
//图片管理弹窗
function showImg(images){
	layer.photos({
		shade: [0.85, '#000'],
		photos: {
			"title": "任务附件预览",
			"id": 'showImages',
			"data": images
		}
	});
}