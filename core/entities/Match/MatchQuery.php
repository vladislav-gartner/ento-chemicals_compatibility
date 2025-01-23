<?php

namespace core\entities\Match;

use Yii;
use core\traits\QueryTrait;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Match]].
 *
 * @see Match
 */
class MatchQuery extends ActiveQuery
{
    use QueryTrait;

    /**
     * {@inheritdoc}
     * @return Match[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Match|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
