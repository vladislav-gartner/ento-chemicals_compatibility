<?php

namespace core\entities\EntomophagePopup;

use Yii;
use core\entities\Entomophage\Entomophage;
use core\entities\Entomophage\EntomophageQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "entomophage_popup".
 *
 * @property int $id
 * @property int $entomophage_id
 * @property string $content
 * @property int $status
 *
 * @property Entomophage $entomophage
 */
class EntomophagePopup extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'entomophage_popup';
    }

    public static function create($entomophage_id, $content, $status): self
    {
        $entomophagePopup = new static();
        $entomophagePopup->entomophage_id = $entomophage_id;
        $entomophagePopup->content = $content;
        $entomophagePopup->status = $status;
        return $entomophagePopup;
    }

    public function edit($entomophage_id, $content, $status): void
    {
        $this->entomophage_id = $entomophage_id;
        $this->content = $content;
        $this->status = $status;
    }

    public function rules(): array
    {
        return [
            [['entomophage_id', 'content'], 'required'],
            [['entomophage_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['entomophage_id'], 'unique'],
            [['entomophage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entomophage::className(), 'targetAttribute' => ['entomophage_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entomophage_id' => Yii::t('app', 'Entomophage ID'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getEntomophage()
    {
        return $this->hasOne(Entomophage::className(), ['id' => 'entomophage_id']);
    }

    public static function find(): EntomophagePopupQuery
    {
        return new EntomophagePopupQuery(get_called_class());
    }
}
