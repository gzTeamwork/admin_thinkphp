<?php
namespace app\inforward\controller;

header("Access-Control-Allow-Origin:*");

use app\inforward\facade\QrcodeLogicFacade;
use app\inforward\logic\DailyMealLogic;
use app\inforward\logic\UserLogic;
use app\inforward\logic\UserSubmitLogic;
use think\Controller;
use think\Exception;
use think\exception\HttpException;
use think\Facade\Config;
use think\Facade\Request;

// 加载api接口类
// include_once '__DIR__/../../../../extend/weworkapi_php/api/src/CorpAPI.class.php';

class Api extends Controller
{
    private $_appKeys = ["oa_attendance" => "1234567"];

    protected $request, $wxapi;
//  返回标准化接口数据
    private function _standard_response($response, $err_code = 200)
    {
        return json($response)->code($err_code);
    }

    public function __constructor()
    {
        parent::__constructor();
        //  允许跨域
        header("Access-Control-Allow-Origin:*");
        //  加载wxword配置
    }

    //  corp app connect
    public function wx_work_connect()
    {
        header("Access-Control-Allow-Origin:*");

        $corpId = $this->request->param('corp_id');
        $corpSecret = $this->request->param('corp_secret');

        return json(['token' => md5($corpId)]);
    }

    /**
     * 验证申请appToken
     *
     * @param [type] $token
     * @return void
     */
    private function _vaid_appToken($token)
    {
        if (in_array($token, $this->_appKeys)) {
            return true;
        } else {
            return false;
        }
    }

    //  初始化配置
    private function _weixinApi_init()
    {
        $wxworkConfig = Config::get('app.wxwork_api');
        $corpId = $wxworkConfig['corp_id'];
        $corpConfig = Config::get('app.oa_attendance');
        $corpSecret = $corpConfig['app_secret'];
        return new \weworkapi_php\wxworkAPI('wwdc02ce3b575253e3', 'bLhYfEQsgz1zO5Y1kmoCQi_p96ZVCC65uRovbEX-qPM');
    }

    public function get_user_info_by_ticket()
    {
        header("Access-Control-Allow-Origin:*");
        $user_ticket = $this->request->param("user_ticket", null);
        if ($user_ticket !== null) {
            $wxapi = $this->_weixinApi_init();
            $userInfo = $wxapi->GetUserDetailByUserTicket($user_ticket);
            if (isset($userInfo->userid) && $userInfo->userid != null) {
                $userModel = new \app\inforward\model\users();
                $saveData = object_to_array($userInfo);
                unset($saveData['department']);
                unset($saveData['gender']);
                // dump($saveData);
                //  已有员工,更新;新员工,新增;
                $res = $userModel->where(["userid" => $userInfo->userid])->select();
                if (count($res) < 1) {
                    $userModel->save($saveData);
                } else {
                    $userModel->where(["userid" => $userInfo->userid])->update($saveData);
                }
            }
            $saveData['user_ticket'] = $user_ticket;
            // dump($saveData);
            return json($saveData);

        } else {
            return json(["err_msg" => "用户授权失败"])->code(200);
        }
    }
    public function get_user_info_by_code()
    {
        header("Access-Control-Allow-Origin:*");
        return $this->get_user_info();
    }
    //  获取企业微信员工信息
    public function get_user_info()
    {
        header("Access-Control-Allow-Origin:*");
        $userModel = [
            "errcode" => 0,
            "errmsg" => "ok",
            "userid" => "zhangsan",
            "name" => "李四",
            "department" => [1, 2],
            "order" => [1, 2],
            "position" => "后台工程师",
            "mobile" => "15913215421",
            "gender" => "1",
            "email" => "zhangsan@gzdev.com",
            "isleader" => 1,
            "avatar" => "http://wx.qlogo.cn/mmopen/ajNVdqHZLLA3WJ6DSZUfiakYe37PKnQhBIeOQBO4czqrnZDS79FH5Wm5m4X69TBicnHFlhiafvDwklOpZeXYQQ2icg/0",
            "telephone" => "020-123456",
            "english_name" => "jackzhang",
            "extattr" => ["attrs" => [["name" => "爱好", "value" => "旅游"], ["name" => "卡号", "value" => "1234567234"]]],
            "status" => 1,
            "qr_code" => "https://open.work.weixin.qq.com/wwopen/userQRCode?vcode=xxx",
        ];
        // return json($userModel);
        $userCode = $this->request->param("user_code");
        $wxapi = $this->_weixinApi_init();
        try {
            $response = $wxapi->GetUserInfoByCode($userCode);
            //  返回数据
            // {
            //     "errcode": 0,
            //     "errmsg": "ok",
            //     "UserId":"USERID",
            //     "DeviceId":"DEVICEID",
            //     "user_ticket": "USER_TICKET"，
            //     "expires_in":7200
            //  }
            //  没毛病,继续申请用户信息
            // var_dump($response);
            // $response = object_to_array($response);
            if (isset($response->user_ticket)) {
                $user_ticket = $response->user_ticket;
                $userInfo = $wxapi->GetUserDetailByUserTicket($user_ticket);
                if (isset($userInfo->userid) && $userInfo->userid != null) {
                    $userModel = new \app\inforward\model\users();
                    $saveData = object_to_array($userInfo);
                    unset($saveData['department']);
                    unset($saveData['gender']);
                    // dump($saveData);
                    //  已有员工,更新;新员工,新增;
                    $res = $userModel->where(["userid" => $userInfo->userid])->select();
                    if (count($res) < 1) {
                        $saveData['isWorking'] = 1;
                        $userModel->save($saveData);
                    } else {
                        $userModel->where(["userid" => $userInfo->userid])->update($saveData);
                    }
                }
                $saveData['user_ticket'] = $user_ticket;
                return json($saveData);

            } else {
                return json(["err_msg" => "用户授权失败"])->code(200);
            }

        } catch (Exception $e) {
            return $this->_standard_response($e, 200);
        }
    }

