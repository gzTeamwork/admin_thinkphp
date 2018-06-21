<?php

namespace app\inforward\model;

use app\inforward\middleware\base\mwModelBase;
use think\Model;

class ItemsQrcode extends Model
{
    use mwModelBase;

    // 设置当前模型对应的完整数据表名称
    protected $table = 'items_qrcode';

}