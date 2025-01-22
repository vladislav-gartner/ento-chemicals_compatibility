<?php

namespace core\entities\Ingredient;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Ingredient]].
 *
 * @see Ingredient
 */
class IngredientQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null): IngredientQuery
    {
        return $this->andWhere([($alias ? $alias . '.' : '') . 'status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return Ingredient[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ingredient|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