    public function index()
    {
        return json_encode("yeah~");
    }

    /**
     *
     */
    public function get_access_token()
    {
        $corpId = Config::get('app.wxwork_api.corp_id');
        $corpSecret = Config::get('app.wxwork_api.corp_secret');
        $wxapi = new \weworkapi_php\wxworkAPI($corpId, $corpSecret);
        $wxapi->get_access_token();
    }

    /**
     * Apps通过get_token换取认证app_token
     *
     * @return void
     */
    public function get_token()
    {

        //  apps申请请求token

        $token = Request::param("appToken");

        return json(isset($this->_appKeys[$token]) ? $this->_appKeys[$token] : null);
    }
    public function get_restByWorker()
    {
        header("Access-Control-Allow-Origin: *");

        //  获取员工排休记录

        $workerId = Request::param("workerId");
        $appToken = Request::param("appToken");

        if ($this->_vaid_appToken($appToken)) {
            $record = [['date' => '2018/4/18', 'workId' => $workerId]];
            return json($record);
        }
    }

    //  获取休息事件
    public function get_restevents_by_month()
    {
        header("Access-Control-Allow-Origin:*");

        //  当前日期
        $dateToday = date('Y-m-d', time());
        $dateTodayArray = explode("-", $dateToday);

        $userRestDaysModel = new \app\inforward\model\userRestDays();
        $restDays = $userRestDaysModel->where("month", $dateTodayArray[1])->select();

        if (count($restDays) < 1) {
            $restDays = null;
        }

        return json($restDays);
    }

    //  获取当月排班数据
    public function get_month_events()
    {
        header("Access-Control-Allow-Origin:*");

        //  当前日期
        $dateToday = date('Y-m-d', time());

        //  获取当前月份
        $curDate = $this->request->param('date', $dateToday);

        $dateTodayArr = explode('-', $curDate);

        $restDaysModel = new \app\inforward\model\userRestDays();
        $curMonthRestEvents = $restDaysModel->where(['year' => $dateTodayArr[0], 'month' => $dateTodayArr[1]])->select();

        if (count($curMonthRestEvents) > 0) {
            $newCurMonthRestEvents = [];

            foreach ($curMonthRestEvents as $key => $restEvent) {
                $newCurMonthRestEvents[$restEvent->date][] = $restEvent;
            }
            $curMonthRestEvents = $newCurMonthRestEvents;
        }

        $userModel = new \app\inforward\model\users();
        $allUsers = $userModel->select();
        if (count($allUsers) > 0) {
            // $allUsers = $allUsers->toArray();
            $userModel = new UserLogic();
            $allUsers = $userModel->getUsers();
            $userids = array_column($allUsers, 'userid');
            $allUsers = array_combine($userids, $allUsers);
        }

        //  holiday - 国家法定假期
        $holiday = ['04-04', '04-05', '04-06', '04-29', '04-30', '05-01'];

        //  生成当月排班数据
        $curMonthEvents = [];
        for ($d = 1; $d < 32; $d++) {
            //  每日排班数据
            $day = $d < 10 ? "0" . $d : $d;
            $curDate = $dateTodayArr[0] . '-' . $dateTodayArr[1] . '-' . $day;
            if (0 == date("w", strtotime($curDate)) || in_array($dateTodayArr[1] . "-" . $day, $holiday)) {
                continue;
            }
            $curDutyUsers = $allUsers;
            $event = ['date' => $curDate];
            if (isset($curMonthRestEvents[$curDate])) {
                foreach ($curMonthRestEvents[$curDate] as $key => $restEvent) {
                    if (isset($curDutyUsers[$restEvent->userid])) {
                        unset($curDutyUsers[$restEvent->userid]);
                    } else {
                        unset($curMonthRestEvents[$curDate][$key]);
                    }
                }
                $event['onDuty'] = $curDutyUsers;
                $event['onRest'] = $curMonthRestEvents[$curDate];
            } else {
                $event['onDuty'] = $curDutyUsers;
                $event['onRest'] = [];
            }
            $curMonthEvents[] = $event;
        }

        return json($curMonthEvents);

    }

