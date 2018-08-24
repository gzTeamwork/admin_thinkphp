# application 应用
> 应用内包括两大应用admin和index

> 他们分别代表着系统管理和页面管理两大功能

* #### admin 系统管理

> admin的承载其他应用底层级别的应用,主要部分是apiHandler,用于接口处理并返回信息与状态

* #### trait类型解耦

> 接口处理采用trait类型作为基础,通过controller直接引用方法,实现接口方法复用

* #### api接口调用
> api接口通过以下方式调用

`调用方法 mwApi::api(Controller $this,Array $datas)`

```php
//  引入mwApi
use app\inforward\middleware\base\mwApi;
class Admin extends Controller
{
    //  载入系统Api
    use AdminApiHandler;
    //  调用接口
    public function api()
    {
        $datas = $this->request->param(true);
        return mwApi::api($this, $datas);
    }
}
```

* #### 独立apps
> 除了admin和index是遵循Thinkphp默认结构外,根据业务拆分而分离其他application应用

> 如:inforward 盈富永泰集团应用

> 应用内采用跨命名空间方式调用admin和index内的方法与类

* #### 前后端分离
> 前后端开发分离,管理后台前端目录位于`./public/interface/`下