<?php

namespace core\entities\Chemical;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ChemicalIngredientAssignmentSearch extends ChemicalIngredientAssignment
{
    public function rules(): array
    {
        return [
            [['chemical_id', 'ingredient_id'], 'integer'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = ChemicalIngredientAssignment::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'chemical_id' => $this->chemical_id,
                    'ingredient_id' => $this->ingredient_id,
                ]);

        return $dataProvider;
    }

    public function chemicalList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Chemical\Chemical::find()->all(), 'id', 'name');
    }

    public function ingredientList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Ingredient\Ingredient::find()->all(), 'id', 'name');
    }
}
