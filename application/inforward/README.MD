# inforward 盈富永泰应用

> inforward应用是基于盈富永泰公司业务需求而制定的

> * 由于本应用包含了盈富永泰企业微信接口和旧版本的接口,该应用需要重构与分离

### 应用结构
```markdown
+-- inforward
|   +-- apiHandler      接口处理
|   +-- controller      控制器
|   +-- http            Socket通信
|   +-- logic           逻辑层
|   +-- middleware      中间件
|   +-- model           数据模型
|   +-- unit            单元类
|   +-- view            视图
oq_attendance.sql       企业微信数据库开发模拟数据
```

### 模块介绍

* #### apiHandler       接口模块

`文件结构`

```markdown
+-- apiHandler
|   +-- DynamicApiHandler.php       评论接口
|   +-- OrderApiHandler.php         订单(预订)接口
|   +-- PostApiHandler.php          文章接口
```

* #### controller       控制器模块

> 本模块下的文件大部分是用于对接盈富永泰企业微信自主开发的功能,后期需要独立和分离出来

> 现阶段下,controller里面的控制器更多的是扮演httpRequest处理的角色,用于调用对应的ApiHandler接口

`文件结构`

```markdown
+-- controller
|   +-- Admin.php           主要管理控制器
|   +-- Api                 企业微信接口控制器
|   +-- Cate.php            栏目控制器
|   +-- Index.php           首页控制器
|   +-- MealsApi.php        报餐接口控制器(企业微信)
|   +-- Post.php            文章控制器
|   +-- QrcodeApi.php       资产二维码接口控制器(企业微信)
```

* #### http     通信模块(Socket)
> Socket通信用于与前端即时通信需要,依赖与Thinkphp5.1的ThinkWork模块,底层实际是Workman

`相关链接`
> Workman   
> https://www.workerman.net/

> ThinkWork     
> https://packagist.org/packages/topthink/think-worker

* #### logic            逻辑模块
> 由于前期开发比较随意,没有区分静态逻辑类和抽象逻辑类,都存放一起了,后期需要抽离和区分

`文件结构`

```markdown
+-- logic               
|   +-- meal                    报餐逻辑(企业微信)
|       +-- mealMenuLogic.php   报餐菜单逻辑(企业微信)
|   +-- AdminLogic.php          管理逻辑
|   +-- BaseController.php      基础控制器基类
|   +-- DailyMealLogic.php      报餐处理逻辑(企业微信)
|   +-- QrcodeLogic.php         资产二维码逻辑(企业微信)
|   +-- ThrowException.php      自定义错误处理逻辑
|   +-- UserLogic.php           用户逻辑(企业微信)
|   +-- UserSubmitLogic.php     用户提交逻辑(企业微信)
|   +-- WebsiteLogic.php        网站页面逻辑类(企业微信)
```

* #### middleware       中间件
> 低成本的中间件,初衷是想能实现简便快捷调用的低耦合类和多重复用性能,所以采用了trait类型编写中间件

>后续实际开发当中发现,trait类型在重复应用和方法命名冲突解决上,还没有比较完美的方法,只能通过重命名方法来处理,实际上对开发过程产生一定的不便,遂改用Thinkphp5.1的facade

`文件结构`

```markdown
+-- middleware
|   +-- admin
|       +-- mwAdmin.php             管理中间件
|   +-- base
|       +-- mwApi.php               api接口中间件
|       +-- mwControllerBase.php    控制器中间件
|       +-- mwModelBase.php         数据模型基础中间件
|       +-- mwModelGetters.php      模型数据获取器中间件
|   +-- dashboard              
|       +-- mwDashboard.php         后台中间件     
|   +-- helper
|       +-- mwHelper.php            助手类中间件
|   +-- meal
|       +--mwMenuMeal.php           报餐菜单中间件(企业微信)
|   +-- qrcode
|       +-- mwQrcode.php            二维码中间件
|   +-- user
|       +-- mwRole.php              后台用户权限中间件
|       +-- mwUser.php              后台用户中间件
```

* #### model    数据模型

> 数据模型遵循Thinkphp5.1设计规范,数据模型文件名与数据库数据表一一对应,但为了确保表名准确一致,在model里面都设置了对用了tableName

`文件结构`

```markdown
+-- model
|   +-- cate
|       +-- CateModel.php           栏目
|   +-- dashboard
|       +-- menuModel.php           后台系统菜单
|   +-- material
|       +-- MaterialModel.php       素材(上传文件)
|   +-- meal
|       +-- mealMenu.php            报餐菜单模型(企业微信)
|   +-- order
|       +-- OrderModel.php          订单模型(官网预约)
|   +-- post
|       +-- PostExtraModel.php      文章额外字段
|       +-- PostModel.php           文章
|       +-- PostTemplateModel.php   文章模板
|   +-- upload
|       +-- UploadModel.php         上传文件
|   +-- user
|       +-- roleModel.php           权限
|       +-- userModel.php           用户
|       +-- userSessionModel.php    用户访问记录
|   +-- DynamicModel.php            评论
|   +-- ItemsQrcode.php             资产物品(企业微信 - 资产模块)
|   +-- UserMealSubmit.php          用户报餐提交(企业微信 - 报餐模块)
|   +-- UserModel.php               用户(企业微信)
|   +-- userRestDays.php            用户休息日(企业微信 - 调休模块)
|   +-- users.php                   用户权限(企业微信 - 调休模块)
|   +-- UserSubmitModel.php         用户提交记录(企业微信 - 调休模块)

```

* #### unit 独立单元

> unit独立单元文件夹其实跟中间件很相似,也是接口逻辑抽离的一个产物,实际上可以跟middleware可以重构合并一起,无需独立分开存放了,

> unit独立单元是刚开始开发企业微信应用功能时候,使用的用户抽象类,包含用户验证\信息获取等方法

> 用户单元文件夹里的文件用于实例化使用

* #### view 视图

> 由于数据分离开发,已经不需要使用view去生成后台页面数据了

