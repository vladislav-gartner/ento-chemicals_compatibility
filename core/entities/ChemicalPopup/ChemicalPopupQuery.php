<?php

namespace core\entities\ChemicalPopup;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ChemicalPopup]].
 *
 * @see ChemicalPopup
 */
class ChemicalPopupQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null): ChemicalPopupQuery
    {
        return $this->andWhere([($alias ? $alias . '.' : '') . 'status' => 1]);
    }

    /**
     * {@inheritdoc}
     * @return ChemicalPopup[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChemicalPopup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
