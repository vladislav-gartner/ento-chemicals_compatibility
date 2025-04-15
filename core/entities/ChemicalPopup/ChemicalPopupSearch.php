<?php

namespace core\entities\ChemicalPopup;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ChemicalPopupSearch extends ChemicalPopup
{
    public function rules(): array
    {
        return [
            [['id', 'chemical_id', 'status'], 'integer'],
            [['content'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = ChemicalPopup::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'id' => $this->id,
                    'chemical_id' => $this->chemical_id,
                    'status' => $this->status,
                ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

    public function chemicalList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Chemical\Chemical::find()->all(), 'id', 'name');
    }
}
