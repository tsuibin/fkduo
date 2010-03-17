<?php
class xingTemplate
{
	// 寮曟搸閫夐」
	private $arrayConfig = array();
	
	/* 妯℃澘缂栬瘧淇℃伅鎻愮ず 榛樿涓枃 ( 濡傛灉鐗瑰畾璇█鍖呭瓨鍦?灏嗚嚜鍔ㄨ鍙?) */
	public $xingTemplate_Class_Lang = array(
																			' 妯℃澘鏂囦欢涓嶅瓨鍦ㄦ垨璇诲彇澶辫触',
																			' 妯℃澘鏂囦欢澶у皬瓒呭嚭闄愬埗',
																			' 妯℃澘鏂囦欢娌℃湁姝ｅ父鍔犺浇',
																			'涓ラ噸閿欒',
																			'绋嬪簭璀﹀憡',
																			'璇硶閿欒',
																			'鏂囦欢鍚嶇О',
																			'閿欒绛夌骇',
																			'閿欒鎵€鍦?,
																			'閿欒淇℃伅',
																			'缂撳瓨鏂囦欢璺緞',
																			'閿欒婧愪骇鐢熷湪',
																			'琛?
																		);
	
	// 绫诲疄渚嬪寲 (杩涜鏁扮粍璁剧疆)
	public function __construct($arrayConfig = array())
	{		
		/* 鑾峰彇褰撳墠绫绘墍鍦ㄧ洰褰? */  
		$this->arrayConfig['classDir'] = dirname(str_replace('\\','/',__FILE__));
		
		/* 杞藉叆閰嶇疆 */
		$this->arrayConfig += $arrayConfig;
		
		/* 鑾峰彇褰撳墠绫诲悕绉?(闃叉绫诲悕绉颁慨鏀?瀵艰嚧鎶ラ敊鏈哄埗澶辫触) */  
		$this->arrayConfig['ClassName'] = __CLASS__;
		
		/* 绫昏鍒濆鍖栨椂 鑷姩璇诲彇璇█鍖?(骞跺垽鏂瑷€鍖呮槸鍚︽湁鏁?  */
		global $_xingTemplate_Class_Lang;
		if (is_array($_xingTemplate_Class_Lang)) 
		{
			$this->xingTemplate_Class_Lang += $_xingTemplate_Class_Lang;
		}
		
		/* 杞藉叆鎵╁睍鍔熻兘鏂囦欢 */
		$Plugins = $this->get_Template_Plugins();
		if (is_array($Plugins))
		{
			foreach ($Plugins as $p_path){ include $p_path; }
		}
			
	}
	
	/* 璁剧疆寮曟搸 */
	public function setConfig($key, $value = null)
	{
		if (is_array($key))
		{
			$this->arrayConfig += $key;
		}else{
			$this->arrayConfig[$key] = $value;
		}
	}
	
	/* 鑾峰彇褰撳墠妯℃澘寮曟搸閰嶇疆 */
	public function getConfig($key = null)
	{
		if ($key)
		{
			return $this->arrayConfig[$key];
		}
		return $this->arrayConfig;
	}
	
	/* 鍚戞ā鏉垮紩鎿庝腑娉ㄥ叆鍙橀噺 */
	public function assign($key,$val = null)
	{
		if (empty($key)) return '';
		if (is_array($key))
		{
			foreach ($key as $k=>$v)
			{
				$this->arrayConfig['GLOBALS'][$k] = $v;
			}
		}else{
			$this->arrayConfig['GLOBALS'][$key] = $val;	
		}
	}
	
	/* 鍙栧緱鍙橀噺鍊?*/
	private function & get_Value($key)
	{
		if (isset($this->arrayConfig['GLOBALS'][$key]))
		{
			return $this->arrayConfig['GLOBALS'][$key];
		}else{
			global $$key;
				if ($$key)
				{
					$this->assign($key,$$key);
				}
				return $$key;
		}
	}
	
