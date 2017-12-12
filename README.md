UEditor-for-Typecho
===================

2017-12-12 update

适用于Typecho 1.0/0.9/0.8等版本, UEditor内核已升级到1.4.3.2版本.

- 支持**又拍云存储**(upyun), 支持UPYUN的缩略图版本
- 支持**腾讯云对象存储**(COS)
- 支持图片上传到云服务器后删除本地服务器的对应冗余图片从而减少服务器磁盘用量
- 即使Typecho安装在**Sina APP Engine(SAE)**上也能正常使用


## 需要注意
1. 要求typecho安装在网站根目录下, 即usr目录是在网站根目录下. 安装在其他目录时可能无法正常使用, 需要对UEditor配置进行修改, 请恕我无暇顾及(有人fork后解决了这个问题,等我有空再拉过来)
2. 启用此插件后请关闭Typecho自带的文件上传功能
3. Typecho 1.0/0.9用户请在**控制台/个人设置**中关闭Markdown解析再启用插件

## 安装方式1: 在线安装
使用ueditor.install.php在服务器上下载和安装

1. 访问[https://github.com/chanshengzhi/UEditor-for-Typecho/releases](https://github.com/chanshengzhi/UEditor-for-Typecho/releases)
2. 下载最新版本的安装脚本(ueditor.install.php)
3. 上传到ueditor.install.php到/usr/plugins文件夹下
4. 访问YourDomain.com/usr/plugins/ueditor.install.php进行安装
5. 安装成功后进入Typecho插件管理界面启用即可.

## 安装方式2: 下载安装
服务器位于某些特定的区域时可能无法使用在线安装,无法使用在线安装时请下载插件压缩包上传到服务器进行安装.

访问[https://github.com/chanshengzhi/UEditor-for-Typecho/releases](https://github.com/chanshengzhi/UEditor-for-Typecho/releases),下载所需版本的压缩包,解压后上传其中的**UEditor**文件夹到/usr/plugins文件夹下, 进入Typecho插件管理界面启用即可

##联系作者
[陳盛智(chensz.com)](http://chensz.com)

QQ群: 558310881