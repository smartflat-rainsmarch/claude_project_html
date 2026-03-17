
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
    <link rel="shortcut icon" type="image/x-icon" href="http://bodypass.co.kr/real/black/web/icon/black_arc.ico" />
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
   

</section>
    <p align="center" style='width:100%;float:center;margin-top:200px'><img id="" src="./img/check.png" style="width:200px;height:200px;"><br><br>
            <text align="center" style="font-size:30px;color:#0000bb;text-align:center">결제 성공</text><br><br></p>
            <div class='form-control' style="width:auto;height:auto;margin-left:30%;margin-right:30%">
                
                <table align="center" id ='locker_info' style='width:100%;' >
                                     <tr>
                                        <td colspan='2'>
                                            <label class='textevent'>주문번호</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'>
                                            <div class='form-control' style='height:auto'>
                                                sadfsafed32432
                                            </div>
                                        </td>
                                     </tr>
                                    <tr>
                                        <td style='width:50%'>
                                            <label class="textevent">결제타입</label>
                                        </td>
                                        <td style='width:50%'>
                                            <label class="textevent">결제금액</label><br>                                    
                                        </td>
                                     </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class='form-control' style='height:auto'>
                                                카드 
                                            </div>
                                        </td>
                                        <td>
                                           <div class='form-control' style='height:35px'>
                                                <span style='float:left'>1,000</span><span style='float:right'>￦</span>
                                            </div>
                                        </td>
                                     </tr>
                                    <tr style='width:50%'>
                                        <td>
                                            <label class="textevent">카드회사</label>
                                        </td>
                                        <td>
                                            <label class="textevent">카드번호</label><br>                                    
                                        </td>
                                     </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class='form-control' style='height:auto'>
                                                현대
                                            </div>
                                        </td>
                                        <td>
                                           <div class='form-control' style='height:auto'>
                                                402857******5632
                                            </div>
                                        </td>
                                     </tr>
                    
                                    <tr>
                                        <td>
                                            <label class="textevent">상품명</label><br>                                    
                                        </td>
                                        <td>
                                            <label class="textevent">결제일</label><br>                                    
                                        </td>
                                     </tr>
                                    <tr>
                                        <td>
                                           <div class='form-control' style='height:auto'>
                                                black 충전
                                            </div>
                                        </td>
                                        <td>
                                           <div class='form-control' style='height:auto'>
                                                2022-02-23T17:52:41+09:00
                                            </div>
                                        </td>
                                        </tr>
                                    </table>
                </div>

    <p align="center" style='width:100%;float:center;margin-top:50px'><button  class='btn btn-primary btn-raised' onclick='goHome()' style='font-size:20px;padding-left:50px;padding-right:50px;padding-top:20px;padding-bottom:20px'>홈으로가기</button></p>
    <script>
        
        function goHome(){
            window.location.href = "./main";
        }
    </script>
</body>
</html>
