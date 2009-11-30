/*Xoffset=-10;
Yoffset=20;
var nav,old,iex=(document.all),yyy=-1000;

if ( navigator.appName=="Netscape" ) {
    (is_nav6up())?nav=true:old=true;
}

if ( !old ) {
    var skn=(nav)?document.getElementById("dek").style:dek.style;
    if ( nav )document.captureEvents(Event.MOUSEMOVE);
    document.onmousemove=get_mouse;
}

function is_nav6up(){
    var appName = navigator.appName;
    var appVer = parseInt(navigator.appVersion);

    if ( appName == "Netscape" && appVer >= 5 )
        return true;
    else
        return false;
}

function get_mouse(e){
    var x=(nav)?e.pageX:event.x+document.body.scrollLeft;skn.left=x+Xoffset;
    var y=(nav)?e.pageY:event.y+document.body.scrollTop;skn.top=y+yyy;
}
function kill(){
    if ( !old ) {
        yyy=-1000;skn.visibility="hidden";
    }

}

function popup(img){
    foto1= new Image();
    foto1.src=(img);
    Controlla(img);
}
function Controlla(img){
    if ( (foto1.width!=0)&&(foto1.height!=0) ) {
        largh=foto1.width+2;
        altez=foto1.height+2;
        viewFoto(img);
    } else {
        largh=200;
        altez=100;
        viewFoto2();
    }
}
function viewFoto(img){
    var content="<table border=0 style='border:1px solid #000000;position:relative;left:-20;z-index:20;visibility:visible;top:"+(0-altez-50+360)+"' width="+largh+" height="+altez+" cellspacing=0 cellpadding=0><TR><TD align=center bgcolor=#ffffff><img src="+img+"></TD></TR></TABLE>";
	
    if ( old ) {
        alert(img);return;
    } else {
        yyy=Yoffset;
        if ( nav ) {
            document.getElementById("dek").innerHTML=content;skn.visibility="visible";
        }
        if ( iex ) {
            document.all.dek.innerHTML=content;skn.visibility="visible"
        }
    }
}
function viewFoto2(){
    var content="";
    if ( old ) {
        alert(img);return;
    } else {
        yyy=Yoffset;
        if ( nav ) {
            document.getElementById("dek").innerHTML=content;skn.visibility="visible";
        }
        if ( iex ) {
            document.all.dek.innerHTML=content;skn.visibility="visible"
        }
    }
}
*/


function html_trans(str) {

    str = str.replace(/\r/g,"");
    str = str.replace(/<a[^>]+product.pchome.net\/exif.php\?model=[^>]+>(.*?)<\/a>/ig,"");
    str = str.replace(/<em>(.*?)<\/em>/ig,"");
    str = str.replace(/\n/g,"\n");
    str = str.replace(/on(load|click|dbclick|mouseover|mousedown|mouseup)="[^"]+"/ig,"");
    str = str.replace(/<script[^>]*?>([\w\W]*?)<\/script>/ig,"");
    str = str.replace(/<style[^>]*?>([\w\W]*?)<\/style>/ig,"");
    str = str.replace(/<a[^>]+href="(http|https|mms|rstp|ed2k|ftp|news|thunder|tencent|gopher|telnet)([^"]+)"[^>]*>(.*?)<\/a>/ig,"[url=$1$2]$3[/url]"); 
    //str = str.replace(/<font[^>]+color=([^ >]+)[^>]*>(.*?)<\/font>/ig,"[color=$1]$2[/color]"); 
    str = str.replace(/<font[^>]+size=([^ >]+)[^>]*>(.*?)<\/font>/ig,"[size=$1]$2[/size]");
    //str = str.replace(/<font[^>]+face=([^ >]+)[^>]*>(.*?)<\/font>/ig,"[font=$1]$2[/font]\n\r");
    str = str.replace(/<p>(.*?)<\/p>/ig,"\n$1\n");
    str = str.replace(/<img[^>]+src="http:\/\/img\.club\.pchome\.net\/html\/images\/icon\/ico([0-9]{1,2})\.gif"[^>]*>/ig,"{$1}");
    str = str.replace(/<img[^>]+src="([^"]+)"[^>]*>/ig,"\n[br][img]$1[/img]\n");
    //str = str.replace(/<div[^>]+align="([^"]+)"[^>]*>(.*?)<\/div>/ig,"[aligen=$1]$2[/align]");
    //str = str.replace(/<p[^>]+align="([^"]+)"[^>]*>(.*?)<\/p>/ig,"[aligen=$1]$2[/align]");
    str = str.replace(/<([\/]?)b>/ig,"[$1b]");
    //str = str.replace(/<([\/]?)strong>/ig,"[$1b]");
    str = str.replace(/<([\/]?)strong>/ig,"[$1strong]");
    //str = str.replace(/<([\/]?)u>/ig,"");
    str = str.replace(/<([\/]?)i>/ig,"[$1i]");
    str = str.replace(/<([\/]?)em>/ig,"[$1i]");
    str = str.replace(/&nbsp;/g," ");
	str = str.replace(/&amp;/g,"&");
	str = str.replace(/&quot;/g,"\"");
	str = str.replace(/&lt;/g,"<");
	str = str.replace(/&gt;/g,">");
    str = str.replace(/<br>/ig,"[br]");
    str = str.replace(/<[^>]*?>/g,"");
    str = str.replace(/\[url=([^\]]+)\](\[img\]\1\[\/img\])\[\/url\]/g,"$2");
    //str = str.replace(/\n+/g,"\n");  
    return str;
}


function quoteMsg(msgId){
	
    var msgObj  = document.getElementById('__Message_' + msgId);
	
	var quoteHTML=html_trans(msgObj.innerHTML);
	quoteHTML=quoteHTML.replace(/\n+/g,"\n");  
	
    var quoteMsg = "[quote]" + quoteHTML + "[/quote]";
	
	
	/*replyContentObj = document.getElementById('message');
	
	if(replyContentObj != null){
		replyContentObj.innerHTML = quoteMsg;
	}*/
	

    AddText(quoteMsg);
}
