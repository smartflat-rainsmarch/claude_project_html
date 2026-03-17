 
<nav  id="div_top" class="sb-topnav navbar navbar-expand navbar-dark" style='background-color:#111111'>
<!--            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" onclick="menu_click()" href="#"><i class="fas fa-bars"></i></button>-->
           
            <a class="navbar-brand" href="index.php">
                <img src="./img/logo_bg.png" style='width:40px;height:40px;padding:8px;margin-bottom:1px;border:1px solid #666666;border-radius:20px'/>
                
                <text id="id_group_name" class='fmont' style="margin-left:7px;color:white;font-weight:bold;font-size:17px;line-width:150px">BGTech</text>
            </a> 
            <select id="header_center_select" style='width:150px;font-size:15px;color:white;background-color:#111111;border:1px solid #666666;border-radius:8px' class="form-control" onchange="changeCenter()"></select><br>
            
            <button id='btn_goto_payroll' onclick='goto_payroll_history()' class='btn fmont' style='float:right;margin:10px;cursor:pointer;background-color:#2e2e2e;font-size:12px;color:white;font-weight:bold;padding:8px 15px 8px  15px'>Payroll</button>
            <button id='btn_goto_homepage' onclick='goto_homepage()' class='btn fmont' style='float:right;margin:10px;cursor:pointer;background-color:#2e2e2e;font-size:12px;color:white;font-weight:bold;padding:8px 15px 8px  15px'>HOME PAGE</button>
            
            <!--  유저 아이콘 -->
            <ul class="navbar-nav ml-auto">
                
  
                
                <!--      로그인 버튼          -->
                <button id = "btn_login" class="btn btn-link ml-auto" style="color:white" onclick="login()">로그인</button>
                
                <!--     회원가입 버튼           -->
<!--                <button id = "btn_logout" class="btn btn-link ml-auto" style="color:white"  onclick="join()">회원가입</button>-->
                
                <!--     회원 이름           -->
                <button id = "txt_name" class="btn btn-link ml-auto" style="color:white"></button>
                <!--     유저 아이콘           -->
                <li id = "li_usericon" class="nav-item dropdown">
                    
                    <a class="nav-link" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div align="center" style='width:40px;height:40px;border:1px solid #666666;border-radius:20px'>
                            <i class="fa-solid fa-user" style='margin-top:10px'></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style='background-color:#111111;border:1px solid #666666'>
                        <a class="dropdown-item" onclick="logout()" style='background-color:#191919;'><text style="color:white">로그아웃</text></a>
                    </div>
                </li>
                <!--      관리자페이지 이동          -->
                <button id = "btn_admin" class="btn btn-link ml-auto fmont" style="height:40px;margin-top:7px;color:white; border:1px solid #666666;border-radius:8px;display:none;font-size:12px" onclick="gotoadmin()">Admin</button>
                
            </ul>
    </nav>
<script>
    console.log("header!!");
    function goto_payroll_history(){
        location.href = "./m_my_payroll_history.php";
    }
    function goto_homepage(){
        location.href = "https://bodypass.co.kr";
    }
    function setHeaderCenterSelect(rows,islock){
        setLogos(groupcode);
        
        var id_group_name = document.getElementById("id_group_name");
        id_group_name.innerHTML = groupname;
        
        var header_center_select = document.getElementById("header_center_select");
        if(!rows){
            header_center_select.style.display = "none";
            return;
        }else 
            header_center_select.style.display = "block";
        
        var len = rows.length;
        
        if(islock)header_center_select.disabled = true;
        var option_style = " style='background-color:#191919'";
        if(len == 1){
            header_center_select.innerHTML = "<option "+option_style+" value='"+rows[0].centercode+"'>"+rows[0].centername+"</option>";
             saveDataGroupCenter(groupcode, rows[0].centername, rows[0].centercode);
        }else if(len > 1){
            header_center_select.innerHTML = "<option "+option_style+" > 센터를 선택하세요</option>";
            for(var i = 0 ; i < len;i++) 
                header_center_select.innerHTML += "<option "+option_style+"  value='"+rows[i].centercode+"'>"+rows[i].centername+"</option>";
            
            loadSetGroupValue("nowcentercode", header_center_select); 
        }
        
    }
    
    function changeCenter(){
        var header_center_select = document.getElementById("header_center_select");
        var center_code = header_center_select.value;
        var center_name = header_center_select.options[header_center_select.selectedIndex].text;
        
        saveDataGroupCenter(groupcode,center_name,parseInt(center_code));   
        if(location.href.indexOf("join.php") && typeof centerClick === "function")centerClick(); //join.php
        else C_showToast( "센터를 변경하였습니다.!", "현재 센터는 " + getData("nowcentername") + "입니다.", function() {}); //other 
    }
    
    
      
    
</script>
