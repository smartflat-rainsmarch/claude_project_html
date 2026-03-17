<div id="div_teach_reservation" style="display:none;background-color:#eeeeff;padding-bottom:30px">
             <form action="#" method="post" id="join-us" target="iframe1">

                <div class="form-group row">
                    <div id=formdiv class="col-8 offset-2">

                        <br><label for="teach_name">강좌종류</label>
                        <select id="teach_name" class="form-control" onchange="teachNameClick()" name="teach_name" required>
                         </select><br>
                        
                        <div id='teach_datas' style="display:none">
                            <label for="teach_maxnumber">인원수</label>
                            <select id="teach_maxnumber" class="form-control" onchange="teachMaxNumberClick()" name="teach_maxnumber" required>
                            </select><br>

                            <label for="teach_times">시간대 선택</label>
                            <select id="teach_times" class="form-control" onchange="teachTimeClick()" name="teach_times" required>
                            </select><br>

                            <div class="form-control" name="subscription_path">
                                <span id='teach_select_times'>
                                </span>
                            </div>
                            <br>
                            <div id = 'teach_date'>
                                오픈시작일 : <input onchange='teachdate_onchange()' id = 'teach_startdate' type='date' value=''/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;오픈종료일 : <input onchange='teachdate_onchange()' id = 'teach_enddate' type='date' value=''/>
                            </div>
                        </div>
                        
                    </div>
                 </div>
            </form>

        </div>
<script>

 function setCourseReservation(jsonobj){
        reservation_default = jsonobj;
        //select 
        clog("기본 정보 ",jsonobj);
        var teach_name = document.getElementById("teach_name");
        var teach_maxnumber = document.getElementById("teach_maxnumber");
        var teach_times = document.getElementById("teach_times");
        //checkboxs
        var teach_select_times = document.getElementById("teach_select_times");
        //date start end 
        var teach_date = document.getElementById("teach_date");
        
        
        var reservation_title = document.getElementById("reservation_title");     
        
        var teacher_type = jsonobj.type == "PT" ? "트레이너" : "강사";
        document.getElementById("teacher_reservation_title").innerHTML = jsonobj.type+" "+teacher_type+" 예약화면";
        
        ///////////////////////////////////////////////////////
        //강좌종류
        ///////////////////////////////////////////////////////
        
        var class_len = jsonobj.classes.length;
        if(class_len  == 1){
            var obj = jsonobj.classes[0];
            teach_name.innerHTML = "<option value='"+obj.name+"'>"+obj.name+"</option>";
            
            teach_datas.style.display = "block";
            
            
            ///////////////////////////////////////////////////////
            //최대 정원
            ///////////////////////////////////////////////////////
            var max_people = parseInt(jsonobj.classes[0].max);
            if(max_people == 1){
                teach_maxnumber.innerHTML = "<option value='"+max_people+"'>"+max_people+" 명</option>";
            }else if(max_people > 1){
                for(var i = 0 ;i  < max_people; i++){
                    teach_maxnumber.innerHTML += "<option value='"+(i+1)+"'>"+(i+1)+" 명</option>";
                }    
            }
            
        }else if(class_len > 1){
            teach_name.innerHTML = "<option value='-1'>강좌 종류를 선택하세요</option>";
            for(var i = 0 ;i  < class_len; i++){
                var obj = jsonobj.classes[i];
                teach_name.innerHTML += "<option value='"+i+"'>"+obj.name+"</option>";            
            }
        }
        
       
        
        ///////////////////////////////////////////////////////
        //시간대 
        ///////////////////////////////////////////////////////        
        var opentime_len = jsonobj.opentimes.length;
        teach_times.innerHTML = "<option >예약시간을 선택하세요</option>";
        for(var i = 0 ;i  < opentime_len; i++){
            var time = parseInt(jsonobj.opentimes[i]);
            teach_times.innerHTML += "<option value='"+time+"'>"+time+"시</option>";            
        }
            
    }
    function teachNameClick(){
        var teach_name_value = document.getElementById("teach_name").value;
        var teach_datas = document.getElementById("teach_datas");
        
        var teach_maxnumber = document.getElementById("teach_maxnumber");
        var teach_times = document.getElementById("teach_times");
        clog("teach_name_value "+teach_name_value);
        var value = teach_name_value == -1 ? -1 : teach_name_value;
        if(value == -1){
            teach_datas.style.display = "none";
        }else {
            teach_datas.style.display = "block";
             ///////////////////////////////////////////////////////
            //최대 정원
            ///////////////////////////////////////////////////////
            var max_people = parseInt(reservation_default.classes[0].max);
            if(max_people == 1){
                teach_maxnumber.innerHTML = "<option value='"+max_people+"'>"+max_people+" 명</option>";
            }else if(max_people > 1){
                for(var i = 0 ;i  < max_people; i++){
                    teach_maxnumber.innerHTML += "<option value='"+(i+1)+"'>"+(i+1)+" 명</option>";
                }    
            }
        }
    }
    function teachMaxNumberClick(){
        
    }
    function teachTimeClick(){
        var teach_times = document.getElementById("teach_times");
        var teach_select_times = document.getElementById("teach_select_times");
        var text = teach_times.options[teach_times.selectedIndex].text;
        
        var isin = false;
        for(var i = 0 ; i < teach_select_times.children.length; i++){
             if(teach_select_times.children[i].id == teach_times.value){
                 isin = true;
                 break;
             }
        }
        if(!isin)
            teach_select_times.innerHTML+= "<label style='border-radius: 25px;background: #e3eDf1;width: 100px;height: 30px;padding-top:2px;padding-right:20px' id='"+teach_times.value+"'>"+text+"<img onclick='removeTeachTime("+teach_times.value+")' type= 'button' src ='./img/btn_close_50.png' style='margin-left:60px;margin-top:-36px'/></label>";

        
//        var ps = document.querySelectorAll( "#teach_select_times label" );
//        var sortedPs = Array.from( ps ).sort( (a, b) => a.id.localeCompare( b.id ) ); //sort the ps
//        document.querySelector( "#teach_select_times" ).innerHTML = sortedPs.map( s => s.outerHTML ).join("");                         
        sortListIntType(teach_select_times,false);
    }
    function removeTeachTime(time){
        var teach_select_times = document.getElementById("teach_select_times");
//        teach_select_times.style.visibility = teach_select_times.children.length > 0 ? "block" : "none";
        for(var i = 0 ; i < teach_select_times.children.length; i++){
            
            if(teach_select_times.children[i].id == time){
                teach_select_times.removeChild(teach_select_times.children[i]);
                
                break;
            }
        }
        
    }
    setCourseReservation(reservation_default);
</script>