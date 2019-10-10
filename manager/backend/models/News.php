<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $content
 * @property string $attachment
 * @property integer $datetime
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required','message'=>'{attribute}不能为空'],
            [['datetime'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['content'], 'string'],
            [['attachment'], 'string', 'max' => 255],
            [['pic'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'attachment' => '附件',
            'datetime' => '日期',
            'pic' => '图片',
        ];
    }

    public function upload()
    {
        $main_name=date('YmHis'.'-'.rand(100,999));
        $tofilename = Yii::$app->basePath.'/uploads/' . $main_name . '.' . $this->pic->extension;
        $this->pic->saveAs($tofilename);
        return '/uploads/' . $main_name . '.' . $this->pic->extension;
    }
}
