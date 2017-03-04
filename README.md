UEditor-for-Typecho
===================

(1.4.3.2: 已从私隐项目转为开源项目)

适用于Typecho 1.0/0.9/0.8等版本, UEditor内核已升级到1.4.3.2版本.

支持**又拍云存储**(upyun), 支持UPYUN的缩略图版本.

支持图片上传到UPYUN后删除本地服务器的对应冗余图片,减少服务器磁盘用量.

即使你的Typecho安装在SAE上也能正常使用.

## 需要注意
1. 要求typecho安装在网站根目录下, 即usr目录是在网站根目录下. 安装在其他目录时可能无法正常使用, 需要对UEditor配置进行修改, 请恕我无暇顾及(有人fork后解决了这个问题,等我有空再拉过来)
2. 启用此插件后请关闭Typecho自带的文件上传功能
3. Typecho 1.0/0.9用户请在**控制台/个人设置**中关闭Markdown解析再启用插件

## 在线安装
使用ueditor.install.php在服务器上下载和安装

1. 访问[https://github.com/chanshengzhi/UEditor-for-Typecho/releases](https://github.com/chanshengzhi/UEditor-for-Typecho/releases)
2. 下载最新版本的安装脚本(ueditor.install.php)
3. 上传到ueditor.install.php到/usr/plugins文件夹下
4. 访问YourDomain.com/usr/plugins/ueditor.install.php进行安装
5. 安装成功后进入Typecho插件管理界面启用即可.

## 下载安装
服务器位于**中华人民共和国**/**朝鲜民主主义人民共和国**等国家时可能无法使用在线安装,无法使用在线安装时请手动下载进行安装.

访问[https://github.com/chanshengzhi/UEditor-for-Typecho/releases](https://github.com/chanshengzhi/UEditor-for-Typecho/releases),下载所需版本的压缩包,上传UEditor文件夹到/usr/plugins文件夹下, 进入Typecho插件管理界面启用即可

##联系作者
[陳盛智(chensz.com)](http://chensz.com)

QQ群: 558310881