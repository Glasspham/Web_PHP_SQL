<?php 
function execPostRequest($url, $data){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua MoMo";
$amount = $_POST['grandtotal']; //$_POST['grandtotal'];
$orderId = time() ."";
$redirectUrl = "http://localhost/websiteMVC/onlinepayment.php";
$ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
$extraData = "";

if (!empty($_POST)) {
    $orderId = time(); // Mã đơn hàng
    $requestId = time() . "";
    if(isset($_POST['captureWallet'])) {
        $orderInfo = 'Pay Bills By MOMO QR';
        $requestType = "captureWallet";
    } elseif(isset($_POST['payWithATM'])) {
        $orderInfo = 'Pay Bills By MOMO ATM';
        $requestType = "payWithATM";
    }
    $partnerCode = $partnerCode; //$_POST["partnerCode"];
    $accessKey = $accessKey; //$_POST["accessKey"];
    $secretKey = $secretKey; //$_POST["secretKey"];
    $amount = $amount; //$_POST["amount"];
    $ipnUrl = $ipnUrl; //$_POST["ipnUrl"];
    $redirectUrl = $redirectUrl; //$_POST["redirectUrl"];
    $extraData = $extraData; //$_POST["extraData"];
    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);
    header('Location: ' . $jsonResult['payUrl']);
}
?>
<!-- partnerCode=MOMOBKUN20180529&
orderId=1738233746&
requestId=1738233746&
amount=22440&
orderInfo=Pay+Bills+By+MOMO+ATM&
orderType=momo_wallet&
transId=4316359430&
resultCode=7002&
message=Transaction+is+being+processed+by+the+provider+of+the+payment+instrument+selected.&
payType=napas&
responseTime=1738233971212&
extraData=&
signature=fe5651eecdfdbcb5835a0a620cdf32bb557f47ff804aeb3aabf8bfe497b8bfcf -->