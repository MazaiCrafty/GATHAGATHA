<?php

namespace awareness;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$plugin = "GATYAGATYA_Economy";
		$this->getLogger()->info(TextFormat::GREEN.$plugin."を読み込みました".TextFormat::BLUE." By awareness");
		$this->getLogger()->info(TextFormat::RED.$plugin."('ω')");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->EconomyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
	}

	public function onCommand(CommandSender $sender, Command $commamd, string $label, array $args): bool{
		if (!$sender instanceof Player){
			$sender->sendMessage(TextFormat::RED."[エラー] コマンドはゲーム内で使用してください");
			return true;
		}

		if ($command->getName() == "gta"){
			$subCommand = strtolower(array_shift($args));
			switch ($subCommand){
				case "help":
				$sender->sendMessage(
					"§6/gtaでガチャ\n".
					"§6/gta list でガチャリストを表示\n".
					"§6/gta helpでガチャのコマンド確認"
				);
				return true;
				
				case "list":
				$sender->sendMessage(
					"§a=============================================\n".
					"§bガチャリスト\n".
					"§6レアリスト\n".
					"§c鉄10個 金15個 コンパス1個\n"
					"§bノーマル\n".
					"§c原木64個 丸石64個 石炭32個 ガラス32個 ステーキ10個\n".
					"§cパン32個 鉄のピッケル1個 フェンス32個\n".
					"§dハズレリスト\n".
					"§cキノコ5個 苗木64個 松明32個\n".
					"§a============================================="
				);
				return true;

				case "":
				$name = $sender->getName();
				$money = $this->EconomyAPI->myMoney($name);
				if ($money < $price){
					$sender->sendMessage("[ガチャ]§4金が足りない!");
					return true;
				}

				$this->EconomyAPI->reduceMoney($name, $prise);
				$rand = rand(1, 13);
				switch($rand){
					case 1:				
					$diamond = Item::get(265, 0, 10);
					$sender->getInventory()->addItem($diamond);
					$sender->sendMessage("[ガチャ] §6レアの鉄が出てきたぞ!");
					break;

					case 2:
					$gold = Item::get(266, 0, 15);
					$sender->getInventory()->addItem($gold);
					$sender->sendMessage("[ガチャ] §6レアの金が出てきたぞ!");
					break;

					case 3:
					$iron = Item::get(17, 0, 64);
					$sender->getInventory()->addItem($iron);
					$sender->sendMessage("[ガチャ] §bノーマルの原木が出てきたぞ!");
					break;

					case 4:
					$coal = Item::get(4, 0, 64);
					$sender->getInventory()->addItem($coal);
					$sender->sendMessage("[ガチャ] §bノーマルの丸石が出てきたぞ!");
					break;

					case 5:
					$ssid = Item::get(263, 0, 32);
					$sender->getInventory()->addItem($ssid);
					$sender->sendMessage("[ガチャ] §bノーマルの石炭が出てきたぞ!");
					break;

					case 6:
					$glass = Item::get(20, 0, 32);
					$sender->getInventory()->addItem($glass);
					$sender->sendMessage("[ガチャ] §bノーマルのガラスが出てきたぞ!");
					break;

					case 7:
					$steak = Item::get(364, 0, 10);
					$sender->getInventory()->addItem($steak);
					$sender->sendMessage("[ガチャ] §bノーマルのステーキが出てきたぞ!");
					break;

				    case 8:
					$bread = Item::get(297, 0, 32);
					$sender->getInventory()->addItem($bread);
					$sender->sendMessage("[ガチャ] §bノーマルのパンが出てきたぞ!");
					break;

					case 9:
					$tpick = Item::get(257, 0, 1);
					$sender->getInventory()->addItem($tpick);
					$sender->sendMessage("[ガチャ]§bノーマルの鉄のピッケルが出てきたぞ!");
					break;

					case 10:
					$fenst = Item::get(85, 0, 32);
					$sender->getInventory()->addItem($fenst);
					$sender->sendMessage("[ガチャ] §bノーマルのフェンスが出てきたぞ!");
					break;

				    case 11:
					$kinoko = Item::get(40, 0, 5);
					$sender->getInventory()->addItem($kinoko);
					$sender->sendMessage("[ガチャ] §dハズレのキノコが出てきたぞ!");
					break;

					case 12:
					$naeki = Item::get(6, 0, 64);
					$sender->getInventory()->addItem($naeki);
					$sender->sendMessage("[ガチャ] §dハズレの苗木が出てきたぞ!");
					break;

					case 13:
					$torch = Item::get(50, 0, 32);
					$sender->getInventory()->addItem($torch);
					$sender->sendMessage("[ガチャ] §dハズレの松明が出てきたぞ!");
					break;
				}
				return true;

				default:
				$sender->sendMessage("\"§b/gta $subCommand\" というサブコマンドはありません");
				return true;
			}
		}
		return true;
	}
}
