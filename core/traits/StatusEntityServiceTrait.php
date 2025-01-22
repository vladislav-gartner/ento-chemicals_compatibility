<?php


namespace core\traits;


use core\entities\Kit\StatusBundle;
use core\entities\Kit\StatusBundleConstant;
use core\entities\Kit\StatusConstant;
use core\entities\Kit\StatusEntity;

trait StatusEntityServiceTrait
{

    public function findByEntity($project_id, $entity): ?StatusEntity
    {
        return $this->statusEntities->findByEntity($project_id, $entity);
    }

    /**
     * @param $project_id
     * @param string $className
     * @return StatusBundleConstant[]|null
     */
    public function getByClassName($project_id, string $className): ?array
    {
        /** @var StatusEntity $statusEntity */
        $statusEntity = $this->findByEntity(
            $project_id,
            $className
        );

        if ($statusEntity){

            /** @var StatusBundle $statusBundle */
            $statusBundle = $statusEntity->getStatusBundle()->one();

            if ($statusBundle){
                return $statusBundle->getKitStatusBundleConstants()->orderBy(['id' => SORT_ASC])->all();
            }

        }

        return null;
    }

    public function hasStatusBundle(int $project_id, string $className): bool
    {
        if ($statusEntity = $this->findByEntity(
            $project_id,
            $className
        )){
            if ($statusEntity->getStatusBundle()->one()){
                return true;
            }
        }

        return false;
    }

    public function getConstants(int $project_id, string $className): array
    {
        $bundleConstants = $this->getByClassName($project_id, $className);

        $result = [];
        foreach ($bundleConstants as $bundleConstant) {

            /** @var StatusConstant $constant */
            $constant = $bundleConstant->getStatusConstant()->one();
            $style = $constant->getStatusStyle()->one();

            $key = "{$className}::STATUS_{$constant->constant}";
            $value = $style->name;

            $result[$key] = $value;
        }

        return $result;
    }

    public function getDefaultConstantOrValue(int $project_id, string $className): string
    {
        $bundleConstants = $this->getByClassName($project_id, $className);

        foreach ($bundleConstants as $bundleConstant){
            if ($bundleConstant->isDefault()){
                /** @var StatusConstant $constant */
                $constant = $bundleConstant->getStatusConstant()->one();
                return "{$className}::STATUS_{$constant->constant}";
            }
        }

        return '1';
    }

    public function getDefaultConstants(int $project_id, string $className): array
    {
        $bundleConstants = $this->getByClassName($project_id, $className);

        $result = [];
        foreach ($bundleConstants as $bundleConstant) {
            if ($bundleConstant->isDefault()) {
                /** @var StatusConstant $constant */
                $constant = $bundleConstant->getStatusConstant()->one();
                $result[] = "{$className}::STATUS_{$constant->constant}";
            }
        }

        return $result;
    }

    public function getVisibleConstants(int $project_id, string $className): array
    {
        $bundleConstants = $this->getByClassName($project_id, $className);

        $result = [];
        if ($bundleConstants){
            foreach ($bundleConstants as $bundleConstant) {
                if (!$bundleConstant->isInvisible()) {
                    /** @var StatusConstant $constant */
                    $constant = $bundleConstant->getStatusConstant()->one();
                    $result[] = "{$className}::STATUS_{$constant->constant}";
                }
            }
        }

        return $result;
    }

}