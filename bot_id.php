<?php
  $bottoken= "5483710354:AAFefSSLshxhbAMDfRMzjyc4ELmFqlBYl28";
  $chatids = array("-1001560473015");

  define('BOT_TOKEN', $bottoken);
  define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

  function enviar_telegram($enviar, $chat_id){
    $queryArray = [
      'chat_id' => $chat_id,
      'text' => $enviar,
    ];
    $url = API_URL.'sendMessage?'. http_build_query($queryArray)."&parse_mode=html";
    $result = file_get_contents($url);
  }

  foreach($chatids as $chat_id){
    enviar_telegram($enviar, $chat_id);
  }
?>