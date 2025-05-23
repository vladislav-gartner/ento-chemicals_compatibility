<?php

namespace core\entities\Entomophage;

use Yii;
use core\entities\Compare\Compare;
use core\entities\Compare\CompareEntomophageAssignment;
use core\entities\Compare\CompareEntomophageAssignmentQuery;
use core\entities\Compare\CompareQuery;
use core\entities\EntomophagePopup\EntomophagePopup;
use core\entities\EntomophagePopup\EntomophagePopupQuery;
use core\entities\Match\ChemicalEntomophageMatch;
use core\entities\Match\ChemicalEntomophageMatchQuery;
use core\traits\ModelTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "entomophage".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property ChemicalEntomophageMatch[] $chemicalEntomophageMatches
 * @property CompareEntomophageAssignment[] $compareEntomophageAssignments
 * @property Compare[] $compares
 * @property EntomophagePopup $entomophagePopup
 */
class Entomophage extends ActiveRecord
{
    use ModelTrait;

    public static function tableName(): string
    {
        return 'entomophage';
    }

    public static function create($name, $status): self
    {
        $entomophage = new static();
        $entomophage->name = $name;
        $entomophage->status = $status;
        return $entomophage;
    }

    public function edit($name, $status): void
    {
        $this->name = $name;
        $this->status = $status;
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getChemicalEntomophageMatches()
    {
        return $this->hasMany(ChemicalEntomophageMatch::className(), ['entomophage_id' => 'id']);
    }

    public function getCompareEntomophageAssignments()
    {
        return $this->hasMany(CompareEntomophageAssignment::className(), ['entomophage_id' => 'id']);
    }

    public function getCompares()
    {
        return $this->hasMany(Compare::className(), ['id' => 'compare_id'])->viaTable('compare_entomophage_assignment', ['entomophage_id' => 'id']);
    }

    public function getEntomophagePopup()
    {
        return $this->hasOne(EntomophagePopup::className(), ['entomophage_id' => 'id']);
    }

    public static function find(): EntomophageQuery
    {
        return new EntomophageQuery(get_called_class());
    }
}
