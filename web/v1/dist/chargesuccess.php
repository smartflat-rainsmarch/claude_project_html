<?php

include('./common'); 


$paymentKey = isset($_GET['paymentKey']) ? $_GET['paymentKey'] : '';
$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
$amount = isset($_GET['amount']) ? $_GET['amount'] : '';

$secretKey = getTossKey();

$url = 'https://api.tosspayments.com/v1/payments/' . $paymentKey;

$data = ['orderId' => $orderId, 'amount' => $amount];

$credential = base64_encode($secretKey . ':');

$curlHandle = curl_init($url);

curl_setopt_array($curlHandle, [
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' . $credential,
        'Content-Type: application/json'
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($curlHandle);



$httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
$isSuccess = $httpCode == 200;
$responseJson = json_decode($response,true);
$bankname = isset($responseJson) && isset($responseJson["transfer"]) && isset($responseJson["transfer"]["bank"]) ? $responseJson["transfer"]["bank"] : "";
$cardcompany = isset($responseJson) && isset($responseJson["card"]) && isset($responseJson["card"]["company"]) ? $responseJson["card"]["company"] : "";
$cardnumber = isset($responseJson) && isset($responseJson["card"]) && isset($responseJson["card"]["number"]) ? $responseJson["card"]["number"] : "";

if(isset($responseJson["code"]))
if( $responseJson["code"] == "INVALID_REQUEST" || $responseJson["code"] == "INVALID_API_KEY" || $responseJson["code"] == "ALREADY_PROCESSED_PAYMENT"){
    echo "[".$responseJson["message"]."]";
    exit;
}
$groupcode = "";

if(isset($responseJson["orderName"])){
    $orderName = $responseJson["orderName"];
    $infoarr = explode("_", $responseJson["orderName"] ); //그룹코드_orderName_orderUID;
    $groupcode = $infoarr[0];
}

//$username = $infoarr[1];
//$userid = $infoarr[2];
//$encode_response=json_encode('{"mId":"tvivarepublica","version":"1.3","transactionKey":"CADF57DA0A7D0BCC2EDBE274DBED0BE0","paymentKey":"o01OAv2P6yqLlDJaYngroALPWJMWl3ezGdRpXxKN7BQMEk4j","orderId":"IQo0fTMf229GZGDA_Wr3","orderName":"black(허광용) 카드충전","method":"카드","status":"DONE","requestedAt":"2022-02-23T16:26:30+09:00","approvedAt":"2022-02-23T16:26:50+09:00","useEscrow":false,"cultureExpense":false,"card":{"company":"현대","number":"402857******5632","installmentPlanMonths":0,"isInterestFree":false,"approveNo":"00000000","useCardPoint":false,"cardType":"신용","ownerType":"개인","acquireStatus":"READY","receiptUrl":"https:\/\/dashboard.tosspayments.com\/sales-slip?transactionId=epBCkTmh0Nn0MWYAUdjDIKxt%2Bz5JRswf9wOZQtw3gDPvtT8qGsR2laYhz38NNB5S&ref=PX"},"virtualAccount":null,"transfer":null,"mobilePhone":null,"giftCertificate":null,"cashReceipt":null,"discount":null,"cancels":null,"secret":"ps_qLlDJaYngroALPQJY4v3ezGdRpXx","type":"NORMAL","easyPay":null,"currency":"KRW","totalAmount":100,"balanceAmount":100,"suppliedAmount":91,"vat":9,"taxFreeAmount":0}', JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,  shrink-to-fit=no ,initial-scale=0.5, maximum-scale=1, minimum-scale=0.5"/>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>결제 성공</title>
    <link href="./css/w3.css" rel="stylesheet">
    <link href="./css/toast.css" rel="stylesheet">
    <link href="./css/modaldialog.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="./css/toggle.css" rel="stylesheet">
    <link href="./css/buttons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="https://blackgym.co.kr/real/black/web/icon/black_arc.ico" />
    <script src="./libs/jquery/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<!--    <script src="./libs/bootstrap/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <script src="js/scripts.js?ver3.00a"></script>
    

    <script src="./libs/chart/chart.min.js"></script>
<!--    테이블 관련-->
    <link href="./libs/tables/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="./libs/tables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="./libs/tables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    
    <style>
     .textevent {
            border-top: 1px solid #b2dba1;
            border-bottom: 1px solid #b2dba1;
            background-image: linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%);
            background-repeat: repeat-x;
            color: #3c763d;
            border-width: 1px;
            font-size: 1em;
            padding: 0 .75em;
            line-height: 2em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 1px;
            width:100%;
        }
    </style>
</head>
<body>
    
<section>
    <?php
    if ($isSuccess) { ?>
        
        <script>
             var groupcode = "<?php echo $groupcode ;?>"; //groupcode
             var response = '<?php echo json_encode($responseJson, JSON_UNESCAPED_UNICODE) ?>';
             console.log("chargeCheck 000 ");
             chargeCheck(groupcode,response,function(res){
                 console.log("chargeCheck res ",res);
                 var paymenttype = "<?php echo $responseJson["method"] ;?>";
                 if(paymenttype == "카드")createCardSuccessTable();
                 else if(paymenttype == "계좌이체")createCashSuccessTable();
             });
            
            function createCardSuccessTable(){
                var orderid = "<?php echo $responseJson["orderId"] ;?>";
                var paymenttype = "<?php echo $responseJson["method"] ;?>";
                var amount = "<?php echo $responseJson["totalAmount"] ;?>";
                var cardcompany = "<?php echo $cardcompany?>";
                var cardnumber = "<?php echo $cardnumber?>";
                var ordername = "<?php echo $responseJson["orderName"] ;?>";
                var paymentdate = "<?php echo $responseJson["approvedAt"] ;?>";
                
                var body_tag = "<p align='center' style='width:100%;float:center;margin-top:200px'><img id='' src='./img/check.png' style='width:200px;height:200px;'><br><br>"+
            "<text align='center' style='font-size:30px;color:#0000bb;text-align:center'>결제 성공</text><br><br></p>"+
            "<div class='form-control' style='width:auto;height:auto;margin-left:30%;margin-right:30%'>"+
                
                "<table align='center' id ='locker_info' style='width:100%;' >"+
                                    "<tr>"+
                                        "<td colspan='2'>"+
                                            "<label class='textevent'>주문번호</label>"+
                                        "</td>"+
                                    "</tr>"+
                                    "<tr>"+
                                        "<td colspan='2'>"+
                                            "<div class='form-control' style='height:auto'>"+
                                                orderid+
                                            "</div>"+
                                        "</td>"+
                                     "</tr>"+
                                    "<tr>"+
                                        "<td style='width:50%'>"+
                                            "<label class='textevent'>결제타입</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+
                                            "<label class='textevent'>결제금액</label><br>"+
                                        "</td>"+
                                     "</tr>"+                                    
                                    "<tr>"+
                                        "<td>"+
                                            "<div class='form-control' style='height:auto'>"+
                                                paymenttype+
                                            "</div>"+
                                        "</td>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                                 //"<span style='float:left'>"+CommaString(amount)+"</span><span style='float:right'>￦</span>"
                                                    TXT_WON+"&nbsp;"+CommaString(amount)+
                                            "</div>"+
                                        "</td>"+
                                     "</tr>"+
                                    "<tr style='width:50%'>"+
                                        "<td>"+
                                            "<label class='textevent'>카드회사</label>"+
                                        "</td>"+
                                        "<td>"+
                                            "<label class='textevent'>카드번호</label><br>"+
                                        "</td>"+
                                     "</tr>"+                                    
                                    "<tr>"+
                                        "<td>"+
                                            "<div class='form-control' style='height:auto'>"+
                                                cardcompany+
                                            "</div>"+
                                        "</td>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                                cardnumber+
                                            "</div>"+
                                        "</td>"+
                                     "</tr>"+
                    
                                    "<tr>"+
                                        "<td>"+
                                            "<label class='textevent'>상품명</label><br>"+
                                        "</td>"+
                                        "<td>"+
                                            "<label class='textevent'>결제일</label><br>"+
                                        "</td>"+
                                     "</tr>"+
                                    "<tr>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                                ordername+
                                            "</div>"+
                                        "</td>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                               paymentdate+
                                            "</div>"+
                                        "</td>"+
                                        "</tr>"+
                                    "</table>"+
                                "</div>"+
                                "<p align='center' style='width:100%;float:center;margin-top:50px'><button  class='btn btn-primary btn-raised' onclick='goHome()' style='font-size:20px;padding-left:50px;padding-right:50px;padding-top:20px;padding-bottom:20px'>홈으로가기</button></p>";
                   
                document.body.innerHTML = body_tag;
                
            }
             function createCashSuccessTable(){
                var orderid = '<?php echo $responseJson["orderId"];?>';
                var paymenttype = '<?php echo $responseJson["method"];?>';
                var amount = '<?php echo $responseJson["totalAmount"];?>';
                
                var bankname = '<?php echo $bankname;?>';
                var ordername = '<?php echo $responseJson["orderName"];?>';
                var paymentdate = '<?php echo $responseJson["approvedAt"];?>';
                
                var body_tag = "<p align='center' style='width:100%;float:center;margin-top:200px'><img id='' src='./img/check.png' style='width:200px;height:200px;'><br><br>"+
            "<text align='center' style='font-size:30px;color:#0000bb;text-align:center'>결제 성공</text><br><br></p>"+
            "<div class='form-control' style='width:auto;height:auto;margin-left:30%;margin-right:30%'>"+
                
                "<table align='center' id ='locker_info' style='width:100%;' >"+
                                    "<tr>"+
                                        "<td colspan='2'>"+
                                            "<label class='textevent'>주문번호</label>"+
                                        "</td>"+
                                    "</tr>"+
                                    "<tr>"+
                                        "<td colspan='2'>"+
                                            "<div class='form-control' style='height:auto'>"+
                                                orderid+
                                            "</div>"+
                                        "</td>"+
                                     "</tr>"+
                                    "<tr>"+
                                        "<td style='width:50%'>"+
                                            "<label class='textevent'>결제타입</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+
                                            "<label class='textevent'>결제금액</label><br>"+
                                        "</td>"+
                                     "</tr>"+                                    
                                    "<tr>"+
                                        "<td>"+
                                            "<div class='form-control' style='height:auto'>"+
                                                paymenttype+
                                            "</div>"+
                                        "</td>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                                 //"<span style='float:left'>"+CommaString(amount)+"</span><span style='float:right'>￦</span>"
                                                    TXT_WON+"&nbsp;"+CommaString(amount)+
                                            "</div>"+
                                        "</td>"+
                                     "</tr>"+
                                    "<tr style='width:50%'>"+
                                        "<td colspan='2'>"+
                                            "<label class='textevent'>은행명</label>"+
                                        "</td>"+
                                       
                                     "</tr>"+                                    
                                    "<tr>"+
                                        "<td colspan='2'>"+
                                            "<div class='form-control' style='height:auto'>"+
                                                bankname+
                                            "</div>"+
                                        "</td>"+
                                       
                                     "</tr>"+
                    
                                    "<tr>"+
                                        "<td>"+
                                            "<label class='textevent'>상품명</label><br>"+
                                        "</td>"+
                                        "<td>"+
                                            "<label class='textevent'>결제일</label><br>"+
                                        "</td>"+
                                     "</tr>"+
                                    "<tr>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                                ordername+
                                            "</div>"+
                                        "</td>"+
                                        "<td>"+
                                           "<div class='form-control' style='height:auto'>"+
                                               paymentdate+
                                            "</div>"+
                                        "</td>"+
                                        "</tr>"+
                                    "</table>"+
                                "</div>"+
                                "<p align='center' style='width:100%;float:center;margin-top:50px'><button  class='btn btn-primary btn-raised' onclick='goHome()' style='font-size:20px;padding-left:50px;padding-right:50px;padding-top:20px;padding-bottom:20px'>홈으로가기</button></p>";
                   
                document.body.innerHTML = body_tag;
                
            }
        </script>
        <?php
    } else { ?>
        <h1>결제 실패</h1>
        <p><?php echo $responseJson->message ?></p>
        <span>에러코드: <?php echo $responseJson->code ?></span>
        <?php
    }
    ?>

</section>
    <p align='center' style='width:100%;float:center;margin-top:50px'><button  class='btn btn-primary btn-raised' onclick='goHome()' style='font-size:20px;padding-left:50px;padding-right:50px;padding-top:20px;padding-bottom:20px'>홈으로가기</button></p>
    <script>
        
        function goHome(){
            window.location.href = "./main";
        }
    </script>
</body>
</html>
