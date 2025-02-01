<?php

namespace core\repositories\compare;

use core\entities\Compare\Compare;
use core\entities\Session\Session;
use core\entities\User\User;
use yii\base\Exception;

class CompareRepository
{
    public function get($id): Compare
    {
        if (!$compare = Compare::findOne($id)) {
            throw new \core\repositories\NotFoundException('Compare is not found.');
        }
        return $compare;
    }

    public function find($id): ?Compare
    {
        return Compare::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return Compare[]
     */
    public function findAll(): array
    {
        return Compare::find()->all();
    }

    public function findByUser(User $user): ?Compare
    {
        return Compare::findOne(['user_id' => $user->id]);
    }

    public function findAllByUser(User $user): array
    {
        return Compare::findAll(['user_id' => $user->id]);
    }

    public function findByFuture($user_id): ?Compare
    {
        $currentDate = date('Y-m-d');
        return Compare::find()
            ->where(['>=', 'created_at', strtotime($currentDate)])
            ->andWhere(['<', 'created_at', strtotime($currentDate . ' + 1 day')])
            ->andWhere(['user_id' => $user_id])
            ->one();
    }

    public function save(Compare $compare): void
    {
        if (!$compare->save()) {
            throw new \RuntimeException("Saving error. {$compare->plainErrors()}");
        }
    }

    public function delete(Compare $compare): void
    {
        if (!$compare->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        Compare::deleteAll();
    }

    public function insert($user_id, $created_at): bool
    {
        try {
            $model = new Compare();
            $model->user_id = $user_id;
            $model->created_at = $created_at;
            $model->save();
            return true;
        } catch (Exception $e) {
            throw new \RuntimeException('Insert error.');
        }
    }

    public function truncate(): void
    {
        Compare::clearAutoIncrement();
    }
}
