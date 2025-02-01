<?php

namespace core\entities\Compare;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[CompareEntomophageAssignment]].
 *
 * @see CompareEntomophageAssignment
 */
class CompareEntomophageAssignmentQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * {@inheritdoc}
     * @return CompareEntomophageAssignment[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompareEntomophageAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
