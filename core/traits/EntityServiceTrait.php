<?php

namespace core\traits;


use core\entities\Kit\Entity;

trait EntityServiceTrait
{

    /**
     * @var array
     */
    protected $entity_buffer;

    /**
     * @var array
     */
    protected $controller_buffer;

    protected function createEntityDirectoryPool(): array
    {
        $entityDirectories = Entity::find()->asArray()->all();

        $result = [];
        foreach ($entityDirectories as $entityDirectory){

            $table = $entityDirectory['table'];
            $directory = $entityDirectory['directory'];

            $result[$table] = $directory;
        }

        return $result;
    }

    protected function createControllerDirectoryPool(): array
    {
        $entityDirectories = Entity::find()->asArray()->all();

        $result = [];
        foreach ($entityDirectories as $entityDirectory){

            $table = $entityDirectory['table'];
            $directory = $entityDirectory['directory_controller'];

            if (empty($directory) || empty($table)){
                continue;
            }

            $result[$table] = $directory;
        }

        return $result;
    }

    public function getEntityBuffer(): array
    {
        return $this->entity_buffer;
    }

    public function getControllerBuffer(): array
    {
        return $this->controller_buffer;
    }

    public function getByTable($project_id, $table): Entity
    {
        return $this->entities->getByTable($project_id, $table);
    }


}