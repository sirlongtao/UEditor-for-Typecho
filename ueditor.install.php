<?php
/**
 * 在线安装UEditor for Typecho
 * (写于18岁后的第一个春节)
 * 
 * @author Shengzhi Chen
 * @link http://chenshengzhi.com
 */

// 如果接收到?delete参数 则删除自身
if( isset($_GET['delete']) ) {
	unlink('README.md');
	unlink(__FILE__);
}


/** 项目地址 */
$zip_pack = 'https://github.com/chanshengzhi/UEditor-for-Typecho/archive/master.zip';

/** 下载到本地的文件名称 */
$file_name = 'ueditor-for-typecho.zip';


try {
	if( ! class_exists('ZipArchive') ) {
		throw new Exception('未启用ZipArchive');
	}
	
	if( ! $file_content = file_get_contents($zip_pack) ) {
		throw new Exception('无法下载zip安装包');
	}
	
	if( ! file_put_contents($file_name, $file_content) ) {
		throw new Exception('无法保存下载的安装包');
	}
	
	$zip = new ZipArchive();
	if( $zip->open($file_name) === TRUE ) {
		$zip->extractTo('.');
		$zip->close();
	} else {
		throw new Exception('无法打开zip压缩包');
	}
	
	// 收尾工作
	header('Content-type:text/html;charset="utf-8"');
	echo '<a href="/usr/ueditor.install.php?delete">删除安装文件</a>';
	
} catch(Exception $e) {
	echo $e->getMessage();
}
