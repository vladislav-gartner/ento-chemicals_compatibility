<?php

namespace core\services\compare;

use Yii;
use core\entities\Compare\Compare;
use core\entities\User\User;
use core\forms\compare\CompareForm;
use core\repositories\chemical\ChemicalRepository;
use core\repositories\compare\CompareRepository;
use core\repositories\entomophage\EntomophageRepository;
use core\repositories\user\UserRepository;
use core\services\TransactionManager;

class CompareService
{
    /** @var User */
    protected $currentUser;

    /** @var CompareRepository */
    protected $compares;

    /** @var ChemicalRepository */
    protected $chemicals;

    /** @var EntomophageRepository */
    protected $entomophages;

    /** @var TransactionManager */
    protected $transaction;

    /** @var UserRepository */
    protected $users;

    /**
     * CompareService constructor
     * @var CompareRepository
     * @var ChemicalRepository
     * @var EntomophageRepository
     * @var TransactionManager
     * @var UserRepository
     */
    public function __construct(
        CompareRepository $compares,
        ChemicalRepository $chemicals,
        EntomophageRepository $entomophages,
        TransactionManager $transaction,
        UserRepository $users
    ) {
        $this->compares = $compares;
        $this->chemicals = $chemicals;
        $this->entomophages = $entomophages;
        $this->transaction = $transaction;
        $this->users = $users;

        if (!Yii::$app->user->isGuest) {
            $this->currentUser = Yii::$app->user->identity->getUser();
        }
    }

    public function find($id): ?Compare
    {
        return $this->compares->find($id);
    }

    public function findByUser(User $user): ?Compare
    {
        return $this->compares->findByUser($user);
    }

    /**
     * @return Compare[]
     */
    public function findAllByUser(User $user): array
    {
        return $this->compares->findAllByUser($user);
    }

    /**
     * @return Compare[]
     */
    public function findAll(): array
    {
        return $this->compares->findAll();
    }

    public function create(CompareForm $form): Compare
    {
        $compare = Compare::create(
            $form->user_id,
            $form->created_at
        );

        $this->bindChemicals($form, $compare);

        $this->bindEntomophages($form, $compare);

        $this->transaction->wrap(function () use ($form, $compare) {
            $this->compares->save($compare);
        });
        return $compare;
    }

    public function edit($id, CompareForm $form): void
    {
        $compare = $this->compares->get($id);
        $compare->edit(
            $form->user_id,
            $form->created_at
        );

        $this->transaction->wrap(function () use ($form, $compare) {

            $compare->revokeChemicals();
            $this->compares->save($compare);

            $this->bindChemicals($form, $compare);

            $compare->revokeEntomophages();
            $this->compares->save($compare);

            $this->bindEntomophages($form, $compare);

            $this->compares->save($compare);
        });
    }

    public function remove($id): void
    {
        $compare = $this->compares->get($id);
        $this->compares->delete($compare);
    }

    public function removeAll(): void
    {
        $this->compares->deleteAll();
    }

    public function truncate(): void
    {
        $this->compares->truncate();
    }

    public function insert($user_id, $created_at): bool
    {
        return $this->compares->insert(
            $user_id,
            $created_at
        );
    }

    public function getOrInsert($user_id, $created_at): ?Compare
    {
        $compare = $this->compares->findByFuture($user_id);
        if (!$compare instanceof Compare) {
            $this->insert($user_id, $created_at);
            return $this->compares->findByFuture($user_id);
        }
        return $compare;
    }

    public function getRepository(): CompareRepository
    {
        return $this->compares;
    }

    public function bindChemicals(CompareForm $form, Compare $compare)
    {
        foreach ($form->chemicals->existing as $id) {
            $chemical = $this->chemicals->get($id);
            $compare->assignChemical($chemical->id);
        };
    }

    public function bindEntomophages(CompareForm $form, Compare $compare)
    {
        foreach ($form->entomophages->existing as $id) {
            $entomophage = $this->entomophages->get($id);
            $compare->assignEntomophage($entomophage->id);
        };
    }
}
