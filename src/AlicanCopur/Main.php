<?php

declare(strict_types=1);

namespace AlicanCopur;

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
			$cfg->set("Ev2", "Yok");
			$cfg->set("Ev3", "Yok");
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
		if($cmd->getName() == "sethome"){
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
		if($cmd->getName() == "sethome2"){
		  if($o->hasPermission("sethome.2"){
			$x = $oyuncu->getX();
			$y = $oyuncu->getY();
			$z = $oyuncu->getZ();
			$dunya = $oyuncu->getLevel()->getName();
			$cfg = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$cfg->set("Ev2", "Var");
			$cfg->set("X2", $x);
			$cfg->set("Y2", $y);
			$cfg->set("Z2", $z);
			$cfg->set("Dunya2", $dunya);
			$oyuncu->sendMessage("§7» §a2. Evin X: $x Y: $y Z: $z kordinatlarına belirlendi!");
			$cfg->save();
		  } else {
			$oyuncu->sendMessage("§7» §c2. Sethome'yi sadece VIP ve HVIP'ler kullanabilir.");
		  }
		}
		if($cmd->getName() == "sethome3"){
		  if($o->hasPermission("sethome.3"){
			$x = $oyuncu->getX();
			$y = $oyuncu->getY();
			$z = $oyuncu->getZ();
			$dunya = $oyuncu->getLevel()->getName();
			$cfg = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$cfg->set("Ev3", "Var");
			$cfg->set("X3", $x);
			$cfg->set("Y3" $y);
			$cfg->set("Z3", $z);
			$cfg->set("Dunya3", $dunya);
			$oyuncu->sendMessage("§7» §a3. Evin X: $x Y: $y Z: $z kordinatlarına belirlendi!");
			$cfg->save();
		  } else {
			$oyuncu->sendMessage("§7» §c3. Sethome'yi sadece HVIP'ler kullanabilir.");
		  }
		}
		if($cmd->getName() == "home"){
			$ac = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$ev = $ac->get("Ev");
			if($ev == "Yok"){
				$oyuncu->sendMessage("§7» §cEv belirlememişsiniz!");
			} else {
				$oyuncu->teleport(new Position($ac->get("X"), $ac->get("Y"), $ac->get("Z"), $this->getServer()->getLevelByName($ac->get("Dunya"))));
			}
		}
		if($cmd->getName() == "home2"){
			$ac = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$ev = $ac->get("Ev2");
			if($ev == "Yok"){
				$oyuncu->sendMessage("§7» §c2. Evi belirlememişsiniz!");
			} else {
				$oyuncu->teleport(new Position($ac->get("X2"), $ac->get("Y2"), $ac->get("Z2"), $this->getServer()->getLevelByName($ac->get("Dunya2"))));
			}
		}
		if($cmd->getName() == "home3"){
			$ac = new Config($this->getDataFolder().$isim.".yml", Config::YAML);
			$ev = $ac->get("Ev3");
			if($ev == "Yok"){
				$oyuncu->sendMessage("§7» §c3. Evi belirlememişsiniz!");
			} else {
				$oyuncu->teleport(new Position($ac->get("X3"), $ac->get("Y3"), $ac->get("Z3"), $this->getServer()->getLevelByName($ac->get("Dunya3"))));
			}
		}
		return true;
	}
}
