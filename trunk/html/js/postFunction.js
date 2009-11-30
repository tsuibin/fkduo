function Popup(url, window_name, window_width, window_height) {settings="toolbar=no,location=no,directories=no,"+"status=no,menubar=no,scrollbars=yes,"+"resizable=yes,width="+window_width+",height="+window_height;NewWindow=window.open(url,window_name,settings);}
function ctlent(obj) {
	if(!document.all)
	{
		
		if( (obj.ctrlKey && obj.keyCode==13) || (obj.altKey && obj.keyCode==83))
		{
			
			validate();
		}
	}else
	{
		if ( (event.ctrlKey && window.event.keyCode == 13) || (event.altKey && window.event.keyCode == 83) ) {
			validate();
		}
	}


	
}
function checkall(form) {for ( var i = 0;i < form.elements.length; i++ ) {
        var e = form.elements[i];if ( e.name != 'chkall' ) e.checked = form.chkall.checked;
    }}
function findobj(n, d) {var p,i,x; if ( !d ) d=document;if ( (p=n.indexOf("?"))>0&&parent.frames.length ) {
        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);
    }if ( !(x=d[n])&&d.all ) x=d.all[n];for ( i=0;!x&&i<d.forms.length;i++ ) x=d.forms[i][n]; for ( i=0;!x&&d.layers&&i>d.layers.length;i++ ) x=MM_findObj(n,d.layers[i].document); return x;}
function copycode(obj) {var rng = document.body.createTextRange();rng.moveToElementText(obj);rng.scrollIntoView();rng.select();rng.execCommand("Copy");rng.collapse(false);}


function checkStrLen(value){
	
	var str,Num = 0;
    for ( var i=0;i<value.length;i++ ) {
        str = value.substring(i,i+1);
        if ( str<="~" ) //判断是否双字节
            Num+=1;
        else
            Num+=2;
    }
    return Num;
}


var postmaxchars = 8000;
var isadmin = 1;


