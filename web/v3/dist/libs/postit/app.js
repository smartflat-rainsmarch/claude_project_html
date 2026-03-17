var postit_cards_list = {};

//document.querySelector("#add-card").addEventListener('click', function() {
//    createCard("", {
//        title: "",
//        content: "",
//        top: "",
//        left: "",
//        date: getToday()+" "+getNowHis()
//    });
//}, false);

function generateId(n) {
    let result = '';
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let charactersLength = characters.length;
    for (let i = 0; i < n; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function setStorage() {
    var htype = window.location.hostname.indexOf("localhost") ? "localhost" : "blackgym";
    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
    
    var key = "notes_"+htype+"_"+drtype;
    localStorage.setItem(key, JSON.stringify(postit_cards_list));
    
}

function getStorage() {
    var htype = window.location.hostname.indexOf("localhost") ? "localhost" : "blackgym";
    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
    var key = "notes_"+htype+"_"+drtype;
    
    postit_cards_list = JSON.parse(localStorage.getItem(key)) || {};
//    clog("get PostitData ",postit_cards_list);
}
function clearPostItAll(){
    var htype = window.location.hostname.indexOf("localhost") ? "localhost" : "blackgym";
    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
    var key = "notes_"+htype+"_"+drtype;
    localStorage.setItem(key, "{}");
    location.href = window.location.href;
   
}
function postit_status () {

}
function createCard(id, data) {
    clog("create PostIt");
    id = id || generateId(15);
    //let board = document.querySelector("#board");
    let board = document.body;
//    let board = document.getElementById("div_main");
//    var now = getToday()+" "+getNowHis();
    let card = document.createElement("div");
    
	card.className = "postitcard stop-dragging";
    card.id = id;
    card.style.border = "1px solid #e9e9e9";
    card.style.borderRadius = "5px";
//    card.onclick = function(){
//         dragElement(card);
//    }
    //////////////////////////////////////
    // postit header
    //////////////////////////////////////
//    var postit_header = document.createElement("div");
//    postit_header.className = "postitcard-header";
////	postit_header.onmousedown = function(){
////		clog("mousedown ");
////	}
//	postit_header.onTouchStart = function(){
//		clog("ontouchStart");
//	}
////    postit_header.onclick = function(){
////        clog("onclick ");
////    }
//    postit_header.style.borderRadius = "5px 5px 0px 0px";
//    
//    
//    var ptitle = document.createElement("txt");
//    ptitle.className = "fmont";
//    ptitle.style.fontSize = "13px";
//    ptitle.style.float = "left";
//    ptitle.style.marginLeft = "10px";
//    ptitle.style.marginTop = "2px";
//    ptitle.style.fontWeight = "600";
////    ptitle.onclick = function(){
////        initPostItEvent(card);
////    }
//    
//    ptitle.innerHTML = data.date;
//    postit_header.appendChild(ptitle);
//    postit_header.innerHTML += "<span class='postitcard-close' style='color:#333333' >&#10006;</span>";
//    
//    //////////////////////////////////////
//    // postit header
//    //////////////////////////////////////
//    var postit_content = document.createElement("div");
//    postit_content.className = "postitcard-content";
//    postit_content.innerHTML = "<h3 class='postitcard-content-header' contenteditable='true' placeholder='Enter title here...'>"+data.title+"</h3><div class='postitcard-content-data' contentEditable='true' >"+data.content+"</div>";
//    
//    card.appendChild(postit_header);
//    card.appendChild(postit_content);
    

	
    card.innerHTML = 
        "<div class='postitcard-header' style='border-radius:5px 5px 0px 0px'  onmousedown='touchAvailable=true; onTouchStart(\""+id+"\");' onmousemove='onTouchMove(\""+id+"\");'  onmouseup='onTouchEnd(\""+id+"\");'   onmouseout='onTouchMove(\""+id+"\");'  >"+
            "<text class='fmont' style='font-size:13px;float:left;margin-left:10px;margin-top:2px;font-weight:600'>"+data.date+"</text><span class='postitcard-close' style='color:#333333' onclick='removeCard(\""+id+"\")' >&#10006;</span>"+
        "</div>"+
        "<div  class='postitcard-content' onclick ='onclickPostitBody(\""+id+"\")'>"+
            "<h3 class='postitcard-content-header' contenteditable='true' oninput='saveCardHeader(\""+id+"\")' placeholder='Enter title here...'>"+data.title+"</h3>"+
            "<div class='postitcard-content-data' contentEditable='true' oninput='saveCardContent(\""+id+"\")'>"+data.content+"</div>"+
        "</div>";
    
	
    board.appendChild(card);
    if(parseInt(data.top) < 70 )data.top = "70px";
    if(parseInt(data.left) < 260 )data.left = "260px";
    
    if (data.top == "") {
        card.style.top = `${(window.innerHeight - card.offsetHeight) / 2}px`;
        data.top = card.style.top;
    } else {
        card.style.top = data.top;
    }
    if (data.left == "") {
        card.style.left = `${(window.innerWidth - card.offsetWidth) / 2}px`;
        data.left = card.style.left;
    } else {
        card.style.left = data.left;
    }
    
    postit_cards_list[id] = data;
    setStorage();
    
    clog("document.body ",document.body);
}

 var pos1 = 0
      , pos2 = 0
      , pos3 = 0
      , pos4 = 0;

function onclickPostitBody(id){
     var postits = document.getElementsByClassName("postitcard");
    for(var i = 0 ; i < postits.length;i++)
        postits[i].style.zIndex = 0;

    var e = document.getElementById(id);
	e.style.zIndex = 1;
}
function onTouchStart(id){
    
    var postits = document.getElementsByClassName("postitcard");
    for(var i = 0 ; i < postits.length;i++)
        postits[i].style.zIndex = 0;
    
//                  
    var e = document.getElementById(id);
	//let id = e.id;
//	clog("onTouchStart ",e);
	e.style.zIndex = 1;
	e.selected = true;
	var me = window.event;
        
    pos3 = me.clientX;
    pos4 = me.clientY;
//	clog("postit me x "+pos3+" me y "+pos4);
//	clog("postit.clientX : "+e.style.left+" postit.clientY : "+e.style.top);
	
	//pos3 = getOnlyNumber(e.style.left);
	//pos4 = getOnlyNumber(e.style.top);
	
	
}

function onTouchMove(id){
     var e = document.getElementById(id);
    
//    console.log("onTouchMove ",e);
	if(!e.selected)return;
//	let id = e.id;
//	clog("onTouchMove ",e);
	
    
    //postit size
    //210,223
    var postit_width = e.clientWidth;
    var postit_height = e.clientHeight;
//    console.log("=============================");
//	console.log("postit_width ",e.clientWidth);
//	console.log("postit_width "+postit_width+" postit_height "+postit_height);
	var me = window.event;
    var x = me.clientX;
	var y = me.clientY;
	
	pos1 = pos3 - x;
	pos2 = pos4 - y;
	pos3 = x;
	pos4 = y;
//    console.log("x "+x+"y "+y);
//	clog("mx  "+pos1+" pos2 "+pos2+" pos3 "+pos3+" pos4 "+pos4);
	
	
    var screen_width = $(window).width();
	var screen_height = $(window).height();
	let new_top = (e.offsetTop - pos2)
	let new_left = (e.offsetLeft - pos1)
    
    /////////////////////////////////////////////////////////////
    //좌우위아래 부분 부딪혔을때 포스트잇을 잡고있는 이벤트를 해지한다.
    /////////////////////////////////////////////////////////////
    if(new_top < 70){
        new_top = 70;
        e.selected = false;
    }
    if(new_left < 260){
        new_left = 260;
        e.selected = false;
    }
    if(new_top > screen_height - postit_height-70){ //70 = bottom div height
        new_top = screen_height - postit_height-70;
        e.selected = false;
    }
    if(new_left > screen_width - postit_width){
        new_left = screen_width - postit_width;
        e.selected = false;
    }
    /////////////////////////////////////////////////////////////
    
    
	if ((new_top >= 0) && (new_top <= (window.innerHeight - e.offsetHeight))) {
		e.style.top = new_top + "px";
       
		postit_cards_list[id]["top"] = e.style.top;
	}
	if ((new_left >= 0) && (new_left <= (window.innerWidth - e.offsetWidth))) {
       
		e.style.left = new_left + "px";
		postit_cards_list[id]["left"] = e.style.left;
	}
	setStorage();
}
function onTouchEnd(id){
	 var e = document.getElementById(id);
	e.selected = false;
    
//	let id = e.id;
	
//	clog("onTouchEnd ",e);
	setStorage();
}

function saveCardHeader(id) {
     var e = document.getElementById(id);
//	let id = e.id;
//	clog("saveCardHeader",postit_cards_list[id]);
//	clog("e.target.innerHTML",e);
	
	postit_cards_list[id]["title"] =  e.querySelector(".postitcard-content-header").innerHTML;
	setStorage();
}
function saveCardContent(id) {
     var e = document.getElementById(id);
//	let id = e.id;
//	clog("saveCardContent",postit_cards_list[id]);
	postit_cards_list[id]["content"] = e.querySelector(".postitcard-content-data").innerHTML;
	setStorage();
}
function removeCard(id) {
      var e = document.getElementById(id);
//	 let id = e.id;
//	clog("removeCard",e);
	e.remove();
	delete postit_cards_list[id];
	setStorage();
}

/* 221012 유진 수정 */
document.addEventListener("DOMContentLoaded",()=>{
    getStorage();
    var state = document.readyState;
    clog(state);
    var tg = window.localStorage.key(9);
    var tg_v = window.localStorage.getItem(tg);
    var notes = document.getElementsByClassName('postitcard');
    clog(tg_v);
    Object.entries(postit_cards_list).forEach(item=>{
        //        clog("item0 "+item[0]+" item1 "+item[1]);
        //        clog("item1 ",item[1]);
                createCard(item[0], item[1]);
    });
    if(tg_v === "0"){
        $(notes).css({
            'display':'none'
        });
    }else {
        $(notes).css({
            'display':'block'
        });
    }
});
