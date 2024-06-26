<?php

namespace SerenitySun\WorldWorker\form\component;

use SerenitySun\WorldWorker\form\lib\element\Dropdown;
use SerenitySun\WorldWorker\WorldManager;

trait WorldListComponent
{
    /**
     * @return Dropdown
     */
    public function getAllWorldsList(): Dropdown
    {
        return new Dropdown('select world', WorldManager::getAllWorlds());
    }


    /**
     * @return Dropdown|null
     */
    public function getUnloadedWorlds(): ?Dropdown
    {
        $worldList = WorldManager::getWorldList(WorldManager::STATUS_UNLOADED);
        if (empty($worldList)) {
            return null;
        }

        return new Dropdown('select world', $worldList);
    }


    /**
     * @return Dropdown|null
     */
    public function getLoadedWorlds(): ?Dropdown
    {
        $worldList = WorldManager::getWorldList();
        if (empty($worldList)) {
            return null;
        }

        return new Dropdown('select world', $worldList);
    }
}