	/* 鍙栧緱妯℃澘璺緞 */
	private function get_Template_Path($templateName)
	{
		if (is_string($this->arrayConfig['templateDir'])) $this->arrayConfig['templateDir'] = array('default'=>$this->arrayConfig['templateDir']);
		
		$path = $this->arrayConfig['templateDir'][(empty($this->arrayConfig['template_Name']) ? 'default' : $this->arrayConfig['template_Name'])].'/'.$templateName.$this->arrayConfig['templateExt'];
		
		if (file_exists($path))
		{
			return $path;
		}else{
			return $this->arrayConfig['templateDir']['default'].'/'.$templateName.$this->arrayConfig['templateExt'];
		}
	}
	
	/* 鑾峰彇妯℃澘缂栬瘧璺緞 */
	private function get_Template_Compile_Path($templateName)
	{
		return $this->arrayConfig['classDir'].'/'.$this->arrayConfig['templateCompileDir'].'/'.md5($this->get_Template_Path($templateName)).$this->arrayConfig['templateCompileExt'];
	}
	
	/* 鑾峰彇妯℃澘缂撳瓨璺緞 */
	private function get_Template_Cache_Path($templateName, $all = false)
	{
		/* 澶氱骇缂撳瓨鐩綍 */
		$templateName = $this->arrayConfig['templateCacheODir'].'/'.($templateName ? md5($templateName) : '');
		
		if ($all)
		{
			if ($all === true)
			{
				$tmp_path = $templateName.'*';
			}else{
				$tmp_path = $templateName.$all;
			}
		}else{
			$tmp_path = $templateName.$this->arrayConfig['cacheId'];
		}
		return $this->arrayConfig['classDir'].'/'.$this->arrayConfig['templateCacheDir'].'/'.$tmp_path.$this->arrayConfig['templateCacheExt'];
	}
	
	/* 鑾峰彇鎵╁睍鍔熻兘鏂囦欢鍒楄〃 */
	private function get_Template_Plugins()
	{
		if (is_dir($this->arrayConfig['classDir'].'/'.$this->arrayConfig['templatePluginsDir'].'/'))
		{
			return glob($this->arrayConfig['classDir'].'/'.$this->arrayConfig['templatePluginsDir'].'/*.php');
		}
	}
	
	/* 鍒ゆ柇缂撳瓨杈撳嚭鏄惁鏈夋晥/鏄惁寮€鍚紦瀛樿緭鍑? */
	public function is_cached($templateName)
	{
		$_PATH = $this->get_Template_Cache_Path($templateName);
		if (!file_exists($_PATH))
		{
			return false;
		}elseif (filemtime($_PATH) + $this->arrayConfig['cache_time'] < time()){
			return false;
		}else{
			return true;
		}
	}
	
	/* 璇诲彇鏂囦欢 */
	private function template_Read($PATH)
	{
		if (function_exists('file_get_contents'))
		{
			return file_get_contents($PATH);
		}else{
			$fopen = fopen($PATH,'r');
			$template_Content = '';
			do {
				$data = fread($fopen,1024);
				if (strlen($data)===0) break;
				$template_Content .= $data;
			}while(1);
			fclose($fopen);
			
			return $template_Content;
		}
	}
	
	/* 鍐欏叆鏂囦欢 */
	private function template_Write($PATH,$String)
	{
		/* 璋冪敤閫掑綊鍒涘缓鐩綍  */
		$this->template_CreateDir(dirname($PATH));

			/* 浠ュ啓鍏ユ柟寮忔墦寮€鏂囦欢鍙ユ焺,寮€鍚?flock  */
			$fopen = fopen($PATH,'w');
				flock($fopen, LOCK_EX + LOCK_NB);
				$fwrite = fwrite($fopen,$String);
					/* 澶辫触閲嶆柊灏濊瘯鍐欏叆  */
					if (!$fwrite) $fwrite = fwrite($fopen,$String);
				flock($fopen, LOCK_UN + LOCK_NB);
			fclose($fopen);

		return $fwrite;
	}
	
	/* 寰幆鍒涘缓鐩綍 */
	private function template_CreateDir($Dir)
	{
		if (is_dir($Dir))
		 return true;
		
		if (@ mkdir($Dir, $this->arrayConfig['dir_mode']))
			return true;

		if (!$this->template_CreateDir(dirname($Dir)))
		 return false;
		
		return mkdir($Dir, $this->arrayConfig['dir_mode']);
	}
	
