<?php

namespace core\services\entomophagepopup;

use core\entities\EntomophagePopup\EntomophagePopup;
use core\forms\entomophagepopup\EntomophagePopupForm;
use core\repositories\entomophagepopup\EntomophagePopupRepository;

class EntomophagePopupService
{
    /** @var EntomophagePopupRepository */
    protected $entomophagePopups;

    /**
     * EntomophagePopupService constructor
     * @var EntomophagePopupRepository
     */
    public function __construct(EntomophagePopupRepository $entomophagePopups)
    {
        $this->entomophagePopups = $entomophagePopups;
    }

    public function find($id): ?EntomophagePopup
    {
        return $this->entomophagePopups->find($id);
    }

    /**
     * @return EntomophagePopup[]
     */
    public function findAll(): array
    {
        return $this->entomophagePopups->findAll();
    }

    public function create(EntomophagePopupForm $form): EntomophagePopup
    {
        $entomophagePopup = EntomophagePopup::create(
            $form->entomophage_id,
            $form->content,
            $form->status
        );
        $this->entomophagePopups->save($entomophagePopup);
        return $entomophagePopup;
    }

    public function edit($id, EntomophagePopupForm $form): void
    {
        $entomophagePopup = $this->entomophagePopups->get($id);
        $entomophagePopup->edit(
            $form->entomophage_id,
            $form->content,
            $form->status
        );
        $this->entomophagePopups->save($entomophagePopup);
    }

    public function remove($id): void
    {
        $entomophagePopup = $this->entomophagePopups->get($id);
        $this->entomophagePopups->delete($entomophagePopup);
    }

    public function removeAll(): void
    {
        $this->entomophagePopups->deleteAll();
    }

    public function truncate(): void
    {
        $this->entomophagePopups->truncate();
    }

    public function getRepository(): EntomophagePopupRepository
    {
        return $this->entomophagePopups;
    }
}
