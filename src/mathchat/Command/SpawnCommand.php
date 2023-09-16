<?php

namespace mathchat\Command;

use mathchat\Entity\CustomEntity;
use mathchat\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\item\ItemTypeIds;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class SpawnCommand extends Command implements Listener {

    public function __construct()
    {
        $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        parent::__construct("spawnentity", $this->config->get("command-description"), "/spawnentity", ['spawnentity']);
        $perm = new Permission("spawnentity.cmd");
        PermissionManager::getInstance()->addPermission($perm);
        $this->setPermission("spawnentity.cmd");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
            $entity = new CustomEntity($sender->getLocation());
            $entity->spawnToAll();

            $sender->sendMessage($this->config->get("command-success-placed-entity"));
        }
        else{
            $sender->sendMessage($this->config->get("command-permission"));
        }


    }

}