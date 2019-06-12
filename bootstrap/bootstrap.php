<?php

class erLhcoreClassExtensionCustomchat {
	
	public function __construct() {
		
	}
	
	public function run() {		
		
		$dispatcher = erLhcoreClassChatEventDispatcher::getInstance();
		
		$dispatcher->listen('chat.web_add_msg_admin',array($this,'opMsg'));
				$dispatcher->listen('chat.cannedmsg',array($this,'canUseopMsgCannedMessages'));
		// $dispatcher->listen('file.uploadfileadmin.file_path',array($this,'uploadFile'));
		// $dispatcher->listen('file.uploadfile.file_path',array($this,'uploadFile'));
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
	
}

?>