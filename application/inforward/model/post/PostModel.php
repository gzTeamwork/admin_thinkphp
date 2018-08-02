<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-24 0024
 * Time: 8:26
 */

namespace app\inforward\model\post;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class PostModel extends Model
{
    use mwModelBase;
    // 设置当前模型对应的完整数据表名称
    protected $connection = 'db_admin_core';
    protected $table = 'posts';

    //  其他附加内容
    public function postExtra()
    {
        return $this->hasMany('PostExtraModel', 'pid');
    }

    //  其他附加内容啊
    public function postExtras()
    {
        return $this->morphMany('PostExtraModel', 'postExtraTable');
    }

    //  单元楼层
    public function floor()
    {
        return $this->hasOne('PostExtraModel', 'pid');
    }

}