	/* 寰幆鍒犻櫎鐩綍 */
	private function xingTemplate_rmDir($dir,$to = false)
	{
		if ($list = glob($dir.'/*'))
		{
			foreach ($list as $file)
			{
				is_dir($file) ? $this->xingTemplate_rmDir($file) : unlink($file);
			}
		}
		
		if ($to === false) rmdir($dir);
	}

	public function getMicrotime()
	{
		list($microtime_1,$microtime_2) = explode(' ',microtime());
		return $microtime_1 + $microtime_2;
	}

	/* 杈撳嚭妯℃澘 */
	public function display($templateName, $key = '',$Clean = 0)
	{
		$this->xingTemplate_Display($templateName,$Clean,'display',$key);
	}
	
	/* 杩斿洖杈撳嚭妯℃澘 */
	public function fetch($templateName, $key = '')
	{
		return $this->xingTemplate_Display($templateName,$Clean,'output',$key);
	}
	
	/* 杈撳嚭妯℃澘 */
	private function xingTemplate_Display($templateName,$Clean = 0,$display = '',$key = '')
	{
		
		/* 瀹氫箟閿欒淇℃伅 */
		if (!$this->arrayConfig['error_reporting'])
		{
			$xingTemplate_old_err = error_reporting();
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
		}
		
		/* 璁惧畾妯℃澘 */
		if ($key)
		{
			$tmp_key = $this->arrayConfig['template_Name'];
			$this->arrayConfig['template_Name'] = $key;
		}
		
		/* 寮曟搸杩愯鏃堕棿缁熻  */
		$this->arrayConfig['Runtime'] = $this->getMicrotime();
		
		if ($this->arrayConfig['cache_is'])
			$_PATH = $this->get_Template_Cache_Path($templateName);
		
		if (!$this->is_cached($templateName) || $Clean)
		{	
			/* 灏嗛敊璇浇鍏ョ壒瀹氬嚱鏁板鐞? */
			if ($this->arrayConfig['compatible'])
			{
				ob_start();
			}else{

				// 杞藉叆Debug绫?
				$class_debug = new xingTemplate_debug($this);
				
				ob_start(array($class_debug,'xingTemplate_xError'));
			}
					/* 杩涜妯℃澘缂栬瘧   */
					include $this->xingTemplate_compile($templateName,$Clean);
					
					$xingTemplate_Content = ob_get_contents();
				ob_end_clean();

		}else{
			/* 璇诲彇缂撳瓨杈撳嚭鏂囦欢 */
			$xingTemplate_Content = $this->template_Read($_PATH);
		}

			 /* 鍒ゆ柇鏄惁鍙互鍐欏叆缂撳瓨杈撳嚭鍐呭  */
			if ($this->arrayConfig['cache_is'])
			{
				/* 鍒ゆ柇缂撳瓨杈撳嚭鏄惁鏈夋晥 */
				if (!$this->is_cached($templateName))
					$this->template_write($_PATH,$xingTemplate_Content);
			}
		
			if ($this->arrayConfig['debug'])
			{
				unset($this->arrayConfig['GLOBALS'][$this->arrayConfig['ClassName']]);
				ob_start(); print_r($this->arrayConfig); $debug = ob_get_contents(); ob_end_clean();
				$xingTemplate_Content .= '<div id="Me" style="display:none;">'.highlight_string($debug,1).'</div>'.'<script type="text/javascript">var code=document.getElementById("Me").innerHTML;var newwin=window.open("","","height=600 ,width=500,scrollbars=yes");  newwin.opener = null ;newwin.document.write(code); newwin.document.close();</script>';		
			}
			
			switch ($display)
			{
				case 'display':
						echo $xingTemplate_Content;
						
						$xingTemplate_Content = null;
				break;
			}
			
			/* 杩斿洖鎵ц鏃堕棿 */
		$this->template_Runtime();
		
		if (isset($tmp_key)) $this->arrayConfig['template_Name'] = $tmp_key;

		if ($this->arrayConfig['gzip_off'] && ereg('gzip',$_SERVER['HTTP_ACCEPT_ENCODING']))
		{
			ob_start('ob_gzhandler');
		}
		
		/* 瀹氫箟閿欒淇℃伅 */
		if (!$this->arrayConfig['error_reporting'])
			error_reporting($xingTemplate_old_err);
		
		return $xingTemplate_Content;
	}
	
