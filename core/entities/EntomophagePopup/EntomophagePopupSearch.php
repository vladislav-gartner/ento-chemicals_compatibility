<?php

namespace core\entities\EntomophagePopup;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class EntomophagePopupSearch extends EntomophagePopup
{
    public function rules(): array
    {
        return [
            [['id', 'entomophage_id', 'status'], 'integer'],
            [['content'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = EntomophagePopup::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'id' => $this->id,
                    'entomophage_id' => $this->entomophage_id,
                    'status' => $this->status,
                ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

    public function entomophageList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\Entomophage\Entomophage::find()->all(), 'id', 'name');
    }
}
