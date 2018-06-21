<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/7
 * Time: 下午3:33
 */

namespace app\inforward\model;

use app\inforward\middleware\mwModelBase;
use think\Model;

class MealMenu extends Model
{
    protected $table = 'mealMenuLogic';
    use mwModelBase;

}