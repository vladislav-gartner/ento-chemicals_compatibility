<?php

namespace core\entities\Match;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[ChemicalEntomophageMatch]].
 *
 * @see ChemicalEntomophageMatch
 */
class ChemicalEntomophageMatchQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * {@inheritdoc}
     * @return ChemicalEntomophageMatch[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChemicalEntomophageMatch|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