function checklength(theform) {

    if ( postmaxchars != 0 ) {
        message = "系统允许：8000 字符";
    } else {
        message = "";
    }
    alert("\n当前长度："+checkStrLen(theform.message.value)+" 字符\n\n"+message);
}
function validate() {
    if ( document.input.title.value == "" || document.input.message.value == "" ) {
        alert("请完成标题和内容栏。");
        return;
    }
	
	var _ctrl = document.getElementById('sortid');

	if (_ctrl != null) {

		if (_ctrl.value == -999) {
			
			alert("请选择所属的话题分类。");
			return;
		}
	}

    if ( checkStrLen(document.input.message.value) > postmaxchars ) {
        alert("您的贴子长度超过限制\n\n当前长度："+checkStrLen(document.input.message.value)+" 字符\n系统允许：" + postmaxchars + " 字符");
        return;
    }

		//道具校验
	var _prop = document.getElementById('propId');
	if (_prop != null)
	{
		if (_prop.value!=""){
			switch (_prop.value){
				case "9"://报名
					if (document.input.reportCount.value.replace(/(^\s*)|(\s*$)/g, "")==""){
						alert ("报名人数不能为空！");
						return;
					}
					if (isNaN(parseInt(document.input.reportCount.value)) || parseInt(document.input.reportCount.value)<1){
						alert ("报名人数必须为整数且大于零!");
						return;
					}
					
				break;
				case "11"://有奖
					if (document.input.awardNum.value.replace(/(^\s*)|(\s*$)/g, "")==""){
						alert ("PP分值不能为空！");
						return;
					}
					if (isNaN(parseInt(document.input.awardNum.value)) || parseInt(document.input.awardNum.value)<1){
						alert ("PP分值必须为整数且大于零!");
						return;
					}
				break;
			}
		}
	}

	var obj = document.getElementById('sendMessageBtn');
	if (obj != null) {

		if (obj.disabled == true) {

			return;  
		} else {

			obj.disabled = true;
		}
	}
  
    document.input.submit();
}
function inputs(str)
{document.input.message.value=document.input.message.value+str;}
defmode = "normalmode";                // 默认模式，可选 normalmode, advmode, 或 helpmode
if ( defmode == "advmode" ) {
    helpmode = false;
    normalmode = false;
    advmode = true;
} else if ( defmode == "helpmode" ) {
    helpmode = true;
    normalmode = false;
    advmode = false;
} else {
    helpmode = false;
    normalmode = true;
    advmode = false;
}
function chmode(swtch){
    if ( swtch == 1 ) {
        advmode = false;
        normalmode = false;
        helpmode = true;
        alert("帮助信息\n\n点击相应的代码按钮即可获得相应的说明和提示");
    } else if ( swtch == 0 ) {
        helpmode = false;
        normalmode = false;
        advmode = true;
        alert("直接插入\n\n点击代码按钮后不出现提示即直接插入相应代码");
    } else if ( swtch == 2 ) {
        helpmode = false;
        advmode = false;
        normalmode = true;
        alert("提示插入\n\n点击代码按钮后出现向导窗口帮助您完成代码插入");
    }
}
function AddText(NewCode) {
	
    if ( document.all ) {
        insertAtCaret(document.input.message, NewCode);
        setfocus();
    } else {
        document.input.message.value += NewCode;
        setfocus();
    }
}
function storeCaret (textEl){
    if ( textEl.createTextRange ) {
        textEl.caretPos = document.selection.createRange().duplicate();
    }
}
function insertAtCaret (textEl, text){
	
    if ( textEl.createTextRange && textEl.caretPos ) {
		
        var caretPos = textEl.caretPos;
        caretPos.text += caretPos.text.charAt(caretPos.text.length - 2) == ' ' ? text + ' ' : text;
    } else if ( textEl ) {
		
        textEl.value += text;
    } else {
		
        textEl.value = text;
    }
}
function email() {
    if ( helpmode ) {
        alert("插入邮件地址\n\n插入邮件地址连接。\n例如：\n[email]support@www.fkduo.cn[/email]\n[email=support@www.fkduo.cn]Club[/email]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[email]" + range.text + "[/email]";
    } else if ( advmode ) {
        AddTxt="[email] [/email]";
        AddText(AddTxt);
    } else {
        txt2=prompt("请输入链接显示的文字，如果留空则直接显示邮件地址。","");
        if ( txt2!=null ) {
            txt=prompt("请输入邮件地址。","name@domain.com");
            if ( txt!=null ) {
                if ( txt2=="" ) {
                    AddTxt="[email]"+txt+"[/email]";
                } else {
                    AddTxt="[email="+txt+"]"+txt2+"[/email]";
                }
                AddText(AddTxt);
            }
        }
    }
}
function chsize(size) {
    if ( helpmode ) {
        alert("设置字号\n\n将标签所包围的文字设置成指定字号。\n例如：[size=3]文字大小为 3[/size]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[size=" + size + "]" + range.text + "[/size]";
    } else if ( advmode ) {
        AddTxt="[size="+size+"] [/size]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要设置为字号 "+size+" 的文字。","文字");
        if ( txt!=null ) {
            AddTxt="[size="+size+"]"+txt;
            AddText(AddTxt);
            AddText("[/size]");
        }
    }
}
function chfont(font) {
    if ( helpmode ) {
        alert("设定字体\n\n将标签所包围的文字设置成指定字体。\n例如：[font=仿宋]字体为仿宋[/font]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[font=" + font + "]" + range.text + "[/font]";
    } else if ( advmode ) {
        AddTxt="[font="+font+"] [/font]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要设置成 "+font+" 的文字。","文字");
        if ( txt!=null ) {
            AddTxt="[font="+font+"]"+txt;
            AddText(AddTxt);
            AddText("[/font]");
        }
    }
}
function bold() {
    if ( helpmode ) {
        alert("插入粗体文本\n\n将标签所包围的文本变成粗体。\n例如：[b]文字[/b]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[b]" + range.text + "[/b]";
    } else if ( advmode ) {
        AddTxt="[b] [/b]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要设置成粗体的文字。","文字");
        if ( txt!=null ) {
            AddTxt="[b]"+txt;
            AddText(AddTxt);
            AddText("[/b]");
        }
    }
}
function italicize() {
    if ( helpmode ) {
        alert("插入斜体文本\n\n将标签所包围的文本变成斜体。\n例如：[i]文字[/i]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[i]" + range.text + "[/i]";
    } else if ( advmode ) {
        AddTxt="[i] [/i]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要设置成斜体的文字。","文字");
        if ( txt!=null ) {
            AddTxt="[i]"+txt;
            AddText(AddTxt);
            AddText("[/i]");
        }
    }
}
function quote() {
    if ( helpmode ) {
        alert("插入引用\n\n将标签所包围的文本作为引用特殊显示。\n例如：[quote]文字[/quote]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[quote]" + range.text + "[/quote]";
    } else if ( advmode ) {
        AddTxt="\r[quote]\r[/quote]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要作为引用显示的文字。","文字");
        if ( txt!=null ) {
            AddTxt="\r[quote]\r"+txt;
            AddText(AddTxt);
            AddText("\r[/quote]");
        }
    }
}
function chcolor(color) {
    if ( helpmode ) {
        alert("插入定义颜色文本\n\n将标签所包围的文本变为制定颜色。\n例如：[color=red]红颜色[/color]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[color=" + color + "]" + range.text + "[/color]";
    } else if ( advmode ) {
        AddTxt="[color="+color+"] [/color]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要设置成颜色 "+color+" 的文字。","文字");
        if ( txt!=null ) {
            AddTxt="[color="+color+"]"+txt;
            AddText(AddTxt);
            AddText("[/color]");
        }
    }
}
function center() {
    if ( helpmode ) {
        alert("居中对齐\n\n将标签所包围的文本居中对齐显示。\n例如：[align=center]内容居中[/align]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[center]" + range.text + "[/center]";
    } else if ( advmode ) {
        AddTxt="[align=center] [/align]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要居中对齐的文字。","文字");
        if ( txt!=null ) {
            AddTxt="\r[align=center]"+txt;
            AddText(AddTxt);
            AddText("[/align]");
        }
    }
}



function hyperlink() {
    if ( helpmode ) {
        alert("插入超级链接\n\n插入一个超级连接。\n例如：\n[url]http://www.fkduo.cn[/url]\n[url=http://www.fkduo.cn]文字[/url]");
    } else if ( advmode ) {
        AddTxt="[url] [/url]";
        AddText(AddTxt);
    } else {
        txt2=prompt("请输入链接显示的文字，如果留空则直接显示链接。","");
        if ( txt2!=null ) {
            txt=prompt("请输入 URL。","http://");
            if ( txt!=null ) {
                if ( txt2=="" ) {
                    AddTxt="[url]"+txt;
                    AddText(AddTxt);
                    AddText("[/url]");
                } else {
                    AddTxt="[url="+txt+"]"+txt2;
                    AddText(AddTxt);
                    AddText("[/url]");
                }
            }
        }
    }
}



function image() {
    if ( helpmode ) {
        alert("插入图像\n\n在文本中插入一幅图像。\n例如：[img]http://www.fkduo.cn/images/logo.gif[/img]");
    } else if ( advmode ) {
        AddTxt="[img] [/img]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入图像的 URL。","http://");
        if ( txt!=null ) {
            AddTxt="\r[img]"+txt;
            AddText(AddTxt);
            AddText("[/img]");
        }
    }
}

