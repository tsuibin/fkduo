<?php


/* ����xingTemplate��  */
include 'core.xingTemplate_class.php';
	
/* ����xingTemplate ������ */
include 'core.xingTemplate_debug.php';

/* ����ģ����������(����) */

$xingTemplate_set = array(
													
													/* ģ���﷨ǰ���ʾ�� */
													'left_tag' => '{',
													'right_tag' => '}',
													
													/* ģ��·������defaultΪĬ��ģ�� (��ϸʹ�÷�������鿴�ٷ��ֲ�) */
													'templateDir' => array(
																									'default' => 'template',
																									'default2' => 'template2'
																									),
																									
													/* Ĭ��ʹ��ģ��,����ģ��·������Ӧ  */
													'template_Name' => 'default',
													
													/* ģ���ļ���׺�� */
													'templateExt' => '.html',
													
													/* �Ƿ��������ģ�� (���ڵ���ʱ��) */
													'force_compile' => false,
													
													/* �Ƿ���ֱ�Ӳ���PHP���� */
													'PHP_off' => false,
													
													/* ����ģ�����Ŀ¼,��β��Ҫ��б�� '/' */
													'templateCompileDir' => 'html/Compile',
													
													/* ģ������ļ��ĺ�׺�� */
													'templateCompileExt' => '.phpc',
													
													/* �Ƿ�ʹ��������� */
													'cache_is' => false,
													
													/* ��������ʾ�� Ĭ��Ϊ ��ǰURL ��MD5ֵ */
													/*
													 * �˹���,�����ڵ����������ʱ,��Ҫָ����,�Է�ֹģ�建���ظ�,��Ӱ�����ĳ������
													 * ����ʹ��ʱ,���ж���
													 *
													*/
													'cacheId' => md5($_SERVER['REQUEST_URI']),
													
													/* �������ʱ�� ��λ�� */
													'cache_time' => 500,
													
													/* �������Ŀ¼,��β��Ҫ��б�� '/' */
													'templateCacheDir' => 'html/xingTemplate_Cache',
													
													/* ������Ŀ¼,��Ի���Ŀ¼�����·�� (�༶��Ŀ¼��Ż���),��β��Ҫ��б�� '/' ,����: dir1/dir2 */
													/* ������Ļ��������򼶱𣬿���ʹ�ã���ÿ��ģ��ʹ�� setConfig ����ǰ���ã�ģ�建��ͻ����Ŀ¼�����š�*/
													'templateCacheODir' => '',
													
													/* ��������ļ���׺�� */
													'templateCacheExt' => '.phpo',
													
													/* ��չ����(Function)������·��,��β��Ҫ��б�� '/' */
													'templatePluginsDir' => 'xingTemplate_Plugins',
													
													/* �ɱ�������������Ŀ¼Ȩ�� ���� */
													'dir_mode' => 0777,
													
													/* ������ģ���ļ��Ĵ�С���� ��λ M */
													'file_max' => 1,
													
													/* ����Gzip����,��ߴ����ٶ� (�˹���ֻ��ʹ��display������) */
													'gzip_off' => false,
													
													/* ����ѡ����ģ����������հף��뿪������ */
													'compatible' => false,
													
													/* ��Ϊ����ʱ���������Զ�����һ�����ڣ�������Ϊ xingTemplate ģ����������������ļ�������ע�����Դ (�������) */
													'debug' => false,
													
													/* �Ƿ�����Ѷ���� error_reporting */
													'error_reporting' => false

													/* Ĭ�ϵ���ʾ����Ϊ����, �����Ա�д�򵥵����԰�,Ϊ�˳���������ʾ���ԵĿɶ��� */
													
													);


	/* ��ʵ�������������� $xingTemplate_set / �����ʹ�� $xingTemplate->setConfig($xingTemplate_set) */
	$xingTemplate = new xingTemplate($xingTemplate_set);

?>