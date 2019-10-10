<?php

namespace backend\controllers;
use Yii;
use backend\models\Course;

class LiveController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * wap端
     * @return [type] [description]
     */
    public function actionWap($id){
    	$this->layout = '@app/views/layouts/qcloudwmain.php';
        //$id = $request = \Yii::$app->request->get('room_id');
        /*$list = \Yii::$app->db->createCommand("select streamId, flv_address, hls_address from live_channel_detail where id = :id ", [':id' => $id])->queryAll();
        $streamId = $list[0]['streamId'];
        $flv = $list[0]['flv_address'];
        $m3u8 = $list[0]['hls_address'];*/
        //$model = Course::findOne($id);
        
        $params = $this->getLiveParam($id);
        return $this->render('wap', [
            //'channel_id' => $streamId,
            //'app_id' => '1252754321',
            //'app_id' => '1252719046',
            /*'m3u8' => $m3u8,
            'flv' => $flv,*/
            'model' => $params,
            'room_id' => $id
        ]);
    }

    /**
     * web端
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionWeb($id){
    	$this->layout = '@app/views/layouts/qcloudwmain.php';
        
        $params = $this->getLiveParam($id);
        return $this->render('web', [
            'model' => $params,
            'room_id' => $id
        ]);
    }

    protected function getLiveParam($id){
    	$model = Course::findOne($id);
    	$streamId = $model['streamId']; //直播码
        $live_server = Yii::$app->params['live_server_play'];
        $bizId = Yii::$app->params['bizId'];
    	$params = [
    		'flv' => "http://" . $bizId . $live_server . $streamId . ".flv",
    		'm3u8' => "http://" . $bizId . $live_server . $streamId . ".m3u8",
    		'rtmp' => "rtmp://" . $bizId . $live_server . $streamId,
    		'model' => $model
    	];
    	return $params;
    }

}