    public function set_user_working()
    {
        $userId = $this->request->param("user_id");
        $userLogic = new UserLogic();
        $curUser = $userLogic->updateUserById($userId, ['isWorking' => 1]);
        return $curUser;
    }

    //  获取用户信息 - user_id
    public function get_user_info_by_id()
    {
        header("Access-Control-Allow-Origin:*");

        $userId = $this->request->param("user_id");
        // $userModel = new \app\inforward\model\UserModel();
        // $curUser = $userModel->where("userid", $userId)->find();
        $userLogic = new UserLogic();
        $curUser = $userLogic->getUsers([['userid', '=', $userId]]);
        return json($curUser);
    }

    //  获取所有用户信息 - get all user
    public function get_all_user()
    {
        header("Access-Control-Allow-Origin:*");

        // $userModel = new \app\inforward\model\users();
        // $allUsers = $userModel->select();
        $userLogic = new UserLogic();
        $allUsers = $userLogic->getUsers();

        return json($allUsers);
    }

    //  获取用户休假事件
    public function get_rest_day_by_user()
    {
        header("Access-Control-Allow-Origin:*");

        $userid = $this->request->param("user_id");

        //  当前日期
        $dateToday = date('Y-m-d', time());
        $dateTodayArray = explode("-", $dateToday);

        $userRestDaysModel = new \app\inforward\model\userRestDays();
        $restDays = $userRestDaysModel->where(['userid' => $userid, 'year' => $dateTodayArray[0], 'month' => $dateTodayArray[1]])->select();
        // dump($restDays);
        // $restDays = [['date' => '2018-04-17'], ['date' => '2018-04-28']];

        return json($restDays->toArray());
    }

    //  同步员工信息
    public function get_all_users_sync()
    {
        $departments = $wxapi->DepartmentList();
        if ($departments) {

        }
    }

    //  保存用户提交的休假事件
    public function set_user_attendance()
    {
        header("Access-Control-Allow-Origin:*");

        $oldRestDay = $this->request->param('old_day');
        $restDay = $this->request->param('rest_day');
        $userid = $this->request->param('user_id');
        $userName = $this->request->param('user_name', null);

        $dateArray = explode("-", $restDay);

        $userRestDaysModel = new \app\inforward\model\userRestDays();
        $saveData = ['date' => $restDay, 'userid' => $userid, 'username' => $userName, 'year' => $dateArray[0], 'month' => $dateArray[1], 'day' => $dateArray[2], 'status' => 'rest', 'create_time' => time()];
        $dateToday = date('Y-m-d', time());
        $dateTodayArray = explode("-", $dateToday);

        $exitsRestDay = $userRestDaysModel->where(['userid' => $userid, 'date' => $restDay])->select();
        $exitsOldDay = $userRestDaysModel->where(['userid' => $userid, 'date' => $oldRestDay])->select();

        if (count($exitsRestDay) == 0) {
            //  新日期与当前休息日期不存在重复
            $monthMaxRestDay = $userRestDaysModel->where(['userid' => $userid, 'year' => $dateToday[0], 'month' => $dateToday[1]])->select();
            if (count($monthMaxRestDay) < 3) {
                //  当月休息日不超过上限
                // $submitModel = new \app\inforward\model\userRestDays();
                // return json($submitModel->save($saveData))->code(200);
            } else {
                return json(['errmsg' => '当前用户当月提交休息日期超过上限'])->code(205);
            }
        } else {
            return json(['errmsg' => '当前用户提交的日期已重复'])->code(206);
        }

        if ($oldRestDay == null) {
            $userRestDaysModel->save($saveData);
        } else {
            $userRestDaysModel->where(['userid' => $userid, 'date' => $oldRestDay])->update($saveData);
        }

        return json(['restDay' => $restDay, 'userid' => $userid]);
    }

    public function rem_rest_day_by_user()
    {
        header("Access-Control-Allow-Origin:*");
        $cancelRestDay = $this->request->param('rest_day');
        $userid = $this->request->param('user_id');
        $dateArray = explode('-', $cancelRestDay);
        $userRestDaysModel = new \app\inforward\model\userRestDays();
        $where = ['userid' => ['userid', '=', $userid], 'date' => ['date', '=', $cancelRestDay]];
        $res = $userRestDaysModel->where($where)->delete();
        return is_null($res) ? json(['msg' => '删除失败'], 401) : json(['msg' => '成功删除'], 200);
    }

