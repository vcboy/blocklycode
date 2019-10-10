<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wx_items_watermark".
 *
 * @property integer $watermarkId
 * @property string $watermarkName
 * @property string $description
 * @property string $coordinate
 * @property string $scale
 */
class ItemsWatermark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_items_watermark';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['watermarkId'], 'required'],
            [['watermarkId'], 'integer'],
            [['watermarkName', 'description', 'coordinate', 'scale'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'watermarkId' => 'Watermark ID',
            'watermarkName' => 'Watermark Name',
            'description' => 'Description',
            'coordinate' => 'Coordinate',
            'scale' => 'Scale',
        ];
    }
}
