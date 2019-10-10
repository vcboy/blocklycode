<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_course".
 *
 * @property integer $id
 * @property string $name
 * @property integer $channel_id
 * @property string $img
 * @property integer $price
 * @property string $teacher_name
 * @property string $description
 * @property string $desc
 * @property integer $bm_num
 * @property double $score
 * @property integer $status
 * @property integer $live_start_time
 * @property integer $live_end_time
 * @property integer $is_delete
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'channel_id', 'live_start_time', 'live_end_time'], 'required','message'=>'{attribute}不能为空'],
            [['price', 'bm_num',  'is_delete','channel_id'], 'integer'],
            [['description'], 'string'],
            [['score'], 'number'],
            [['name', 'img', 'teacher_name'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '课程ID',
            'name' => '直播名称',
            'channel_id' => '所属平台',
            'img' => '图片',
            'price' => '价格',
            'teacher_name' => '讲师',
            'description' => '详述',
            'desc' => '简介',
            'bm_num' => '报名人数',
            'audience_count' => '参与人数',
            'score' => '评分',
            'status' => '状态',
            'is_home' => '是否显示在前台',
            'live_start_time' => '直播开始时间',
            'live_end_time' => '直播结束时间',
            'create_time' => '添加日期',
        ];
    }
    public function getChannel(){
        return $this->hasOne(Platform::className(), ['id' => 'channel_id']);
    }
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['course_id' => 'id']);
    }

    public function getStatus($etime,$streamId){
        //0=>'未开始',1=>'直播中',2=>'直播完成']
        $status = 0;
        $time = time();
        if($time > $etime){
            $status = 2;
        }else{
            //$status = $this->getQcloudstatus($streamId);
            
        }
        return $status;
    }

    public function getQcloudstatus($streamId){
        $appid = Yii::$app->params['appid'];
        $interface = 'wx_Channel_GetStatus';
        $channel_id = $streamId;
        $key = Yii::$app->params['pushkey'];    //推流防盗链Key
        $t = time()+60;
        $sign = md5($key.$t);

        //$url = 'http://fcgi.video.qcloud.com/common_access?';
        $URL = "http://fcgi.video.qcloud.com/common_access?".
                "appid=" .$appid.
                "&interface=".$interface.
                "&Param.s.channel_id=".$channel_id.
                "&t=".$t.
                "&sign=".$sign;
        $res = json_decode(file_get_contents($URL),true);
        var_dump($res);
        exit();
        if($res['ret'] == 0)
        {
            //return json_encode(['msgcode'=>'0']);
            $status = $res['output']['status'];
        }else{
            //return json_encode(['msgcode'=>'1']);
            $status = 0;
        }
        return $status;
    }
}
