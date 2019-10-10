<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%jianding_table}}".
 *
 * @property integer $id
 * @property string $company
 * @property string $name
 * @property integer $sex
 * @property string $nation
 * @property string $birthday
 * @property string $sfz
 * @property string $bkzs
 * @property string $bkfx
 * @property string $zsdj
 * @property string $tel
 * @property string $education
 * @property string $job
 */
class Jianding extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%jianding_table}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'nation', 'birthday', 'sfz', 'tel', 'plan_id'], 'required','message'=>'{attribute}不能为空'],
            [['sex', 'plan_id'], 'integer'],
            [['education', 'job'], 'string'],
            [['score'], 'number'],
            [['company', 'bkfx'], 'string', 'max' => 128],
            [['name', 'sfz', 'bkzs', 'zsdj'], 'string', 'max' => 64],
            [['nation', 'birthday', 'tel'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_id' => '所属活动',
            'company' => '申报单位',
            'name' => '姓名',
            'sex' => '性别',
            'nation' => '民族',
            'birthday' => '生日',
            'sfz' => '身份证',
            'bkzs' => '报考证书',
            'bkfx' => '报考方向',
            'zsdj' => '证书等级',
            'tel' => '联系方式',
            'education' => '教育经历',
            'job' => '工作经历',
            'score' => '成绩',
            'is_pay' => '支付状态',
            'zs_id' => '招生人员',
        ];
    }

    public function getPlan(){
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    public function getZs(){
        return $this->hasOne(Admin::className(), ['id' => 'zs_id']);
    }

    public function getMember(){
        return $this->hasOne(Member::className(), ['cid' => 'sfz']);
    }


    //excel一次导出条数
    const EXCEL_SIZE = 10000;
    
    //统计导出
    public static function statistics($params){

        //导出时间条件
        if(empty($params['min'])){
            $date_max = date("Y-m-d",strtotime("-1 day"));
            $date_min = date("Y-m-d",strtotime("-31 day"));
        }else{
            $date_min = $params['min'];
            $date_max = $params['max'];
        }
        $where = 'is_delete=0';
        if(isset($params['plan_id'])){
            $where .= ' AND plan_id = '.$params['plan_id'];
        }
        if(isset($params['company'])){
            $where .= ' AND company like  "%'.$params['company'].'%"';
        }
        if(isset($params['name'])){
            $where .= ' AND name like  "%'.$params['name'].'%"';
        }
        if(isset($params['sex'])){
            $where .= ' AND sex =  "'.$params['sex'].'"';
        }
        if(isset($params['nation'])){
            $where .= ' AND nation like  "%'.$params['nation'].'%"';
        }

        //$where .= '(`issue_date` BETWEEN '.'\''.$date_min.'\''.' AND '.'\''.$date_max.'\')';

        //查找指定数据
        $sql = 'select * from wx_jianding_table WHERE  '.$where;
        $article = Jianding::findBySql($sql)->asArray()->all();
        //$article = ArrayHelper::index($article,null,'plan_id');
        $companys = [];
        
        foreach ($article as $key=>$v){
            if(empty($v['plan_id'])){
                continue;
            }else{
                $number         =   count($v);
                $plan_name        =   Plan::find()->where(['id'=>$v['plan_id']])->one()->name;
                //$company_name   =   $company['name'];
                //$cost           =   0;
                $sex   =   $v['sex'] == 1?'男':'女';
                

                //这里注意，数据的存储顺序要和输出的表格里的顺序一样
                $companys[] = [
                    //公司名
                    'plan_name'      =>  $plan_name,

                    //收入
                    'company'      =>  $v['company'],

                    //成本
                    'name'              =>  $v['name'],

                    //稿件数
                    'sex'               =>  $sex,

                    //毛利
                    'nation'      =>  $v['nation'],

                    //毛利率
                    'birthday' =>  $v['birthday'],

                    //ARPU值
                    'sfz'              =>  $v['sfz'],

                    'tel'              =>  $v['tel'],
                ];
            }
        }
        /*var_dump($companys);
        exit();*/
        return $companys;
    }
}
