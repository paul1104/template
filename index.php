<?php
/*
copyright @ medantechno.com
2017

*/

require_once('./line_class.php');

$channelAccessToken = '3mTkZrX0oPra46uMe0zaYhgZisp3K+iEMuh0nXCTXPG31lKTXcD7XWRYKZ3RwVQGYeY/UjHCZvH5WyXDKblWGlMLDeudwM2Zig6kChQSr92WfKEZRqL1jiwqSy6Yzn1liYzZvM84ye2dF+RnOC3ohAdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = 'ef937ac3033ada91ca7688f0c0633250';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = $message['text'];

//pesan bergambar

if($message['type']=='text')
{
	if($pesan_datang=='Hi') {
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo syg'
									)
							)
						);
				
	}
	if($pesan_datang=='Hai') {
		
		
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array (
  'type' => 'template',
  'altText' => 'This is a buttons template',
  'template' => 
  array (
    'type' => 'buttons',
    'thumbnailImageUrl' => 'https://example.com/bot/images/image.jpg',
    'imageAspectRatio' => 'rectangle',
    'imageSize' => 'cover',
    'imageBackgroundColor' => '#FFFFFF',
    'title' => 'Menu',
    'text' => 'Please select',
    'defaultAction' => 
    array (
      'type' => 'uri',
      'label' => 'View detail',
      'uri' => 'https://line.me/ti/p/~@ish7215m',
    ),
    'actions' => 
    array (
      0 => 
      array (
        'type' => 'uri',
        'label' => 'Tutorial Bot',
        'uri' => 'https://line.me/ti/p/~syahraqa',
      ),
      1 => 
      array (
        'type' => 'postback',
        'label' => 'Add to cart',
        'data' => 'action=add&itemid=123',
      ),
      2 => 
      array (
        'type' => 'uri',
        'label' => 'View detail',
        'uri' => 'http://example.com/page/123',
      ),
    ),
  ),
)
							)
						);
				
	}

}
 
$result =  json_encode($balas);
//$result = ob_get_clean();

file_put_contents('./balasan.json',$result);


$client->replyMessage($balas);

?>
