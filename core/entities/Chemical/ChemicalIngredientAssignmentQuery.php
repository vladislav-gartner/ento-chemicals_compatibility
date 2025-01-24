<?php

namespace core\entities\Chemical;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ChemicalIngredientAssignment]].
 *
 * @see ChemicalIngredientAssignment
 */
class ChemicalIngredientAssignmentQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * {@inheritdoc}
     * @return ChemicalIngredientAssignment[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChemicalIngredientAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
