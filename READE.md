# 开发说明文档

> 本项目是基于Thinkphp5.1 + Vue全家桶制作的管理系统

`整体结构`

```markdown
+admin_thikphp              根目录
|   +-- application         应用目录
|   +-- config              全局配置
|   +-- extend              外部引用目录
|   +-- public              公共库(访问目录)
|       +-- interface       后台前端页面项目目录
|   +-- route               路由目录
|   +-- sql                 模拟数据目录
|   +-- thinkphp            thinkphp5.1核心
|   +-- vendor              第三方库目录
```

 `技术要求`
> 服务器运行环境
> * PHP >=  7.1.0
> * MySql >= 5.6.0
> * Server >= apache 2.4.0
> * Thinkphp >= 5.1.0
> * Workman >= 2.0
 
 `因为使用了.htaccess重定向文件,如使用其他服务器可自行处理`

> 前端页面运行环境
> * Node.js >= 6.9.0
> * Vue >= 2.6.0
> * Webpack >= 3.4.0