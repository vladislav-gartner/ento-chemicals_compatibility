<?php

namespace core\entities\Match;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class MatchSearch extends Match
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'icon_class'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Match::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'id' => $this->id,
                ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                    ->andFilterWhere(['like', 'icon_class', $this->icon_class]);

        return $dataProvider;
    }
}
