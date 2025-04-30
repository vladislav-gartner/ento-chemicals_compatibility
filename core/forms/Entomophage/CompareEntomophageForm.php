<?php

namespace core\forms\Entomophage;

use Yii;
use core\entities\Compare\Compare;
use core\entities\Entomophage\Entomophage;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CompareEntomophageForm extends Model
{
    public $existing = [];

    public function __construct(Compare $compare = null, $config = [])
    {
        if ($compare) {
            $this->existing = ArrayHelper::getColumn($compare->compareEntomophageAssignments, 'entomophage_id');
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
            'existing' => Yii::t('app', 'Existing Entomophage'),
        ];
    }

    public function entomophagesList(): array
    {
        return ArrayHelper::map(
            Entomophage::find()->active()->orderBy(['name' => SORT_ASC])->asArray()->all(),
            'id', 'name'
        );
    }
}
