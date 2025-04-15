<?php

namespace core\entities\ChemicalPopup;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Chemical\ChemicalQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "chemical_popup".
 *
 * @property int $id
 * @property int $chemical_id
 * @property string $content
 * @property int $status
 *
 * @property Chemical $chemical
 */
class ChemicalPopup extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'chemical_popup';
    }

    public static function create($chemical_id, $content, $status): self
    {
        $chemicalPopup = new static();
        $chemicalPopup->chemical_id = $chemical_id;
        $chemicalPopup->content = $content;
        $chemicalPopup->status = $status;
        return $chemicalPopup;
    }

    public function edit($chemical_id, $content, $status): void
    {
        $this->chemical_id = $chemical_id;
        $this->content = $content;
        $this->status = $status;
    }

    public function rules(): array
    {
        return [
            [['chemical_id', 'content'], 'required'],
            [['chemical_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['chemical_id'], 'unique'],
            [['chemical_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chemical::className(), 'targetAttribute' => ['chemical_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chemical_id' => Yii::t('app', 'Chemical ID'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getChemical()
    {
        return $this->hasOne(Chemical::className(), ['id' => 'chemical_id']);
    }

    public static function find(): ChemicalPopupQuery
    {
        return new ChemicalPopupQuery(get_called_class());
    }
}
