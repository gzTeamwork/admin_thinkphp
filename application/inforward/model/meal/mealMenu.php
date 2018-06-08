<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/6/7
 * Time: 下午3:33
 */

namespace app\inforward\model;

use think\Model;
use app\inforward\logic\BaseModelLogic;

class MealMenu extends Model
{
    protected $table = 'mealMenuLogic';
    use BaseModelLogic;
}