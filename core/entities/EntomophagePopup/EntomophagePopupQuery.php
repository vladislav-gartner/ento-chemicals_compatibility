<?php

namespace core\entities\EntomophagePopup;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[EntomophagePopup]].
 *
 * @see EntomophagePopup
 */
class EntomophagePopupQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null): EntomophagePopupQuery
    {
        return $this->andWhere([($alias ? $alias . '.' : '') . 'status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return EntomophagePopup[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EntomophagePopup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
