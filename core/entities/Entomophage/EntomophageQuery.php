<?php

namespace core\entities\Entomophage;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Entomophage]].
 *
 * @see Entomophage
 */
class EntomophageQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null): EntomophageQuery
    {
        return $this->andWhere([($alias ? $alias . '.' : '') . 'status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return Entomophage[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Entomophage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
