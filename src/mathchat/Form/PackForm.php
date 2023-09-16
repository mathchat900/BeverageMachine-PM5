<?php

namespace mathchat\Form;

use customiesdevs\customies\item\CustomiesItemFactory;
use jojoe77777\FormAPI\SimpleForm;
use mathchat\Main;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use onebone\economyapi\EconomyAPI;

class PackForm
{
    public Main $instance;

    public function OnInteractFirst(Player $player): void
    {
        $fanta = CustomiesItemFactory::getInstance()->get("machine:fanta");
        $coca = CustomiesItemFactory::getInstance()->get("machine:coca");
        $orangina = CustomiesItemFactory::getInstance()->get("machine:orangina");
        $icetea = CustomiesItemFactory::getInstance()->get("machine:lipton");
        $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        $form = new SimpleForm(function (Player $player, $data) use ($coca, $icetea, $orangina, $fanta) {
            if($data === null) {
                return true;
            }
            switch ($data) {
                case 0:
                    $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
                    $amount = $this->config->get("prix-coca");
                    if(EconomyAPI::getInstance()->myMoney($player->getName()) >= $amount && $amount > 0) {
                        EconomyAPI::getInstance()->reduceMoney($player->getName(), $amount);
                        $player->sendMessage($this->config->get("text-coca"));
                        $player->getInventory()->addItem($coca);
                    } else $player->sendMessage($this->config->get("no-money-coca"));
                    break;
                case 1:
                    $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
                    $amount = $this->config->get("prix-lipton");
                    if(EconomyAPI::getInstance()->myMoney($player->getName()) >= $amount && $amount > 0) {
                        EconomyAPI::getInstance()->reduceMoney($player->getName(), $amount);
                        $player->sendMessage($this->config->get("text-lipton"));
                        $player->getInventory()->addItem($icetea);
                    } else $player->sendMessage($this->config->get("no-money-lipton"));
                    break;
                case 2:
                    $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
                    $amount = $this->config->get("prix-orangina");
                    if(EconomyAPI::getInstance()->myMoney($player->getName()) >= $amount && $amount > 0) {
                        EconomyAPI::getInstance()->reduceMoney($player->getName(), $amount);
                    $player->sendMessage($this->config->get("text-Orangina"));
                    $player->getInventory()->addItem($orangina);
                    } else $player->sendMessage($this->config->get("no-money-orangina"));
                    break;
                case 3:
                    $this->config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
                    $amount = $this->config->get("prix-fanta");
                    if(EconomyAPI::getInstance()->myMoney($player->getName()) >= $amount && $amount > 0) {
                    $player->sendMessage($this->config->get("text-Fanta"));
                    $player->getInventory()->addItem($fanta);
                    } else $player->sendMessage($this->config->get("no-money-fanta"));
                    break;
            }
            return false;
        });


        $form->setTitle($this->config->get("title-menu"));
        $form->setContent($this->config->get("content-menu"));
        $form->addButton("§aCoca-Cola");
        $form->addButton("§aLipton");
        $form->addButton("§aOrangina");
        $form->addButton("§aFanta");
        $form->addButton($this->config->get("close-menu"));
        $player->sendForm($form);
    }

}