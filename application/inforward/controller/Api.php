<?php
namespace app\inforward\controller;

use think\Controller;
use think\Facade\Config;
use think\Facade\Request;

// 加载api接口类
include_once '__DIR__/../../../../extend/weworkapi_php/api/src/CorpAPI.class.php';

class Api extends Controller
{
    private $_appKeys = ["oa_attendance" => "1234567"];

    protected $request, $wxapi;

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
        $result = $wxapi->GetUserInfoByCode($userCode);
        // dump($result);
        // return json($result);
        $user_ticket = $result->user_ticket;
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
        $userInfo = $wxapi->GetUserDetailByUserTicket($user_ticket);
        if (isset($userInfo->userid) && $userInfo->userid != null) {
            $userModel = new \app\inforward\model\users();
            $saveData = object_to_array($userInfo);
            unset($saveData['department']);
            unset($saveData['gender']);
            // dump($saveData);

            $res = $userModel->where(["userid" => $userInfo->userid])->select();
            if (count($res) < 1) {
                $userModel->save($saveData);
            } else {
                $userModel->where(["userid" => $userInfo->userid])->update($saveData);
            }
        }
        $saveData['user_ticket'] = $user_ticket;
        
        return json($saveData);
    }

    public function index()
    {
        return json_encode("yeah~");
    }

    private function _weixinApi_init()
    {
        $wxworkConfig = Config::get('app.wxwork_api');
        $corpId = $wxworkConfig['corp_id'];
        $corpConfig = Config::get('app.oa_attendance');
        $corpSecret = $corpConfig['app_secret'];
        return new \weworkapi_php\wxworkAPI('wwdc02ce3b575253e3', 'bLhYfEQsgz1zO5Y1kmoCQi_p96ZVCC65uRovbEX-qPM');
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

        return json_encode(isset($this->_appKeys[$token]) ? $this->_appKeys[$token] : null);
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
        $restDays = $userRestDaysModel->where("month",$dateTodayArray[1])->select();

        if(count($restDays) <1){
            $restDays = null;
        }

        return json($restDays);
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

    //  保存用户提交的休假事件
    public function set_user_attendance()
    {
        header("Access-Control-Allow-Origin:*");
        $oldRestDay = $this->request->param('old_day');
        $restDay = $this->request->param('rest_day');
        $userid = $this->request->param('user_id');

        $dateArray = explode("-", $restDay);

        $userRestDaysModel = new \app\inforward\model\userRestDays();
        $saveData = ['date' => $restDay, 'userid' => $userid, 'year' => $dateArray[0], 'month' => $dateArray[1], 'day' => $dateArray[2], 'status' => 'rest', 'create_time' => time()];
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
