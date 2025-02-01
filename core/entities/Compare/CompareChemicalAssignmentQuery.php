<?php

namespace core\entities\Compare;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[CompareChemicalAssignment]].
 *
 * @see CompareChemicalAssignment
 */
class CompareChemicalAssignmentQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * {@inheritdoc}
     * @return CompareChemicalAssignment[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompareChemicalAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
