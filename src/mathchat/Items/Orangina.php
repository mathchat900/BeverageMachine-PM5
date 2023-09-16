<?php

namespace mathchat\Items;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponentsTrait;
use customiesdevs\customies\item\ItemComponents;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class Orangina extends Item implements ItemComponents{
    use ItemComponentsTrait;
    public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
        parent::__construct($identifier, $name);
        $this->initComponent("orangina", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS));
    }
    public function getMaxStackSize() : int{
        return 1;
    }



}