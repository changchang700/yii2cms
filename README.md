# 欢迎使用yii2cms后台快速搭建框架

------

本框架基于YII2+Layui，后端主要集成了如下功能：
> * RBAC权限控制
> * 前台用户管理
> * 系统参数配置
> * 系统访问日志
> * 待开发功能........

[点击查看演示][1]
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
 3. 运行 `composer install` 或者 `composer update` 更新依赖包（慎用）
 4. 导入数据库文件，数据库文件在yii2cms下的yii2_cms.sql，直接到如即可
 5. 修改数据库配置，配置文件如下所示![此处输入图片的描述][2]
 6. 配置本地memcache服务，由于用到配置文件，所以用memcache缓存相关参数![此处输入图片的描述][3]
 7. 部署好之后需要配置Nginx或者Apache项。
 8. 默认账号：demo 默认密码：123456  加群了解更多：599071415

预览：
![此处输入图片的描述][4]


![此处输入图片的描述][5]


![此处输入图片的描述][6]


![此处输入图片的描述][7]


  [1]: https://resources.alilinet.com/20180824/201808240958273230.png
  [2]: https://resources.alilinet.com/20180824/201808240951316663.png
  [3]: https://resources.alilinet.com/20180824/201808240953476842.png
  [4]: https://resources.alilinet.com/20180824/201808240958273230.png
  [5]: https://resources.alilinet.com/20180824/201808240958395263.png
  [6]: https://resources.alilinet.com/20180824/201808240958346071.png
  [7]: https://resources.alilinet.com/20180824/201808240958442149.png