function media() {
    if ( helpmode ) {
        alert("插入影像\n\n在文本中插入一影像。\n例如：[wedia]http://www.fkduo.cn/images/test.wmf[/media]");
    } else if ( advmode ) {
        AddTxt="[media] [/media]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入影像的 URL。","http://");
        if ( txt!=null ) {
            AddTxt="\r[media]"+txt;
            AddText(AddTxt);
            AddText("[/media]");
        }
    }
}


function flash() {
    if ( helpmode ) {
        alert("在发/回帖文本内容中插入FLASH动画/视频\n\r可插入FLASH“源文件地址”");
    } else if ( advmode ) {
        AddTxt="[flash] [/flash]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入FLASH动画/视频的“源文件地址","http://");
        if ( txt!=null ) {
            AddTxt="\r[flash]"+txt;
            AddText(AddTxt);
            AddText("[/flash]");
        }
    }
}


function code() {
    if ( helpmode ) {
        alert("插入代码\n\n插入程序或脚本原始代码。\n例如：[code]echo\"这里是我们的论坛\";[/code]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[code]" + range.text + "[/code]";
    } else if ( advmode ) {
        AddTxt="\r[code]\r[/code]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要插入的代码。","");
        if ( txt!=null ) {
            AddTxt="\r[code]"+txt;
            AddText(AddTxt);
            AddText("[/code]");
        }
    }
}
function list() {
    if ( helpmode ) {
        alert("插入列表项\n\n插入可由浏览器显示来的规则列表项。\n例如：\n[list]\n[*]；列表项 #1\n[*]；列表项 #2\n[*]；列表项 #3\n[/list]");
    } else if ( advmode ) {
        AddTxt="\r[list]\r[*]\r[*]\r[*]\r[/list]";
        AddText(AddTxt);
    } else {
        txt=prompt("请选择列表格式：字母式列表输入 \"A\"；数字式列表输入 \"1\"。此处也可留空。","");
        while ( (txt!="") && (txt!="A") && (txt!="a") && (txt!="1") && (txt!=null) ) {
            txt=prompt("错误：列表格式只能选择输入 \"A\" 或 \"1\"。","");
        }
        if ( txt!=null ) {
            if ( txt=="" ) {
                AddTxt="\r[list]\r\n";
            } else {
                AddTxt="\r[list="+txt+"]\r";
            }
            txt="1";
            while ( (txt!="") && (txt!=null) ) {
                txt=prompt("请输入列表项目内容，如果留空表示项目结束。","");
                if ( txt!="" ) {
                    AddTxt+="[*]"+txt+"\r";
                }
            }
            AddTxt+="[/list]\r\n";
            AddText(AddTxt);
        }
    }
}

function underline() {
    if ( helpmode ) {
        alert("插入下划线\n\n给标签所包围的文本加上下划线。\n例如：[u]文字[/u]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[u]" + range.text + "[/u]";
    } else if ( advmode ) {
        AddTxt="[u] [/u]";
        AddText(AddTxt);
    } else {
        txt=prompt("请输入要加下划线的文字。","文字");
        if ( txt!=null ) {
            AddTxt="[u]"+txt;
            AddText(AddTxt);
            AddText("[/u]");
        }
    }
}

function setfocus() {
    document.input.message.focus();
}

function banWord(theform){

	iframe1.banWordForm.banWordText.value = theform.message.value;
	iframe1.banWordForm.submit();
	
}

//去头尾空白
function trim(str) {

    rx = new RegExp('^[ ]*','g');
    str = str.replace(rx,'');
    rx = new RegExp('[ ]*$','g');
    str.replace(rx,'');

    return str;
}