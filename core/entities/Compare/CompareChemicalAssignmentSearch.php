<?php

namespace core\entities\Compare;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompareChemicalAssignmentSearch extends CompareChemicalAssignment
{
    public function rules(): array
    {
        return [
            [['compare_id', 'chemical_id'], 'integer'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = CompareChemicalAssignment::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'compare_id' => $this->compare_id,
                    'chemical_id' => $this->chemical_id,
                ]);

        return $dataProvider;
    }

    public function compareList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Compare\Compare::find()->all(), 'id', 'id');
    }

    public function chemicalList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Chemical\Chemical::find()->all(), 'id', 'name');
    }
}
