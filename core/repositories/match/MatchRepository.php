<?php

namespace core\repositories\match;

use core\entities\Match\Match;

class MatchRepository
{
    public function get($id): Match
    {
        if (!$match = Match::findOne($id)) {
            throw new \core\repositories\NotFoundException('Match is not found.');
        }
        return $match;
    }

    public function getByName($name): Match
    {
        if (!$match = Match::findOne(['name' => $name])) {
            throw new \core\repositories\NotFoundException('Match is not found.');
        }
        return $match;
    }

    public function find($id): ?Match
    {
        return Match::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @return Match[]
     */
    public function findAll(): array
    {
        return Match::find()->all();
    }

    public function findByName($name): ?Match
    {
        return Match::findOne(['name' => $name]);
    }

    public function save(Match $match): void
    {
        if (!$match->save()) {
            throw new \RuntimeException("Saving error. {$match->plainErrors()}");
        }
    }

    public function delete(Match $match): void
    {
        if (!$match->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function deleteAll(): void
    {
        Match::deleteAll();
    }

    public function truncate(): void
    {
        Match::clearAutoIncrement();
    }
}
