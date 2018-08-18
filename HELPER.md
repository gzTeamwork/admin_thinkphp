# admin_thinkphp 使用手册

本程序以 thinkphp5.1 版本为核心的综合性后台系统;
部署前请使用

* <code>#composer install</code>安装依赖;

> ### Thinkphp 5.1 + swagger-php
> 本项目已经加入 swagger-php 进行 api 文档编写使用一下命令即可生成 swagger.json 文件
>* <code>>>> php ./vendor/zircote/swagger-php/bin/swagger ./application -o ./swagger-doc </code>

> ### Workman Socks + think-worker
> 本项目已采用Workman作为socks通信服务层,得益于thinkphp体系的think-worker模块
> > * 采用composer安装think-worker模块<br>
> > <code>>>> composer require topthink/think-worker</code></br>
>
> > * php启用think worker模块<br>
> > <code>>>> php think worker</code><br>
> > 启用模块后默认访问路径为http://localhost:2346
>
> > * 使用Thinkphp内置类即可
> > <code>>>> use think\worker\Server;</code><br>
