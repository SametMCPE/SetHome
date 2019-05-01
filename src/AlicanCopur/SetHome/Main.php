<?php

declare(strict_types=1);

namespace AlicanCopur\SetHome;

// Alican Çopur, 2018 © Tüm hakları saklı falan değildir.
// İzinsiz dağıtılması yasaktır.

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\block\Block;

class Main extends PluginBase implements Listener {
	
	public function onJoin(PlayerJoinEvent $event){
		
		$sender = $event->getPlayer();
		$isim = $sender->getName();
		
		if(!is_file($this->getDataFolder().$isim.".yml")){
			$cfg = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$cfg->set("Ev", "Yok");
			$cfg->save();
		}
		
	}
	public function onEnable(){
		
		@mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
        
    }
    public function onCommand(CommandSender $oyuncu, Command $cmd, string $label, array $args):bool{
    	$isim = $oyuncu->getName();
    	$o = $oyuncu;
		if($cmd->getName() == "evolustur"){
			$x = $oyuncu->getX();
			$y = $oyuncu->getY();
			$z = $oyuncu->getZ();
			$dunya = $oyuncu->getLevel()->getName();
			$cfg = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$cfg->set("Ev", "Var");
			$cfg->set("X", $x);
			$cfg->set("Y", $y);
			$cfg->set("Z", $z);
			$cfg->set("Dunya", $dunya);
			$oyuncu->sendMessage("§7» §aEvin X: $x Y: $y Z: $z kordinatlarına belirlendi!");
			$cfg->save();
		}
		if($cmd->getName() == "ev"){
			$ac = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$ev = $ac->get("Ev");
			if($ev == "Yok"){
				$oyuncu->sendMessage("§7» §cEv belirlememişsiniz!");
			} else {
				$oyuncu->teleport(new Position($ac->get("X"), $ac->get("Y"), $ac->get("Z"), $this->getServer()->getLevelByName($ac->get("Dunya"))));
			}
		}
		return true;
	}
}
