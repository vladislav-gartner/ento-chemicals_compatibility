<?php

namespace core\services\match;

use core\entities\Match\Match;
use core\forms\match\MatchForm;
use core\repositories\match\MatchRepository;

class MatchService
{
    /** @var MatchRepository */
    protected $matches;

    /**
     * MatchService constructor
     * @var MatchRepository
     */
    public function __construct(MatchRepository $matches)
    {
        $this->matches = $matches;
    }

    public function find($id): ?Match
    {
        return $this->matches->find($id);
    }

    /**
     * @return Match[]
     */
    public function findAll(): array
    {
        return $this->matches->findAll();
    }

    public function create(MatchForm $form): Match
    {
        $match = Match::create(
            $form->name,
            $form->icon_class
        );
        $this->matches->save($match);
        return $match;
    }

    public function edit($id, MatchForm $form): void
    {
        $match = $this->matches->get($id);
        $match->edit(
            $form->name,
            $form->icon_class
        );
        $this->matches->save($match);
    }

    public function remove($id): void
    {
        $match = $this->matches->get($id);
        $this->matches->delete($match);
    }

    public function removeAll(): void
    {
        $this->matches->deleteAll();
    }

    public function truncate(): void
    {
        $this->matches->truncate();
    }

    public function getRepository(): MatchRepository
    {
        return $this->matches;
    }
}
