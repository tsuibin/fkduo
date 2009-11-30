function updateverifyCode() {
	
	if ($('verifyCodeDiv').style.display == 'none') {
		
		$('verifyCodeDiv').style.display = 'block';	
	}
}

function changeExtFormDisplay() {
	
	$('kdsRegFormExtWrapper').style.display = ($('advacedOption').checked) ? '' : 'none';
}

function changeverifycode() {
	
	$('verifyCodePic').style.display = 'none';
	$('verifyCodePic').src = '/register/auth-' + Math.random() + '.html';
	$('verifyCodePic').style.display = '';
}

function divDisplay(objName, msg) {
	
	$(objName).style.display = '';
	$(objName).innerHTML = "&nbsp;&nbsp;" + msg;
	$(objName).className = 'inf_error';
}

function ajaxVerify(url, objName, msg, recall) {
	
		var x = new Ajax('HTML', objName);
		
		x.get(url, function(result) {
			
			result = trim(result);
			if (result == 'inf_succeed') {
				
				$(objName).style.display = '';
				$(objName).innerHTML = "&nbsp;&nbsp;" + msg;
				$(objName).className = 'inf_succeed'; 		
			} else {
				
				var tmp = result.split("{\n\n\n\n}");
				
				msg = tmp[0];
				result = (tmp.length == 1) ? '' : tmp[1];
							
				divDisplay(objName, msg);
				if (recall != '')
					eval(recall);			
			}
		});
}

function v(objName) {
	
	return trim($(objName).value);
}

function getInfObjName(objName) {
	
	return objName + 'Inf';
}

var lastCode = '';
function checkverifyCode() {
	
	var objName = 'verifyCode';
	var objNameInf = getInfObjName(objName);
	var code = v(objName);	
	var regExp = /^[0-9]{4,5}$/;
	
	if (code == lastCode)
		return;		
	else
		lastCode = code;	
		
	if (!regExp.test(code)) {
		
		divDisplay(objNameInf, '不正确的检验码，检验码为 4-5 位的数字');	
		return;
	}
	ajaxVerify('/register/verify-code-' + code + '.html', objNameInf, '检验码正确，可以使用', 'changeverifycode();');
	return 'AJAX';
}

var lastUserName = '';
function checkusername() {
	
	var objName = 'userName';
	var objNameInf = getInfObjName(objName);
	var userName = v(objName);	
	var regExp = /^[a-zA-z]{1}[a-zA-z0-9_]{3,19}$/;
	
	if (userName == lastUserName)
		return;		
	else
		lastUserName = userName;
	
	if (! regExp.test(userName)) {
		
		divDisplay(objNameInf, '用户名格式不正确只能包含有数字、字符、下划线，并必须以字符开始，长度为 4-20 个字符长度');	
		return;	
	}	
	
	ajaxVerify('/register/verify-user-' + escape(encodeURI(userName)) + '.html', objNameInf, '用户名“' + userName +'” 可以使用', '');
	return 'AJAX';
}

var lastNickName = '';
function checkNickName() {
	
	var objName = 'nickName';
	var objNameInf = getInfObjName(objName);
	var nickName = v(objName);	
	
	if (nickName == lastNickName)
		return;		
	else
		lastNickName = nickName;
		
	if ( nickName == '') {
	
		divDisplay(objNameInf, '昵称不能为空');	
		return;
	}
		
	if (getLen(nickName) > 10 ) {
		
		divDisplay(objNameInf, '昵称长度不正确，需小于 10 个字符长度');	
		return;	
	}	
	
	ajaxVerify('/register/verify-nickname-' + escape(encodeURI(nickName)) + '.html', objNameInf, '昵称“' + nickName +'” 可以使用', '$("' +objName + '").value=result; $("' + objNameInf +'").className="inf_succeed";lastNickName=result;');
	return 'AJAX';
}