	/*******************************************************************/
	/* 缂栬瘧寮€濮?
	/*******************************************************************/
	
	
		/* 杞崲鏍囩ず绗?*/
	private function ConverTag($Tag)
	{
		$_count = strlen($Tag);
		$new_array = array('{','}','[',']','$','(',')','*','+','.','?','\\','^','|');
		$Tag_ = '';
		for ($i=0;$i<$_count;$i++)
		{
			$Tag_ .= (in_array($Tag[$i],$new_array)?'\\':'').$Tag[$i];
		}
		return $Tag_;
	}

	/* 妯℃澘寮曟搸缂栬瘧 */
	private function xingTemplate_compile($templateName,$Clean = 0)
	{
		$_PATH = array();

		/* 鍙栧緱鏈夋晥妯℃澘璺緞  */
		$_PATH['From'] =  $this->get_Template_Path($templateName);
		$_PATH['Save'] =  $this->get_Template_Compile_Path($templateName);
		
		/* 鍒ゆ柇妯℃澘鏂囦欢鏄惁瀛樺湪 */
		if (!file_exists($_PATH['From'])) return $_PATH['From'].' {'.$templateName.$this->xingTemplate_Class_Lang[0].'}';

		/* 鍒ゆ柇妯℃澘缂撳瓨鏂囦欢鏄惁闇€瑕佹洿鏂? */
		if ($this->arrayConfig['force_compile']) $Clean = 1;
		
		if (!$Clean)
		{
			if (file_exists($_PATH['From']))
				$_fromt = filemtime($_PATH['From']);
			if (file_exists($_PATH['Save']))
				$_savet = filemtime($_PATH['Save']);

			if ($_fromt <= $_savet)
			{
				return $_PATH['Save'];
			}
		}
		
		/* 鍒ゆ柇妯℃澘鏂囦欢澶у皬闄愬埗 */
		if (filesize($_PATH['From']) > $this->arrayConfig['file_max'] * 1024 * 1024) return $this->xingTemplate_Error($templateName.$this->xingTemplate_Class_Lang[1].' ('.$this->arrayConfig['file_max'].' M)');
		
		/* 鍙栧緱鏈夋晥鏍囩ず  */
		$_Left = '(?<!!)'.$this->ConverTag($this->arrayConfig['left_tag']);
		$_Right = '((?<![!]))'.$this->ConverTag($this->arrayConfig['right_tag']);
		
		/* 鍙栧緱妯℃澘婧?*/
		$xingTemplate_Conver = $this->template_read($_PATH['From']);

		/* 濡傛灉妯℃澘涓虹┖,涓嶈繘琛岀紪璇?*/
		if (empty($xingTemplate_Conver))
		{
			$this->template_Write($_PATH['Save'],$xingTemplate_Conver);
			return $_PATH['Save'];
		}
		
		/* **************妯℃澘杩涜鐩稿叧缂栬瘧璧峰******************* */
			/*
				Start// write by xbantu 2009-06-06
			*/
		$xingTemplate_Conver = trim($xingTemplate_Conver);
		
		preg_match_all('/'.$_Left.'xingTemplate (([\w|-|\/]{1,})|(\$([_a-zA-Z][\w]*)))'.$_Right.'/',$xingTemplate_Conver,$Include_);
		$Include_count = count($Include_[0]);
		
			/* 妯℃澘鏂囦欢宓屽璋冪敤澶勭悊  */
		for ($i=0;$i< $Include_count;$i++)
		{
			/* 缂栬瘧鐩稿簲璋冨叆妯℃澘鏂囦欢 */
			$xingTemplate_Conver = str_replace($Include_[0][$i],$this->arrayConfig['left_tag'].'eval include $this->xingTemplate_compile("'.$Include_[1][$i].'")'.$this->arrayConfig['right_tag'],$xingTemplate_Conver);
			
			/* 2009-06-07 鏀惧純浣跨敤妯℃澘鐘舵€佹彁绀?*/
			/*
				// 鎻愮ず妯℃澘鏂囦欢鍔犺浇鐘舵€? 
				$Include_Tmp_Name = $this->get_xingTemplate_path($Include_[1][$i]);	
				$xingTemplate_Conver = str_replace($Include_[0][$i],$this->xingTemplate_Left.' '.$Include_[1][$i].$this->xingTemplate_Class_Lang[2].$this->xingTemplate_Right,$xingTemplate_Conver);				
			*/
		}
		unset($Include_);
			
		 /* 鑾峰彇妯℃澘鎵€浣跨敤鍙橀噺 */
		preg_match_all('/\$([_a-zA-Z][\w]*)/',$xingTemplate_Conver,$Global_var);

		if (is_array($Global_var[1]))
		{	
			$Global_var[1] = array_unique($Global_var[1]);

			$Global_var_Im = array('this','_GET','_POST','_COOKIE','_SERVER','_SESSION','_FILES','_ENV');
			$Global_var_out = '';

			foreach ($Global_var[1] as $val)
			{
				if (!in_array($val,$Global_var_Im))
				{
					$Global_var_out .= '$'.$val.' =& $this->get_Value(\''.$val.'\'); ';

				}
			}
		}

		 /* 鐩稿叧鏍囩杞崲 */
		$Template_preg = array();
		$Template_Replace = array();

		 /* 鍒ゆ柇鏄惁鍏佽鎻掑叆PHP  */
		if ($this->arrayConfig['PHP_off'] === false)
		{
			$xingTemplate_Preg[] = '/<\?(=|php|)(.+?)\?>/is';
			
			$xingTemplate_Replace[] = '&lt;?\\1\\2?&gt;';
		}

			/*
			姝ょ被缂栬瘧鐨勮娉?
			_if 
			_elseif
			_else
			_for
			_while
			_foreach
			_eval
			_echo
			_print_r
			_鍙橀噺杈撳嚭
			*/ 
			
		$xingTemplate_Preg[] = '/'.$_Left.'(else if|elseif) (.*?)'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left.'for (.*?)'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left.'while (.*?)'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left.'(loop|foreach) (.*?)'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left.'if (.*?)'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left.'else'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left."(eval|_)( |[\r\n])(.*?)".$_Right.'/is';
		$xingTemplate_Preg[] = '/'.$_Left.'_e (.*?)'.$_Right.'/is';
		$xingTemplate_Preg[] = '/'.$_Left.'_p (.*?)'.$_Right.'/i';
		$xingTemplate_Preg[] = '/'.$_Left.'\/(if|for|loop|foreach|eval|while)'.$_Right.'/i'; 
		$xingTemplate_Preg[] = '/'.$_Left.'((( *(\+\+|--) *)*?(([_a-zA-Z][\w]*\(.*?\))|\$((\w+)((\[|\()(\'|")?\$*\w*(\'|")?(\)|\]))*((->)?\$?(\w*)(\((\'|")?(.*?)(\'|")?\)|))){0,})( *\.?[^ \.]*? *)*?){1,})'.$_Right.'/i'; 
		$xingTemplate_Preg[] = "/(	| ){0,}(\r\n){1,}\";/"; 
		$xingTemplate_Preg[] = '/'.$_Left.'(\#|\*)(.*?)(\#|\*)'.$_Right.'/'; 
		$xingTemplate_Preg[] = '/'.$_Left.'\%([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)'.$_Right.'/';


			/* 缂栬瘧涓虹浉搴旂殑PHP鏂囦欢璇硶 _鎵€浜х敓閿欒鍦ㄨ繍琛屾椂鎻愮ず  */
		$xingTemplate_Replace[] = '<?php }else if (\\2){ ?>';
		$xingTemplate_Replace[] = '<?php for (\\1) { ?>';
		$xingTemplate_Replace[] = '<?php while (\\1) { ?>';
		$xingTemplate_Replace[] = '<?php foreach ((array)\\2) { $__i++; ?>';
		$xingTemplate_Replace[] = '<?php if (\\1){ ?>';
		$xingTemplate_Replace[] = '<?php }else{ ?>';
		$xingTemplate_Replace[] = '<?php \\3; ?>';
		$xingTemplate_Replace[] = '<?php echo \\1; ?>';
		$xingTemplate_Replace[] = '<?php print_r(\\1); ?>';
		$xingTemplate_Replace[] = '<?php } ?>';
		$xingTemplate_Replace[] = '<?php echo \\1;?>';
		$xingTemplate_Replace[] = '';
		$xingTemplate_Replace[] = '';
		$xingTemplate_Replace[] = '<?php echo $this->lang_array[\'\\1\'];?>';

		
		  /* 鍦ㄦ湁蹇呰鏃?寮€鍚?*/  
		//ksort($xingTemplate_Preg);
		//ksort($xingTemplate_Replace);
				
			/* 鎵ц姝ｅ垯鍒嗘瀽缂栬瘧 */
		$xingTemplate_Conver=preg_replace($xingTemplate_Preg,$xingTemplate_Replace,$xingTemplate_Conver);
		
			/* 杩囨护鏁忔劅瀛楃 */ 
		$xingTemplate_Conver = str_replace(array('!'.$this->arrayConfig['right_tag'],'!'.$this->arrayConfig['left_tag'],'?><?php'),array($this->arrayConfig['right_tag'],$this->arrayConfig['left_tag'],''),$xingTemplate_Conver);

			/* 鏁寸悊杈撳嚭缂撳瓨鍐呭  */
		if ($Global_var_out)
		{
			$xingTemplate_Conver = "<?php $Global_var_out ?>\r\n".$xingTemplate_Conver;
		}
		
		$this->template_write($_PATH['Save'],$xingTemplate_Conver);
		
		/*
			End conver;
		*/
		/* ***************妯℃澘杩涜鐩稿叧缂栬瘧缁撴潫******************** */
		
		return $_PATH['Save'];

	}


