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
										'text' => 'Halo kamu ya'
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
  'altText' => 'Ayo gunakan Kaneki Bot sekarang juga!',
  'template' => 
  array (
    'type' => 'carousel',
    'columns' => 
    array (
      0 => 
      array (
        'thumbnailImageUrl' => 'https://image.prntscr.com/image/J8rbIzFwSQ_WHbE0UhqyyA.jpg',
        'imageBackgroundColor' => '#FFFFFF',
        'title' => 'Tutorial Bot',
        'text' => 'Cara menggunakan bot Kaneki.',
        'defaultAction' => 
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://example.com/page/123',
        ),
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'uri',
            'label' => 'Video',
            'uri' => 'http://line.me/R/home/public/post?id=ish7215m&postId=1152685347802060486',
          ),
          1 => 
          array (
            'type' => 'uri',
            'label' => 'Photo',
            'uri' => 'http://line.me/R/home/public/post?id=ish7215m&postId=1152812065802062947',
          ),
        ),
      ),
      1 => 
      array (
        'thumbnailImageUrl' => 'https://image.prntscr.com/image/J8rbIzFwSQ_WHbE0UhqyyA.jpg',
        'imageBackgroundColor' => '#000000',
        'title' => 'this is menu',
        'text' => 'description',
        'defaultAction' => 
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://example.com/page/222',
        ),
        'actions' => 
        array (
          0 => 
          array (
            'type' => 'postback',
            'label' => 'Buy',
            'data' => 'action=buy&itemid=222',
          ),
          1 => 
          array (
            'type' => 'postback',
            'label' => 'Add to cart',
            'data' => 'action=add&itemid=222',
          ),
          2 => 
          array (
            'type' => 'uri',
            'label' => 'View detail',
            'uri' => 'http://example.com/page/222',
          ),
        ),
      ),
    ),
    'imageAspectRatio' => 'rectangle',
    'imageSize' => 'cover',
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
