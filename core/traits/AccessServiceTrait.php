<?php


namespace core\traits;

use core\entities\Kit\Access;
use core\entities\Kit\AccessGroup;
use core\entities\Kit\AccessGroupAction;

trait AccessServiceTrait
{
    /**
     * @param int $project_id
     * @param string $className
     * @return AccessGroupAction[]|null
     */
    public function getActionsByClassName(int $project_id, string $className): ?array
    {
        /** @var Access $access */
        $access = $this->find($project_id, $className);

        if ($access){
            /** @var AccessGroup $accessGroup */
            $accessGroup = $access->getAccessGroup()->one();
            if ($accessGroup){
                return $accessGroup->getKitAccessGroupActions()->all();
            }
        }
        return null;
    }

    public function hasRules(int $project_id, string $className): bool
    {
        if ($access = $this->find($project_id, $className)){
            if ($access->getAccessGroup()->one()){
                return true;
            }
        }
        return false;
    }
}