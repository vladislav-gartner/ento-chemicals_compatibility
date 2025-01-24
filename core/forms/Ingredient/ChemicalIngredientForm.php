<?php

namespace core\forms\Ingredient;

use Yii;
use core\entities\Chemical\Chemical;
use core\entities\Ingredient\Ingredient;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ChemicalIngredientForm extends Model
{
    public $existing = [];

    public function __construct(Chemical $chemical = null, $config = [])
    {
        if ($chemical) {
            $this->existing = ArrayHelper::getColumn($chemical->chemicalIngredientAssignments, 'ingredient_id');
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
            'existing' => Yii::t('app', 'Existing Ingredient'),
        ];
    }

    public function ingredientsList(): array
    {
        return ArrayHelper::map(
            Ingredient::find()->active()->orderBy('name')->asArray()->all(),
            'id', 'name'
        );
    }
}
