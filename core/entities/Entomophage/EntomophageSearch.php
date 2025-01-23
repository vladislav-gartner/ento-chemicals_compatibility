<?php

namespace core\entities\Entomophage;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class EntomophageSearch extends Entomophage
{
    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Entomophage::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'id' => $this->id,
                    'status' => $this->status,
                ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
