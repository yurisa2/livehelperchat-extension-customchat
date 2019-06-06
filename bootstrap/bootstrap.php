<?php

class erLhcoreClassExtensionCustomchat {

	public function __construct() {
		
	}
	 
	public function run() {		
	

erLhcoreClassChatEventDispatcher::getInstance()->listen('chat.web_add_msg_admin',array($this,'opMsg'));
		
		
	}
	
	public function opMsg($params) {
		
		// echo '<pre>';
		// var_dump($params['msg']);
		// echo '</pre>';
		// file_put_contents("opMSG.txt",json_encode($params['msg']));

	}
	
	
	
}

?>