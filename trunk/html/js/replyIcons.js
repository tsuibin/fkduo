var ToolBar={
		_imgRoot:"html/ico/",
		_expPrefix:"ico",
		
		_btnImgs:[
					['bb_bold.gif'		,	'javascript:bold()'			,'��������ı�'],
					['bb_italicize.gif'	,	'javascript:italicize()'	,'����б���ı�'],
					['bb_underline.gif'	,	'javascript:underline()'	,'�����»���'],
					['bb_center.gif'		,	'javascript:center()'		,'���ж���'],
					['bb_url.gif'			,	'javascript:hyperlink()'	,'���볬����'],
					['bb_email.gif'		,	'javascript:email()'		,'�Ӳ����ʼ�'],
					['bb_image.gif'		,	'javascript:image()'		,'��ַ����ͼ��'],
					['bb_code.gif'		,	'javascript:code()'			,'�������'],
					['bb_quote.gif'		,	'javascript:quote()'		,'��������'],
					['bb_quote.gif'		,	'javascript:flash()'		,'����Flash'],
					['bb_list.gif'		,	'javascript:list()'			,'�����б�']
				]
		,
		outputExp:function()
			{
				for(var i=1;i<=52;i++)
				{
					
					document.write('<img onclick="inputs(\'{'+i+'}\')" src="'+this._imgRoot+this._expPrefix+i+'.gif">&nbsp;');
					if(i%13==0)
					{
						document.write("<br/>");
					}
				}		
			},
		  outputBtns:function()
			{
				
				for(var key in this._btnImgs)
				{
					
					document.write("<a href=\""+this._btnImgs[key][1]+"\"><img alt=\""+this._btnImgs[key][2]+"\" src=\""+this._imgRoot+"bbico/"+this._btnImgs[key][0]+"\" border=\"0\"></a> ");
				}
				document.write("<br><input name=\"closecode\" type=\"CHECKBOX\" value=\"1\" class=\"pt9\">�ر����б�ǩ");
			}
			
		}



