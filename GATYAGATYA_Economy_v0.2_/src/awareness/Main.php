<?php

namespace awareness;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\event\Listener;

class Main extends PluginBase  implements Listener{
	public function onEnable()
	{
		$plugin = "GATYAGATYA_Economy";
		$this->getLogger()->info(TextFormat::GREEN.$plugin."を読み込みました".TextFormat::BLUE." By awareness");
		$this->getLogger()->info(TextFormat::RED.$plugin."('ω')");
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->EconomyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");//ここでEconomyAPI呼び出し
		if($this->EconomyAPI === null){
			$this->getLogger()->info(TextFormat::RED ."EconomyAPIがないのでサーバーを止めます");
			$this->getServer()->shutdown();
		}else{
			$this->getLogger()->info(TextFormat::AQUA."EconomyAPIを読み込みました");
		}
	}

	onCommand(CommandSender $sender, Command $commamd, string $label, array $args):bool
	{
		if($command->getName() == "gta"){
			if (!$sender instanceof Player) return $sender->sendMessage(TextFormat::RED."[エラー] コマンドはゲーム内で使用してください");
			$subCommand = strtolower(array_shift($args));
			switch ($subCommand){
/* ---------------------- コマンド ---------------------- */

				case "help":
				$sender->sendMessage("§6/gtaでガチャ");
				$sender->sendMessage("§6/gta list でガチャリストを表示");
				$sender->sendMessage("§6/gta helpでガチャのコマンド確認");
				break;
				
				case "list":
				$sender->sendMessage("§a=============================================");
				$sender->sendMessage("§bガチャリスト");
				$sender->sendMessage("§6レアリスト");
				$sender->sendMessage("§c鉄10個 金15個 コンパス1個");
				$sender->sendMessage("§bノーマル");
				$sender->sendMessage("§c原木64個 丸石64個 石炭32個 ガラス32個 ステーキ10個");
				$sender->sendMessage("§cパン32個 鉄のピッケル1個 フェンス32個 ");
				$sender->sendMessage("§dハズレリスト");
				$sender->sendMessage("§cキノコ5個 苗木64個 松明32個 ");
				$sender->sendMessage("§a=============================================");
				break;

				case "":
				$player = $sender->getPlayer();
				$name = $player->getName();
				$price = 600;//値段
				$diamond = Item::get(265, 0, 10);
				$gold = Item::get(266, 0, 15);
				$iron = Item::get(17, 0, 64);
				$coal = Item::get(4, 0, 64);
				$ssid = Item::get(263, 0, 32);
				$garas = Item::get(20, 0, 32);
				$stak = Item::get(364, 0, 10);
				$pan = Item::get(297, 0, 32);
				$tpick = Item::get(257, 0, 1);
				$fenst = Item::get(85, 0, 32);
				$kinoko = Item::get(40, 0, 5);
				$naeki = Item::get(6, 0, 64);
				$taimatu = Item::get(50, 0, 32);
				$rand = rand(1, 13);//乱数
				$money = $this->EconomyAPI->myMoney($player->getName());
				if($money < $price){
					$sender->sendMessage("[ガチャ]§4金が足りない!");
					break;
				}else{
					$this->EconomyAPI->reduceMoney($player->getName(), $prise);
					switch($rand){
						case 1:
						$player->getInventory()->addItem($diamond);
						$sender->sendMessage("[ガチャ] §6レアの鉄が出てきたぞ!");
						break;
						case 2:
						$player->getInventory()->addItem($gold);
						$sender->sendMessage("[ガチャ] §6レアの金が出てきたぞ!");
						break;
						case 3:
						$player->getInventory()->addItem($iron);
						$sender->sendMessage("[ガチャ] §bノーマルの原木が出てきたぞ!");
						break;
						case 4:
						$player->getInventory()->addItem($coal);
						$sender->sendMessage("[ガチャ] §bノーマルの丸石が出てきたぞ!");
						break;
						case 5:
						$player->getInventory()->addItem($ssid);
						$sender->sendMessage("[ガチャ] §bノーマルの石炭が出てきたぞ!");
						break;
						case 6:
						$player->getInventory()->addItem($garas);
						$sender->sendMessage("[ガチャ] §bノーマルのガラスが出てきたぞ!");
						break;
						case 7:
						$player->getInventory()->addItem($stak);
						$sender->sendMessage("[ガチャ] §bノーマルのステーキが出てきたぞ!");
						break;
						case 8:
						$player->getInventory()->addItem($pan);
						$sender->sendMessage("[ガチャ] §bノーマルのパンが出てきたぞ!");
						break;
						case 9:
						$player->getInventory()->addItem($tpick);
						$sender->sendMessage("[ガチャ]§bノーマルの鉄のピッケルが出てきたぞ!");
						break;
						case 10:
						$player->getInventory()->addItem($fenst);
						$sender->sendMessage("[ガチャ] §bノーマルのフェンスが出てきたぞ!");
						break;
						case 11:
						$player->getInventory()->addItem($kinoko);
						$sender->sendMessage("[ガチャ] §dハズレのキノコが出てきたぞ!");
						break;
						case 12:
						$player->getInventory()->addItem($naeki);
						$sender->sendMessage("[ガチャ] §dハズレの苗木が出てきたぞ!");
						break;
						case 13:
						$player->getInventory()->addItem($taimatu);
						$sender->sendMessage("[ガチャ] §dハズレの松明が出てきたぞ!");
						break;
					}
				}
				break;




/* ----------------------- コマンド ---------------------- */
				default:
				$sender->sendMessage("\"§b/gta $subCommand\" というサブコマンドはありません");
				break;

			}
		}
	}

}