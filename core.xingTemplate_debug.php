<?php


class xingTemplate_debug
{
	private $thiss = null;
	
	/* 绫诲疄渚嬪寲($this) */
	public function __construct($thiss)
	{
		$this->thiss = $thiss;
	}
	
	/* 妯℃澘閿欒杈撳嚭 */
	public function xingTemplate_xError($_xingTemplate_error)
	{
		/* 鑾峰彇鏈€鍚庝竴娆￠敊璇褰?*/
		$_xingTemplate_error_ = error_get_last();
    $_xingTemplate_error = array();
    
    /* 鍒ゆ柇鏄惁閲嶈閿欒淇℃伅 */
    switch ($_xingTemplate_error_['type'])
    {
    	case 1: $_xingTemplate_error['type'] = $this->thiss->xingTemplate_Class_Lang[3];
    	case 2: $_xingTemplate_error['type'] = $this->thiss->xingTemplate_Class_Lang[4];
    	case 4: $_xingTemplate_error['type'] = $this->thiss->xingTemplate_Class_Lang[5];
    	default:
    		$_xingTemplate_error['type'] = '1';
    }
    
    /* 閿欒淇℃伅鏍煎紡鍖?*/
    if ($_xingTemplate_error['type'])
    {
    	$_xingTemplate_error['body'] = file($_xingTemplate_error_['file']);
    	
    	$_xingTemplate_error['err_'] = "<meta http-equiv=Content-Type content=\"text/html;charset=utf-8\"><font size=2 color=#333333>\r\n";
    	$_xingTemplate_error['err_'] .= "[xingTemplate] <br /><br />\r\n";
    	$_xingTemplate_error['err_'] .= $this->thiss->xingTemplate_Class_Lang[6].': '.str_replace($this->thiss->xingTemplate_Cache_End,'',basename($_xingTemplate_error_['file']))."<br />\r\n";
    	$_xingTemplate_error['err_'] .= $this->thiss->xingTemplate_Class_Lang[7].': '.$_xingTemplate_error['type']."<br />\r\n";
    	$_xingTemplate_error['err_'] .= $this->thiss->xingTemplate_Class_Lang[8].': '.htmlspecialchars($_xingTemplate_error['body'][$_xingTemplate_error_['line']-1])."<br />\r\n";
    	$_xingTemplate_error['err_'] .= $this->thiss->xingTemplate_Class_Lang[9].': '.$_xingTemplate_error_['message']."<br /><br />\r\n";
    	$_xingTemplate_error['err_'] .= "</font><font size=2 color=#999999>\r\n";

    	$_xingTemplate_error['err_'] .= $this->thiss->xingTemplate_Class_Lang[10].': {SERVER_PATH}/'.$this->thiss->xingTemplate_Cache_Dir.'/'.basename($_xingTemplate_error_['file'])."<br />\r\n";
    	$_xingTemplate_error['err_'] .= $this->thiss->xingTemplate_Class_Lang[11].': '.$_xingTemplate_error_['line']." {$this->thiss->xingTemplate_Class_Lang[12]}<br />\r\n";
    	$_xingTemplate_error['err_'] .= "</font>\r\n";
    }

    return $_xingTemplate_error['err_'];
	}
}


?>