<?php

declare(strict_types=1);

namespace koningcool;
//pocketmine uses//
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
//xenialdan uses// //test
use xenialdan\customui\API as UIAPI;
use xenialdan\customui\event\UICloseEvent;
use xenialdan\customui\event\UIDataReceiveEvent;
use xenialdan\customui\network\ModalFormRequestPacket;
use xenialdan\customui\network\ModalFormResponsePacket;
use xenialdan\customui\network\ServerSettingsRequestPacket;
use xenialdan\customui\network\ServerSettingsResponsePacket;

class Main extends PluginBase{

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch($command->getName()){
            case "servers":
                UIAPI::showUIbyID($plugin, Main::$uis['serversui'], $player);
                
        }
    }

    public function onEnable(){
        PacketPool::registerPacket(new ModalFormRequestPacket());
        PacketPool::registerPacket(new ModalFormResponsePacket());
        PacketPool::registerPacket(new ServerSettingsRequestPacket());
        PacketPool::registerPacket(new ServerSettingsResponsePacket());
        /** call this AFTER registering packets! */
        $this->registerUIs();
    }

    private function registerUIs(){
        $ui = new SimpleForm('Servers', 'Kies naar welke servers je wilt gaan!');
        $button = new Button('Development-Server');
        $ui->addButton($button);
        $button = new Button('Test-Server'); //"textures/items/stick");
        $ui->addButton($button);
        $button = new Button('Terug');   //"https link to a squared image");
        $ui->addButton($button);
        // This will save the ID of the UI into an array for later sending */
        // $ui will be NULL after this! You can't add any more elements to the UI after this! */
        // self::$uis should be created before. See above for the code */
        self::$uis['serversui'] = UIAPI::addUI($this, $ui); 
    }

}
?>