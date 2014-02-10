<?php
/**
 * 在线安装UEditor for Typecho
 * (写于18岁后的第一个春节)
 * 
 * @author Shengzhi Chen
 * @link http://chenshengzhi.com
 */


/** 项目地址 */
$_online_url = 'https://codeload.github.com/chanshengzhi/UEditor-for-Typecho/zip/master';

/** 下载到本地的文件名称 */
$_local_file = 'ueditor.zip';

// 如果接收到?delete参数 则删除自身
if( isset($_GET['delete']) && $_GET['delete'] == 999 ) {
	unlink('./README.md');
	unlink('./'. $_local_file);
	unlink($_SERVER['SCRIPT_FILENAME']);
	exit;
}


try {
	// 下载安装包
	$file_content = file_get_contents($_online_url);
	if( ! $file_content ) {
		throw new Exception('无法下载');
	}
	
	if( ! file_put_contents($_local_file, $file_content) ) {
		throw new Exception('无法保存为本地文件');
	}
	
	// 解压
	$zip = new ZipArchive();
	if( TRUE === $zip->open($_local_file) ) {
		$zip->extractTo('./');
		$zip->close();
	} else {
		throw new Exception('无法解压');
	}
	
	// 移除子文件夹
	$dir = "./UEditor-for-Typecho-master/";
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($currfile = readdir($dh)) !== false) {
				if ($currfile!="." && $currfile!="..") {
					if (!file_exists("./".$currfile)) {
						rename($dir.$currfile, "./".$currfile);
					}
				}
			}
			closedir($dh);
		}
		rmdir($dir);
	} else {
		throw new Exception('压缩包数据有误');
	}
	
	// 收尾工作
	header('Content-type:text/html;chatset="utf-8"');
	echo '<a href="?delete=999">删除安装文件</a>';
	
} catch (Exception $e) {
	echo $e->getMessage();
}
