<?php

namespace core\entities\Chemical;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Chemical]].
 *
 * @see Chemical
 */
class ChemicalQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null): ChemicalQuery
    {
        return $this->andWhere([($alias ? $alias . '.' : '') . 'status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return Chemical[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Chemical|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
