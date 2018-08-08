<?php
/**
 * Created by PhpStorm.
 * User: zico
 * Date: 2018/7/30
 * Time: 下午6:37
 */

namespace app\admin\apiHandler;

use app\inforward\model\upload\UploadModel;
use think\Exception;
use think\facade\Request;
use think\File;

trait UploadApiHandler
{
    //  上传存放路径
    private $_uploadPath = '/static/uploads/';

    //  上传单个图片
    public function api_upload_img($datas)
    {
        try {
            $file = request()->file('img');
            $upFile = $this->_upload_file($file, 'imgs');
            $this->success('上传图片成功了', '', $upFile);
        } catch (Exception $exception) {
            $this->error('上传图片失败了', '', ['msg' => $exception->getMessage()]);
        }

//        // 获取表单上传文件 例如上传了001.jpg
//        $file = request()->file('image');
//        // 移动到框架应用根目录/uploads/ 目录下
//        $info = $file->move('../uploads');
//        if ($info) {
//            // 成功上传后 获取上传信息
//            // 输出 jpg
//            echo $info->getExtension();
//            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getSaveName();
//            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
//        } else {
//            // 上传失败获取错误信息
//            echo $file->getError();
//        }
    }

    //  上传单个文件 - 底层
    private function _upload_file(File $file, $path = '')
    {
        try {
            $info = $file->move('.' . $this->_uploadPath . $path . '/');
            if ($info) {
//                var_dump($info);
                $saveData = [
                    'file_title' => $info->getFilename(),
                    'file_name' => $info->getFilename(),
                    'file_type' => $info->getExtension(),
                    'relative_path' => substr($info->getPathname(), 1, strlen($info->getPathname())),
                    'author' => 'admin',
                    'group' => 'normal',
                    'create_date' => date("Y-m-d H:i:s", time()),
                ];
                (new UploadModel())->allowField(true)->save($saveData);
                $saveData['thumb'] = 'http://' . $_SERVER['SERVER_NAME'] . $saveData['relative_path'];
                return $saveData;

            } else {
                throw new Exception('保存文件失败');
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function api_get_uploads($datas, $needReturn = false)
    {
        try {
            $uploadModel = new UploadModel();
            $whereDatas = $uploadModel->fieldsFilterByDataTable($datas);
            $result = $uploadModel->where($whereDatas)->limit(40)->select();

            if ($needReturn) {
                return $result;
            }

            $successMsg = '成功获取上传文件';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '获取上传文件失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }

    /**
     * 获取多个素材
     * @param $datas
     */
    public function api_get_materials($datas)
    {
        try {
            $datas['group'] = 'material';
            $result = $this->api_get_uploads($datas, true);
            $successMsg = '成功获取素材';
            $this->success($successMsg, '', $result);
        } catch (Exception $exception) {
            $errorMsg = '获取素材失败';
            $this->error($errorMsg ?? $exception->getMessage(), '', ['msg' => $exception->getMessage()]);
        }
    }
}