	/* 绫婚敊璇俊鎭緭鍑?*/
	private function xingTemplate_Error($Msg)
	{
		echo $Msg;
		
		/*exit;*/
	}
	

	
	/* 娓呯悊缂撳瓨杈撳嚭 鎴栫紦瀛?*/
	public function xingTemplate_clean($type = 'cache')
	{
		
		switch ($type)
		{
			/* 鍒ゆ柇鏄惁鏄緭鍑虹紦瀛?*/
			case 'cache':
			/* 2009.8.22 棰勪涪寮?
				echo $_PATH = dirname($this->get_Template_Cache_Path('_'));
				$_END = $this->arrayConfig['templateCacheExt'];
			
				$_PATH_ = glob($_PATH.'/*'.$_END);
			*/
				$this->xingTemplate_rmDir($this->arrayConfig['classDir'].'/'.$this->arrayConfig['templateCacheDir'], true);
				return true;
			break;
			
			/* 鍒ゆ柇鏄惁鏄ā鏉跨紦瀛?*/
			case 'compile':
			/* 2009.8.22 棰勪涪寮?
				$_PATH = dirname($this->get_Template_Compile_Path('_'));
				$_END = $this->arrayConfig['templateCompileExt'];
			
				$_PATH_ = glob($_PATH.'/*'.$_END);
			*/
				$this->xingTemplate_rmDir($this->arrayConfig['classDir'].'/'.$this->arrayConfig['templateCompileDir'], true);
				return true;
			break;
		}
		
		 /* 鍒ゆ柇鏄惁鏄緭鍑虹紦瀛?*/
		if (!empty($type) && empty($_PATH))
		{
			$_PATH = $this->get_Template_Cache_Path($type, true);
			
			$_PATH_ = glob($_PATH);
		}
		
		if (is_array($_PATH_))
		{
			$j = 0;
			foreach ($_PATH_ as $val)
			{
				if (file_exists($val))
				{
					unlink($val);
					$j ++;
				}
			}
				
			return $j;
		}else{
			return false;
		}
		
		return false;
	}
	
	/* 鑾峰彇瀹炴椂妯℃澘寮曟搸杩愯鏃堕棿 */
	public function template_Runtime()
	{
		/* 杩斿洖鎵ц鏃堕棿 */
		return round($this->getMicrotime() - $this->arrayConfig['Runtime'],5);
	}

  /* 閲婃斁璧勬簮 */ 
	public function __destruct()
	{
		$this->arrayConfig = null;
	}
	
	//绫荤粨鏉?

}




?>