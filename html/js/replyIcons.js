var ToolBar={
		_imgRoot:"html/ico/",
		_expPrefix:"ico",
		
		_btnImgs:[
					['bb_bold.gif'		,	'javascript:bold()'			,'插入粗体文本'],
					['bb_italicize.gif'	,	'javascript:italicize()'	,'插入斜体文本'],
					['bb_underline.gif'	,	'javascript:underline()'	,'插入下划线'],
					['bb_center.gif'		,	'javascript:center()'		,'居中对齐'],
					['bb_url.gif'			,	'javascript:hyperlink()'	,'插入超级链'],
					['bb_email.gif'		,	'javascript:email()'		,'接插入邮件'],
					['bb_image.gif'		,	'javascript:image()'		,'地址插入图像'],
					['bb_code.gif'		,	'javascript:code()'			,'插入代码'],
					['bb_quote.gif'		,	'javascript:quote()'		,'插入引用'],
					['bb_quote.gif'		,	'javascript:flash()'		,'插入Flash'],
					['bb_list.gif'		,	'javascript:list()'			,'插入列表']
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
				document.write("<br><input name=\"closecode\" type=\"CHECKBOX\" value=\"1\" class=\"pt9\">关闭所有标签");
			}
			
		}



