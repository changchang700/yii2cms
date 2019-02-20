# 欢迎使用yii2cms后台快速搭建框架

------

本框架基于YII2+Layui，后端主要集成了如下功能：
> * RBAC权限控制
> * 前台用户管理
> * 系统参数配置
> * 系统访问日志
> * 微信公众号开发组件
> * 待开发功能........

[加入QQ群一起讨论599071415][8]

[查看演示站点-账号：demo 密码：123456][1]

系统目录结构如下
DIRECTORY STRUCTURE
-------------------

```
api
    assets/             资源发布文件
    controllers/        控制器文件
    models/             模型文件
    modules/            模块文件
        v1/             接口V1
            controllers 控制器
            views       视图文件
            Module.php  模块
    runtime/            运行缓存
    views/              视图文件
    web/                入口目录
common
    config/             配置文件
    mail/               邮件模板
    models/             模型文件
    tests/              测试模块
console
    config/             配置文件
    controllers/        控制器文件
    migrations/         数据库迁移文件
    models/             模型文件
    runtime/            运行缓存
backend
    assets/             资源发布文件
    config/             配置文件
    controllers/        控制器文件
    models/             模型文件
    modules/            后台其他模块
    runtime/            运行缓存
    tests/              测试模块
    views/              视图
    web/                入口文件
frontend
    assets/             资源发布文件
    config/             配置文件
    controllers/        控制器文件
    models/             模型文件
    runtime/            运行缓存
    tests/              测试模块
    views/              视图
    web/                入口文件
    widgets/            插件
vendor/                 composer安装文件
environments/           环境文件
yii2_cms.sql            数据库文件
```

**安装教程**

 1. 使用本系统之前先安装composer工具
 2. 把本项目克隆下来 `git clone https://github.com/changchang700/yii2cms.git`
 3. 运行 `composer install`,然后再在项目根目录运行 `php init` 进行项目初始化配置
 4. 导入数据库文件，数据库文件在yii2cms下的yii2_cms.sql，直接到如即可
 5. 修改数据库配置，配置文件如下所示![此处输入图片的描述][2]
 6. 配置本地memcache服务，由于用到配置文件，所以用memcache缓存相关参数![此处输入图片的描述][3]
 7. 部署好之后需要配置Nginx或者Apache项 此处有好多人不会设置，其实就是把Nginx或者Apache解析到项目的backend/web目录下面。
 8. 装好之后的默认管理员账号：admin 密码：123456 演示账号：demo 密码：123456  加群了解更多：599071415

其他配置参数如图：
![此处输入图片的描述][4]


![此处输入图片的描述][5]


![此处输入图片的描述][6]


![此处输入图片的描述][7]


  [1]: http://admin.alilinet.com/
  [2]: https://github.com/changchang700/yii2cms/blob/master/uploads/%E6%95%B0%E6%8D%AE%E5%BA%93%E9%82%AE%E7%AE%B1%E9%85%8D%E7%BD%AE.png
  [3]: https://github.com/changchang700/yii2cms/blob/master/uploads/%E7%BC%93%E5%AD%98.png
  [4]: https://github.com/changchang700/yii2cms/blob/master/uploads/rbac%E5%8A%9F%E8%83%BD.png
  [5]: https://github.com/changchang700/yii2cms/blob/master/uploads/%E5%BC%80%E5%90%AFgii%E5%8A%9F%E8%83%BD.png
  [6]: https://github.com/changchang700/yii2cms/blob/master/uploads/%E7%BB%84%E4%BB%B6.png
  [7]: https://github.com/changchang700/yii2cms/blob/master/uploads/%E9%82%AE%E4%BB%B6.png
  [8]: http://qm.qq.com/cgi-bin/qm/qr?k=N9JkOSj4KvWRtb_7fa_YBAYrjziuBSTm