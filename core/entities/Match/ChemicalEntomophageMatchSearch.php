<?php

namespace core\entities\Match;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ChemicalEntomophageMatchSearch extends ChemicalEntomophageMatch
{
    public function rules(): array
    {
        return [
            [['id', 'chemical_id', 'entomophage_id', 'match_id'], 'integer'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = ChemicalEntomophageMatch::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'id' => $this->id,
                    'chemical_id' => $this->chemical_id,
                    'entomophage_id' => $this->entomophage_id,
                    'match_id' => $this->match_id,
                ]);

        return $dataProvider;
    }

    public function chemicalList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Chemical\Chemical::find()->all(), 'id', 'name');
    }

    public function entomophageList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Entomophage\Entomophage::find()->all(), 'id', 'name');
    }

    public function matchList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Match\Match::find()->all(), 'id', 'name');
    }
}
