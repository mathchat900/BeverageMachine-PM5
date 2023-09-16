<?php

namespace mathchat;

use customiesdevs\customies\item\CustomiesItemFactory;
use mathchat\Command\SpawnCommand;
use mathchat\Entity\CustomEntity;
use mathchat\Items\Coca;
use mathchat\Items\Fanta;
use mathchat\Items\Lipton;
use mathchat\Items\Orangina;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\event\Listener;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\utils\Config;
use pocketmine\world\World;
use Symfony\Component\Filesystem\Path;

class Main extends PluginBase implements Listener
{

    public static self $instance;


    /**
     * @throws \ReflectionException
     */
    public function onEnable(): void
    {
        self::$instance = $this;
        $this->saveResource("TestEntity.geo.json");
        $this->saveResource("config.yml");
        $this->saveResource("texture_15.png");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("Drink Machine Pack.mcpack"); //texture pack is in progress
        $rpManager = $this->getServer()->getResourcePackManager();
        $rpManager->setResourceStack($rpManager->getResourceStack() + [new ZippedResourcePack(Path::join($this->getDataFolder(), "Drink Machine Pack.mcpack"))]);
        ($serverForceResources = new \ReflectionProperty($rpManager, "serverForceResources"))->setAccessible(true);
        $serverForceResources->setValue($rpManager, true);
        CustomiesItemFactory::getInstance()->registerItem(Fanta::class, "machine:fanta", "§6Fanta");
        CustomiesItemFactory::getInstance()->registerItem(Coca::class, "machine:coca", "§0Coca Cola");
        CustomiesItemFactory::getInstance()->registerItem(Orangina::class, "machine:orangina", "§eOrangina");
        CustomiesItemFactory::getInstance()->registerItem(Lipton::class, "machine:lipton", "§cLipton");
        //CustomiesItemFactory::getInstance()->registerItem(ToolsMachine::class, "machine:toolsmachine", "§6Machine Tool");
        EntityFactory::getInstance()->register(CustomEntity::class, function (World $world, CompoundTag $nbt): CustomEntity {
            return new CustomEntity(EntityDataHelper::parseLocation($nbt, $world), $nbt);
        }, ['Beverage Machine']);
        $this->getServer()->getCommandMap()->register("", new SpawnCommand());
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

    public function getConfig(): Config
    {
        return new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }



}