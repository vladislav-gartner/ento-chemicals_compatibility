<?php

namespace core\readModels\match;

use core\entities\Match\ChemicalEntomophageMatch;
use core\entities\Match\ChemicalEntomophageMatchQuery;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\db\ActiveQuery;

class ChemicalEntomophageMatchReadRepository{

    public function count(): int
    {
        return ChemicalEntomophageMatch::find()->count();
    }

    public function find($id): ?ChemicalEntomophageMatch
    {
        return ChemicalEntomophageMatch::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @param $entomophage_id
     * @param $chemical_id
     * @return ChemicalEntomophageMatch
     */
    public function findByFuture($entomophage_id, $chemical_id): ?ChemicalEntomophageMatch
    {
        return ChemicalEntomophageMatch::find()
            ->andWhere([
                'entomophage_id' => $entomophage_id,
                'chemical_id' => $chemical_id
            ])
            ->with('chemical')
            ->one();
    }


    public function getAll(): DataProviderInterface
    {
        $query = ChemicalEntomophageMatch::find()->orderBy(['id' => SORT_DESC]);
        return $this->getProvider($query);
    }

    public function getAllByRange(int $offset, int $limit): DataProviderInterface
    {
        $query = ChemicalEntomophageMatch::find()
            ->orderBy(['id' => SORT_ASC])
            ->limit($limit)
            ->offset($offset);

        return $this->getProvider($query);
    }

    public function getMatches(ChemicalEntomophageMatchQuery $query, $pageSize = 20): array
    {
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $pageSize, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $records = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return [$pages, $records];
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSizeLimit' => [3, 20, 30, 50],
            ]
        ]);
    }
}