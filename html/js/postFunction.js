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
        if ( str<="~" ) //�ж��Ƿ�˫�ֽ�
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
        message = "ϵͳ����8000 �ַ�";
    } else {
        message = "";
    }
    alert("\n��ǰ���ȣ�"+checkStrLen(theform.message.value)+" �ַ�\n\n"+message);
}
function validate() {
    if ( document.input.title.value == "" || document.input.message.value == "" ) {
        alert("����ɱ������������");
        return;
    }
	
	var _ctrl = document.getElementById('sortid');

	if (_ctrl != null) {

		if (_ctrl.value == -999) {
			
			alert("��ѡ�������Ļ�����ࡣ");
			return;
		}
	}

    if ( checkStrLen(document.input.message.value) > postmaxchars ) {
        alert("�������ӳ��ȳ�������\n\n��ǰ���ȣ�"+checkStrLen(document.input.message.value)+" �ַ�\nϵͳ����" + postmaxchars + " �ַ�");
        return;
    }

		//����У��
	var _prop = document.getElementById('propId');
	if (_prop != null)
	{
		if (_prop.value!=""){
			switch (_prop.value){
				case "9"://����
					if (document.input.reportCount.value.replace(/(^\s*)|(\s*$)/g, "")==""){
						alert ("������������Ϊ�գ�");
						return;
					}
					if (isNaN(parseInt(document.input.reportCount.value)) || parseInt(document.input.reportCount.value)<1){
						alert ("������������Ϊ�����Ҵ�����!");
						return;
					}
					
				break;
				case "11"://�н�
					if (document.input.awardNum.value.replace(/(^\s*)|(\s*$)/g, "")==""){
						alert ("PP��ֵ����Ϊ�գ�");
						return;
					}
					if (isNaN(parseInt(document.input.awardNum.value)) || parseInt(document.input.awardNum.value)<1){
						alert ("PP��ֵ����Ϊ�����Ҵ�����!");
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
defmode = "normalmode";                // Ĭ��ģʽ����ѡ normalmode, advmode, �� helpmode
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
        alert("������Ϣ\n\n�����Ӧ�Ĵ��밴ť���ɻ����Ӧ��˵������ʾ");
    } else if ( swtch == 0 ) {
        helpmode = false;
        normalmode = false;
        advmode = true;
        alert("ֱ�Ӳ���\n\n������밴ť�󲻳�����ʾ��ֱ�Ӳ�����Ӧ����");
    } else if ( swtch == 2 ) {
        helpmode = false;
        advmode = false;
        normalmode = true;
        alert("��ʾ����\n\n������밴ť������򵼴��ڰ�������ɴ������");
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
        alert("�����ʼ���ַ\n\n�����ʼ���ַ���ӡ�\n���磺\n[email]support@www.fkduo.cn[/email]\n[email=support@www.fkduo.cn]Club[/email]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[email]" + range.text + "[/email]";
    } else if ( advmode ) {
        AddTxt="[email] [/email]";
        AddText(AddTxt);
    } else {
        txt2=prompt("������������ʾ�����֣����������ֱ����ʾ�ʼ���ַ��","");
        if ( txt2!=null ) {
            txt=prompt("�������ʼ���ַ��","name@domain.com");
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
        alert("�����ֺ�\n\n����ǩ����Χ���������ó�ָ���ֺš�\n���磺[size=3]���ִ�СΪ 3[/size]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[size=" + size + "]" + range.text + "[/size]";
    } else if ( advmode ) {
        AddTxt="[size="+size+"] [/size]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ����Ϊ�ֺ� "+size+" �����֡�","����");
        if ( txt!=null ) {
            AddTxt="[size="+size+"]"+txt;
            AddText(AddTxt);
            AddText("[/size]");
        }
    }
}
function chfont(font) {
    if ( helpmode ) {
        alert("�趨����\n\n����ǩ����Χ���������ó�ָ�����塣\n���磺[font=����]����Ϊ����[/font]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[font=" + font + "]" + range.text + "[/font]";
    } else if ( advmode ) {
        AddTxt="[font="+font+"] [/font]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ���ó� "+font+" �����֡�","����");
        if ( txt!=null ) {
            AddTxt="[font="+font+"]"+txt;
            AddText(AddTxt);
            AddText("[/font]");
        }
    }
}
function bold() {
    if ( helpmode ) {
        alert("��������ı�\n\n����ǩ����Χ���ı���ɴ��塣\n���磺[b]����[/b]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[b]" + range.text + "[/b]";
    } else if ( advmode ) {
        AddTxt="[b] [/b]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ���óɴ�������֡�","����");
        if ( txt!=null ) {
            AddTxt="[b]"+txt;
            AddText(AddTxt);
            AddText("[/b]");
        }
    }
}
function italicize() {
    if ( helpmode ) {
        alert("����б���ı�\n\n����ǩ����Χ���ı����б�塣\n���磺[i]����[/i]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[i]" + range.text + "[/i]";
    } else if ( advmode ) {
        AddTxt="[i] [/i]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ���ó�б������֡�","����");
        if ( txt!=null ) {
            AddTxt="[i]"+txt;
            AddText(AddTxt);
            AddText("[/i]");
        }
    }
}
function quote() {
    if ( helpmode ) {
        alert("��������\n\n����ǩ����Χ���ı���Ϊ����������ʾ��\n���磺[quote]����[/quote]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[quote]" + range.text + "[/quote]";
    } else if ( advmode ) {
        AddTxt="\r[quote]\r[/quote]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ��Ϊ������ʾ�����֡�","����");
        if ( txt!=null ) {
            AddTxt="\r[quote]\r"+txt;
            AddText(AddTxt);
            AddText("\r[/quote]");
        }
    }
}
function chcolor(color) {
    if ( helpmode ) {
        alert("���붨����ɫ�ı�\n\n����ǩ����Χ���ı���Ϊ�ƶ���ɫ��\n���磺[color=red]����ɫ[/color]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[color=" + color + "]" + range.text + "[/color]";
    } else if ( advmode ) {
        AddTxt="[color="+color+"] [/color]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ���ó���ɫ "+color+" �����֡�","����");
        if ( txt!=null ) {
            AddTxt="[color="+color+"]"+txt;
            AddText(AddTxt);
            AddText("[/color]");
        }
    }
}
function center() {
    if ( helpmode ) {
        alert("���ж���\n\n����ǩ����Χ���ı����ж�����ʾ��\n���磺[align=center]���ݾ���[/align]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[center]" + range.text + "[/center]";
    } else if ( advmode ) {
        AddTxt="[align=center] [/align]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ���ж�������֡�","����");
        if ( txt!=null ) {
            AddTxt="\r[align=center]"+txt;
            AddText(AddTxt);
            AddText("[/align]");
        }
    }
}



function hyperlink() {
    if ( helpmode ) {
        alert("���볬������\n\n����һ���������ӡ�\n���磺\n[url]http://www.fkduo.cn[/url]\n[url=http://www.fkduo.cn]����[/url]");
    } else if ( advmode ) {
        AddTxt="[url] [/url]";
        AddText(AddTxt);
    } else {
        txt2=prompt("������������ʾ�����֣����������ֱ����ʾ���ӡ�","");
        if ( txt2!=null ) {
            txt=prompt("������ URL��","http://");
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
        alert("����ͼ��\n\n���ı��в���һ��ͼ��\n���磺[img]http://www.fkduo.cn/images/logo.gif[/img]");
    } else if ( advmode ) {
        AddTxt="[img] [/img]";
        AddText(AddTxt);
    } else {
        txt=prompt("������ͼ��� URL��","http://");
        if ( txt!=null ) {
            AddTxt="\r[img]"+txt;
            AddText(AddTxt);
            AddText("[/img]");
        }
    }
}

function media() {
    if ( helpmode ) {
        alert("����Ӱ��\n\n���ı��в���һӰ��\n���磺[wedia]http://www.fkduo.cn/images/test.wmf[/media]");
    } else if ( advmode ) {
        AddTxt="[media] [/media]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ӱ��� URL��","http://");
        if ( txt!=null ) {
            AddTxt="\r[media]"+txt;
            AddText(AddTxt);
            AddText("[/media]");
        }
    }
}


function flash() {
    if ( helpmode ) {
        alert("�ڷ�/�����ı������в���FLASH����/��Ƶ\n\r�ɲ���FLASH��Դ�ļ���ַ��");
    } else if ( advmode ) {
        AddTxt="[flash] [/flash]";
        AddText(AddTxt);
    } else {
        txt=prompt("������FLASH����/��Ƶ�ġ�Դ�ļ���ַ","http://");
        if ( txt!=null ) {
            AddTxt="\r[flash]"+txt;
            AddText(AddTxt);
            AddText("[/flash]");
        }
    }
}


function code() {
    if ( helpmode ) {
        alert("�������\n\n��������ű�ԭʼ���롣\n���磺[code]echo\"���������ǵ���̳\";[/code]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[code]" + range.text + "[/code]";
    } else if ( advmode ) {
        AddTxt="\r[code]\r[/code]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ����Ĵ��롣","");
        if ( txt!=null ) {
            AddTxt="\r[code]"+txt;
            AddText(AddTxt);
            AddText("[/code]");
        }
    }
}
function list() {
    if ( helpmode ) {
        alert("�����б���\n\n��������������ʾ���Ĺ����б��\n���磺\n[list]\n[*]���б��� #1\n[*]���б��� #2\n[*]���б��� #3\n[/list]");
    } else if ( advmode ) {
        AddTxt="\r[list]\r[*]\r[*]\r[*]\r[/list]";
        AddText(AddTxt);
    } else {
        txt=prompt("��ѡ���б��ʽ����ĸʽ�б����� \"A\"������ʽ�б����� \"1\"���˴�Ҳ�����ա�","");
        while ( (txt!="") && (txt!="A") && (txt!="a") && (txt!="1") && (txt!=null) ) {
            txt=prompt("�����б��ʽֻ��ѡ������ \"A\" �� \"1\"��","");
        }
        if ( txt!=null ) {
            if ( txt=="" ) {
                AddTxt="\r[list]\r\n";
            } else {
                AddTxt="\r[list="+txt+"]\r";
            }
            txt="1";
            while ( (txt!="") && (txt!=null) ) {
                txt=prompt("�������б���Ŀ���ݣ�������ձ�ʾ��Ŀ������","");
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
        alert("�����»���\n\n����ǩ����Χ���ı������»��ߡ�\n���磺[u]����[/u]");
    } else if ( document.selection && document.selection.type == "Text" ) {
        var range = document.selection.createRange();
        range.text = "[u]" + range.text + "[/u]";
    } else if ( advmode ) {
        AddTxt="[u] [/u]";
        AddText(AddTxt);
    } else {
        txt=prompt("������Ҫ���»��ߵ����֡�","����");
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

//ȥͷβ�հ�
function trim(str) {

    rx = new RegExp('^[ ]*','g');
    str = str.replace(rx,'');
    rx = new RegExp('[ ]*$','g');
    str.replace(rx,'');

    return str;
}