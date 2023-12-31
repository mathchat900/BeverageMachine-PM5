<?php

namespace mathchat\Entity;

use JsonException;
use mathchat\Form\PackForm;
use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\event\Listener;
use pocketmine\item\ItemTypeIds;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;
use mathchat\Main;
use pocketmine\utils\Config;

class CustomEntity extends Human implements Listener {
    private Config $config;

    /**
     * @throws JsonException
     */
    public function __construct(Location $location, ?CompoundTag $nbt = null)
    {
        $sdata = $this->PNGtoBYTES(Main::getInstance()->getDataFolder() ."texture_15.png");
        $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        $gdata = file_get_contents(Main::getInstance()->getDataFolder() . "TestEntity.geo.json");
        $this->setNoDamageTicks();
        $this->setNameTagAlwaysVisible(true);
        $this->setNameTag($this->config->get("title-machine"));

        parent::__construct($location, new Skin("Beverage Machine", $sdata, "", "geometry.TestEntity",$gdata), $nbt);
    }

    public function onInteract(Player $player, Vector3 $clickPos): bool
    {
        if ($player->getInventory()->getItemInHand()->getTypeId() === ItemTypeIds::DISC_FRAGMENT_5) {
            $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
            $this->flagForDespawn();
            $player->sendMessage($this->config->get("break-machine"));
            return false;
        }
        $PlayerForm = new PackForm();
        $PlayerForm->onInteractFirst($player);
        return parent::onInteract($player, $clickPos);
    }

    public function onUpdate(int $currentTick): bool
    {
        $this->setNoDamageTicks();
        return parent::onUpdate($currentTick); // TODO: Change the autogenerated stub
    }

    public function PNGtoBYTES($path) : string
    {
        $img = @imagecreatefrompng($path);
        $bytes = "";
        for ($y = 0; $y < (int)@getimagesize($path)[1]; $y++) {
            for ($x = 0; $x < (int)@getimagesize($path)[0]; $x++) {
                $rgba = @imagecolorat($img, $x, $y);
                $bytes .= chr(($rgba >> 16) & 0xff) . chr(($rgba >> 8) & 0xff) . chr($rgba & 0xff) . chr(((~($rgba >> 24)) << 1) & 0xff);
            }
        }
        @imagedestroy($img);
        return $bytes;
    }

    public function setNoDamageTicks(): void
    {
        $this->noDamageTicks = PHP_INT_MAX;
    }



}