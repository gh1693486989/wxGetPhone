<?php

include_once "wxBizDataCrypt.php";

$appid = 'wx98c54627e28bb4d5';
$secret = 'b5ff8263bc81f3a1c34f6cfaabae8662';
$js_code= isset($_REQUEST['js_code']) ? $_REQUEST['js_code'] : '';
$grant_type= isset($_REQUEST['grant_type']) ? $_REQUEST['grant_type'] : '';
if(!empty($grant_type)){
    $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$js_code."&grant_type=".$grant_type;
    $data = file_get_contents($url,'r');
    echo json_encode($data);exit;
}

//解密操作
$sessionKey = $_REQUEST['session_key'];
$encryptedData=$_REQUEST['encryptedData'];
$iv = $_REQUEST['iv'];

$pc = new WXBizDataCrypt($appid, $sessionKey);
$errCode = $pc->decryptData($encryptedData, $iv, $data );

if ($errCode == 0) {
    echo json_encode($data);
} else {
    echo json_encode($errCode);
}
