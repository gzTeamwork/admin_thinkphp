
#admin 系统管理应用

> admin应用是建立在Thinkphp5.1版本上的一个用于集中处理系统基础功能的应用,主要用于处理接口请求处理,现在接口结构复用情况严重,还需要独立分离出来.

> admin应用整体规划和功能设计更接近于一个网站CMS管理系统,包括用户模块\文章模块\栏目模块\配置模块等;

### 应用结构
```markdown
+-- admin
|   +-- apiHandler      接口处理
|   +-- controller      控制器
|   +-- facade          静态类(使用facade实现middleware中的类)
|   +-- middleware           逻辑处理
|       +-- mwQueryPage       页面查询
|       +-- mwTranslate       简繁翻译
|   +-- model           数据模型
|   ...
```

### 模块介绍

* #### apiHandler        接口处理

> 本文件夹内的文件属于重度耦合类型文件,作为拆分controller中的接口api方法所用,为了区分ApiHandler的方法,均以api开头

> 文件结构
```markdown
+-- apiHandler
|   +-- AdminApiHandler.php         系统管理接口
|   +-- AdvanceApiHandler.php       配置参数接口
|   +-- CateApiHandler.php          栏目接口
|   +-- PostApiHandler.php          文章接口
|   +-- UserApiHandler.php          用户接口
|   ...
```


* #### controller        控制器类


* #### facade            静态类
> facade是Thinkphp5.1中的方法,用于快速实现类的静态调用


* #### middleware        中间件
> 低成本中间件,其实就是功能相对独立的,低解耦的类
`文件结构`
```markdown
+-- middleware
|   +-- mwQueryPage.php             用于快速处理查询分页
|   +-- mwTranslate.php             用于输出数据时候,对文本的简繁处理
```


* #### model             数据模型
> 依赖于Thinkphp5.1 model类,实现与数据库对接
#### 文件结构
```markdown
+-- model
|   +-- AdvancedModel.php           配置数据表
```




> 2018-06-27 Create by Zico.kuo 21520993@qq.com