var lastEmail = '';
function checkmail() {

	var objName = 'email';
	var objNameInf = getInfObjName(objName);
	var email = v(objName);	
	
	if (email == lastEmail) 
		return;	
	else
		lastEmail = email;	
	
	var regExp = /^((([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+(\.([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+)*)@((((([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.))*([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.)[\w]{2,4}|(((([0-9]){1,3}\.){3}([0-9]){1,3}))|(\[((([0-9]){1,3}\.){3}([0-9]){1,3})\])))$/;	
	if (! regExp.test(email)) {
		
		divDisplay(objNameInf, '电子邮件格式不正确，请重新输入');	
		return;	
	}
	
	divDisplay('emailInf', '');
	$('emailInf').className = 'inf_succeed';
}

function checkpassword() {
	
	var password = v('password');	
	var rPassword = v('repeatPwd');

	if (password == '') {
		
		divDisplay('passwordInf', '密码需长度为 4-20 的任意字符');
		$('passwordInf').className = 'inf_normal';
		divDisplay('repeatPwdInf', '');
		$('repeatPwdInf').className = 'inf_normal';
		return;
	}
	
	if (password == '') {
		
		divDisplay('repeatPwdInf', '');
		$('repeatPwdInf').className = 'inf_normal';		
	}
	
	if (getLen(password) < 4 || getLen(password) > 20) {
		
		divDisplay('passwordInf', '密码为长度 4-20 的任意字符,请重新输入');
	} else {
		
		divDisplay('passwordInf', '');
		$('passwordInf').className = 'inf_succeed';	
		
		if (rPassword == '') {
			
			divDisplay('repeatPwdInf', '');
			$('repeatPwdInf').className = 'inf_normal';
			return;
		}	
	}
	
	if (rPassword != password) {
		
		divDisplay('repeatPwdInf', '二次输入的密码不一致');	
	} else {
		
		divDisplay('repeatPwdInf', '');
		$('repeatPwdInf').className = 'inf_succeed';	
	}
}

var lastMsn = '';
function checkmsn() {
	
	var objName = 'msn';
	var objNameInf = getInfObjName(objName);
	var msn = v(objName);	
	
	if (msn == lastMsn) 
		return;	
	else
		lastMsn = msn;	
	
	if (msn == '') {
		
		divDisplay(objNameInf, '');	
		$(objNameInf).className = 'inf_normal';	
		return;
	}
	
	var regExp = /^((([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+(\.([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+)*)@((((([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.))*([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.)[\w]{2,4}|(((([0-9]){1,3}\.){3}([0-9]){1,3}))|(\[((([0-9]){1,3}\.){3}([0-9]){1,3})\])))$/;	
	if (! regExp.test(msn)) {
		
		divDisplay(objNameInf, 'MSN格式不正确，请重新输入');	
	} else {
		
		divDisplay(objNameInf, '');	
		$(objNameInf).className = 'inf_succeed';	
	}	
}

var lastQq = '';
function checkqq() {
	
	var objName = 'qq';
	var objNameInf = getInfObjName(objName);
	var qq = v(objName);	
	
	if (qq == lastQq) 
		return;	
	else
		lastQq = qq;	
	
	if (qq == '') {
		
		divDisplay(objNameInf, '');	
		$(objNameInf).className = 'inf_normal';	
		return;
	}
	
	var regExp = /^[0-9]{4,15}$/;	
	if (! regExp.test(qq)) {
		
		divDisplay(objNameInf, 'QQ格式不正确，请重新输入');	
	} else {
		
		divDisplay(objNameInf, '');	
		$(objNameInf).className = 'inf_succeed';			
	}
}

var lastBathday = ''
function checkbathday() {
	
	var objName = 'bathday';
	var objNameInf = getInfObjName(objName);
	var bathday = v(objName);	
	
	if (bathday == lastBathday)
		return;		
	else
		lastBathday = bathday;	
	
	if (bathday == '') {
		
		divDisplay(objNameInf, '请按 年-月-日 的格式输入');
		$(objNameInf).className = 'inf_normal';	
		return;
	}
	
	var regExp = /^(19|20)[0-9]{2}-[0-1]{0,1}[0-9]{1}-[0-3]{0,1}[0-9]{1}$/;
	if (! regExp.test(bathday)) {
		
		divDisplay(objNameInf, '生日输入不正确，请按格式 年-月-日 的格式输入');
		return;	
	}
	
	var dateAttr = bathday.split('-');
	var iDate = new Date(dateAttr[0], dateAttr[1], dateAttr[2]);
	var cDate = new Date();
	
	if (dateAttr[1] < 1 || dateAttr[1] > 12 ) {
		
		divDisplay(objNameInf, '输入的生日的月份有问题，请重新输入');
		return;		
	}
	
	if (dateAttr[2] < 1 || dateAttr[2] > 31 ) {
		
		divDisplay(objNameInf, '输入的生日的日份有问题，请重新输入');
		return;		
	}
	
	if (iDate.getTime() > cDate.getTime()) {
		
		divDisplay(objNameInf, '输入的生日大于当前时间，请重新输入');
		return;		
	}
	
	divDisplay(objNameInf, '');	
	$(objNameInf).className = 'inf_succeed';
}

var lastSign = '';
function checkSign() {
	
	var objName = 'sign';
	var objNameInf = getInfObjName(objName);
	var sign = v(objName);	
	
	if (sign == lastSign)
		return;		
	else
		lastSign = sign;	
		
	if (sign == '') {
		
		divDisplay(objNameInf, '');	
		$(objNameInf).className = 'inf_normal';	
		return;
	}
		
	if (getLen(sign) > 250) {
		
		divDisplay(objNameInf, '个性签名长度不正确，需小于 250 个字符长度');	
		return;	
	}	
	
	ajaxVerify('/register/verify-sign-' + escape(encodeURI(sign)) + '.html', objNameInf, '个性签名可以使用', '$("' +objName + '").value=result; $("' + objNameInf +'").className="inf_succeed";lastSign=result;');
	return 'AJAX';
}

function checkAll() {
	
	var regData = new Array("verifyCodeInf","userNameInf","nickNameInf","passwordInf","repeatPwdInf","emailInf");
	var regExtData = new Array("bathdayInf","msnInf","qqInf","signInf");
	
	var checkFun = {verifyCodeInf:'checkverifyCode',userNameInf:'checkusername',nickNameInf:'checkNickName',passwordInf:'checkpassword',repeatPwdInf:'checkpassword',emailInf:'checkmail'};
	var checkExtFun = {bathdayInf:'checkbathday',msnInf:'checkmsn',qqInf:'checkqq',signInf:'checkSign'};
	
	for (i=0; i<regData.length; i++) {
	
		eval(eval('checkFun.'+regData[i])+'();');
		
		if ($(regData[i]).className != 'inf_succeed') {
			
				return false;						
		}
	}
	
	if ($('advacedOption').checked) {
		
		for (i=0; i<regExtData.length; i++) {
		
			eval(eval('checkExtFun.'+regExtData[i])+'();');

			if ($(regExtData[i]).className != 'inf_succeed' && $(regExtData[i]).className != 'inf_normal') {			
				
				return false;
				
			}
		}	
	}
	
	return true;
}

function getPostString() {
	
	var regData = new Array("verifyCode","userName","nickName","password","email","emailPick","advacedOption","unionMember","olMember");
	var regExtData = new Array("gender","bathday","msn","qq","sign","friendSet");
	
	var ret = '';
	var value = '';
	
	for (i=0; i<regData.length; i++) {
			
		value =  ((regData[i] == 'emailPick' || regData[i] == 'advacedOption'||regData[i] == 'unionMember'||regData[i] == 'olMember')) ? $(regData[i]).checked : $(regData[i]).value;
		if (ret == '')
			ret = regData[i] +'='+value;
		else
			ret = ret + '&' + regData[i] + '=' + value;
	}
	
	if ($('advacedOption').checked) {
		
		for (i=0; i<regExtData.length; i++) {
			
			value = $(regExtData[i]).value;
			ret = ret + '&' + regExtData[i] + '=' + value;
		}	
	}
	
	ret = ret + '&doSubmit=true';
	return ret;
}

function submitRegister() {
	
	if (! checkAll()) {		
		messageBox('注册没有输入完整，请检查后再试');
		setTimeout('closeMessage();', 2000);
		return;	
	}	
	
	messageBox('系统正在提交注册信息中<br/>请稍候……');
	var postString = getPostString();
	
	var x = new Ajax("HTML", 'msgTxt');
	x.loading = '系统正在提交注册信息中<br/>请稍候……';
	x.post('/register/submit.html', postString, function(result) {
		
		result = trim(result);
		if (result == 'inf_succeed') {
			
			divDisplay('msgTxt', '新用户已经注册成功，系统将在三秒后自动进入下一步操作<br/><a href="/register/next.html">点击这儿转入下一步</a>');
			$('msgTxt').className = 'inf_normal';
			setTimeout("window.location.href='/register/next.html';" , 3000);	
		} 
		else if ( result.indexOf('webGameRegisterSucceed:')!=-1) {
			
			divDisplay('msgTxt', '新用户已经注册成功，系统将在三秒后自动进入游戏专区<br/><a href="'+result.slice(23)+'">点击这儿跳转</a>');
			$('msgTxt').className = 'inf_normal';
			setTimeout("window.location.href='"+result.slice(23)+"';" , 3000);
		
		}
		else {
			
			var msgLines = result.split("\n\r");
			
			for (i=0; i<msgLines.length; i++) {
				
				msgInfo = msgLines[i].split("=>");
				divDisplay(msgInfo[0] + 'Inf', msgInfo[1]);
			}
			
			divDisplay('msgTxt','用户注册过程中发生错误');
			changeverifycode();
			$('msgTxt').className = 'inf_normal';	
			setTimeout('closeMessage();', 2000);
		}
	});
}

//add by jiangqz
function enterSubmitForm(event){
	
	var event=window.event||event;	
	if(event.keyCode == 13 && document.getElementById("msgDiv")==null) {
		submitRegister();		
	}
}
