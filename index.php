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

$pesan_datang = explode(" ", $message['text']);

$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}

#-------------------------[Function]-------------------------#
function shalat($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Jadwal Shalat Sekitar ";
	$result .= $json['location']['address'];
	$result .= "\nTanggal : ";
	$result .= $json['time']['date'];
	$result .= "\n\nShubuh : ";
	$result .= $json['data']['Fajr'];
	$result .= "\nDzuhur : ";
	$result .= $json['data']['Dhuhr'];
	$result .= "\nAshar : ";
	$result .= $json['data']['Asr'];
	$result .= "\nMaghrib : ";
	$result .= $json['data']['Maghrib'];
	$result .= "\nIsya : ";
	$result .= $json['data']['Isha'];
    return $result;
}
#-------------------------[Function]-------------------------#
# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');

//show menu, saat join dan command /menu
if ($type == 'join' || $command == '/menu') {
    $text = "Assalamualaikum Kakak, aku adalah bot jadwal shalat, silahkan ketik\n\n/shalat <nama tempat>\n\nnanti aku bakalan kasih tahu jam berapa waktunya shalat ^_^";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}

//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/shalat') {
        $result = shalat($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

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
    'thumbnailImageUrl' => 'https://stmed.net/sites/default/files/sailor-moon-wallpapers-26081-2552027.jpg',
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
