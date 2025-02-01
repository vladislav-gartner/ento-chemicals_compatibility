<?php

namespace core\entities\Compare;

use Yii;
use core\entities\User\User;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Compare]].
 *
 * @see Compare
 */
class CompareQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * {@inheritdoc}
     * @return Compare[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Compare|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this|CompareQuery
     */
    public function main(): ActiveQuery
    {
        if ($this->currentUser) {
            return $this->andFilterWhere(['user_id' => $this->currentUser->id]);
        }
        return $this;
    }

    /**
     * @param User|null $user
     * @return $this|CompareQuery
     */
    public function user(?User $user = null): ActiveQuery
    {
        if ($user) {
            return $this->andFilterWhere(['user_id' => $user->id]);
        }
        return $this;
    }
}
