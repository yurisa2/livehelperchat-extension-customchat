<?php

class erLhcoreClassExtensionCustomchat {
	
	public function __construct() {
		
	}
	
	public function run() {		
		
		$dispatcher = erLhcoreClassChatEventDispatcher::getInstance();
		
		$dispatcher->listen('chat.web_add_msg_admin',array($this,'opMsg'));
		// $dispatcher->listen('chat.auto_responder_triggered',array($this,'opAutoRes'));
		$dispatcher->listen('chat.before_auto_responder_message',array($this,'opAutoRes'));
		
	}
	
	public function opMsg($params) {
		include '../wapp-LHC-Bridge/include/config.php';
		
		$data = array('params' => json_encode($params));
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($ws_url_base.'/wapp-LHC-Bridge/out_wapp_hook.php', false, $context);
	}
	
	public function opAutoRes($params) {
	ini_set("display_errors","on");
		include '../wapp-LHC-Bridge/include/config.php';
		
		$params->msg->msg = $params->responder->wait_message;
		$params->msg->name_support = $params->responder->operator;
		
		$data = array('params' => json_encode($params));
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($ws_url_base.'/wapp-LHC-Bridge/out_wapp_hook.php', false, $context);
	
	
	
	}
	
}

?>