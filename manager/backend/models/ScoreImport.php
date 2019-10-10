<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class ScoreImport extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file,$plan_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['plan_id'], 'required','message'=>'{attribute}不能为空'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls, xlsx' /*'mimeTypes' => 'image/jpeg, image/png',*/],
            [['plan_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'plan_id' => '所属活动',
            'file' => '数据导入',
        ];
    }
}