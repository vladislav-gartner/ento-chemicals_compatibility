<?php

namespace core\entities\Compare;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompareEntomophageAssignmentSearch extends CompareEntomophageAssignment
{
    public function rules(): array
    {
        return [
            [['compare_id', 'entomophage_id'], 'integer'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = CompareEntomophageAssignment::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'compare_id' => $this->compare_id,
                    'entomophage_id' => $this->entomophage_id,
                ]);

        return $dataProvider;
    }

    public function compareList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Compare\Compare::find()->all(), 'id', 'id');
    }

    public function entomophageList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Entomophage\Entomophage::find()->all(), 'id', 'name');
    }
}
