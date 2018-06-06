<?php

namespace app\inforward\controller;

use think\Controller;
use app\inforward\logic\QrcodeLogic;

header("Access-Control-Allow-Origin:*");

class QrcodeApi extends Controller
{
    use \app\inforward\logic\BaseController;
    use \app\inforward\logic\QrcodeLogic;

    public function index()
    {
        echo '本模块是用于二维码资产管理的';
    }

    /**
     * get_qrcode
     * @return void
     */
    public function get_qrcode()
    {

        $params = $this->getParam($this->request->param(), ['union_id']);
//        try {
//            $item = \app\inforward\logic\QrcodeLogic::getItem($params['union_id']);
//            return json($item, 200);
//
//        } catch (Exception $e) {
//            return json($e->getMessage(), 404);
//
//        }

    }

    public function get_qrcode_items()
    {
        $num = $this->request->param('num', 20);

        $qrcodes = $this->getItems($num);

        return json($qrcodes, 200);
    }

    public function set_batch_qrcodes()
    {
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
