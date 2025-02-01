<?php

namespace core\entities\Compare;

use core\entities\User\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompareSearch extends Compare
{
    public function rules(): array
    {
        return [
            [['id', 'user_id'], 'integer'],
        ];
    }

    public function search(array $params, ?User $user = null): ActiveDataProvider
    {
        $query = Compare::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);
        if (!$this->validate()) {return $dataProvider;}

        $query->andFilterWhere([
                    'id' => $this->id,

                    'created_at' => $this->created_at,
                ]);

        if ($user) {
            $query->andFilterWhere(['user_id' => $user->id]);
        } else {
            $query->andFilterWhere(['user_id' => $this->user_id]);
        }

        return $dataProvider;
    }

    public function userList(): array
    {
        return \yii\helpers\ArrayHelper::map(\core\entities\User\User::find()->all(), 'id', 'username');
    }
}
