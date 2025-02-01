<?php

namespace core\forms\Chemical;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Compare\Compare;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CompareChemicalForm extends Model
{
    public $existing = [];

    public function __construct(Compare $compare = null, $config = [])
    {
        if ($compare) {
            $this->existing = ArrayHelper::getColumn($compare->compareChemicalAssignments, 'chemical_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['existing', 'default', 'value' => []],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'existing' => Yii::t('app', 'Existing Chemical'),
        ];
    }

    public function chemicalsList(): array
    {
        return ArrayHelper::map(
            Chemical::find()->active()->orderBy('name')->asArray()->all(),
            'id', 'name'
        );
    }
}