    /*************
     * 报餐功能 - 接口
     */

    // 生成T+7日报餐数据
    public function get_nearby_dailymeal()
    {
        //  今日
        $dateToday = date('Y-m-d', time());
        //  七日
        $sevenDay = date('Y-m-d', strtotime("+1 week"));

        $submitLogic = new UserSubmitLogic();
        $userSubmits = $submitLogic->getSubmits([
            'group' => ['group', '=', 'userDailyMeal'],
            'update_time' => ['update_time', 'between time', [$dateToday, $sevenDay]],
        ]);

        dump($userSubmits);

        if (count($userSubmits) > 0) {
            $submitDates = array_column($userSubmits, 'update_time');
            $userSubmits = array_combine($submitDates, $userSubmits);
        }

        $events = [];
        for ($i = 0; $i < 7; $i++) {
            $eventDate = date('Y-m-d', strtotime("+" . $i . " day"));
            if (isset($userSubmits[$eventDate])) {
                $userSubmits[$eventDate]['date'] = $eventDate;
                $events[] = $userSubmits;
            } else {
                $events[] = ['date' => $eventDate];
            }
        }
        dump($events);

    }

    //  设置员工每日报餐数据
    public function attend_user_daily_meal()
    {
        header("Access-Control-Allow-Origin:*");

        $userId = $this->request->param('user_id', null);
        $dailyMealDate = $this->request->param('meal_date', null);
        $dailyMealCheck = $this->request->param('meal_check', false);
        $dailyMealCheck = $dailyMealCheck ? 1 : 0;
        try {
            if (is_null($userId) && is_null($dailyMealDate)) {
                throw new HttpException('200', '参数不允许为空');
            } else {
                $dailyMealLogic = new DailyMealLogic();
                $result = $dailyMealLogic->insert_user_meal(
                    ['user_id' => $userId, 'meal_date' => $dailyMealDate, 'need_meal' => $dailyMealCheck]
                );
                return json($result);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //  获取7天内员工报餐记录
    public function get_user_daily_meal_in_week()
    {
        header("Access-Control-Allow-Origin:*");
        $userId = $this->request->param('user_id', null);
        $beginDate = $this->request->param('begin_date', "-2 day");
        $dailyMealLogic = new DailyMealLogic();
        $result = $dailyMealLogic->get_user_daily_meal($userId);
        return json($result);
    }

    //  获取明天报餐汇总
    public function get_tomorrow_daily_meals()
    {
        header("Access-Control-Allow-Origin:*");
        $tomorrowDate = strtotime("+1 day");
        $dailyMealLogic = new DailyMealLogic();
        $result = $dailyMealLogic->getTomorrowDailMeals($tomorrowDate);
        return json($result);
    }

    /******* 二维码管理系统 *******/

    /**
     * get_qrcode_item_by_unionid
     * 获取单个二维码
     *
     * @return void
     */
    public function get_qrcode_item_by_unionid()
    {
        header("Access-Control-Allow-Origin:*");
        $unionId = $this->request->param('union_id');
        try {
            $item = QrcodeLogicFacade::getItem($unionId);
            return json($item, 200);
        } catch (Exception $e) {
            return json($e->getMessage(), 404);
        }
    }

    /**
     * get_qrcode_items
     * 获取多个二维码条目
     *
     * @return void
     */
    public function get_qrcode_items()
    {
        header("Access-Control-Allow-Origin:*");
        $num = Request::param('num', 20);
        $qrcodes = \app\inforward\facade\QrcodeLogicFacade::getItems($num);

        return json($qrcodes, 200);
    }

    public function set_qrcode()
    {

    }

    public function set_batch_qrcodes()
    {
        header("Access-Control-Allow-Origin:*");

        $num = Request::param('num', 0);
        if ($num == 0) {
            return json('Batch insert number must be bigger than 0 ', 404);
        }
        $items = [];
        for ($i = 0; $i < $num; $i++) {
            $dateTime = date('Y-m-d h:i:s', time() . $i);
            $items[] = ['unionid' => md5('inforward' . time() . $i), 'create_time' => $dateTime, 'update_time' => $dateTime, 'group' => 'test', 'mode' => 'qrcode', 'author' => '梓豪'];
            // var_dump($item);
        }
        QrcodeLogicFacade::insertItems($items);
    }
}

function object_to_array($obj)
{
    $obj = (array) $obj;
    foreach ($obj as $k => $v) {
        if (gettype($v) == 'resource') {
            return;
        }
        if (gettype($v) == 'object' || gettype($v) == 'array') {
            $obj[$k] = (array) object_to_array($v);
        }
    }

    return $obj;
}
