<?php
/**
 * 为Typecho启用UEditor编辑器(UPYUN版本)
 *
 * @package UEditor
 * @author 陈盛智
 * @version 1.4.3.2
 * @link http://chenshengzhi.com
 * Date: 2016-04-19
 * Time: 00:08:36
 */
class UEditor_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('admin/write-post.php')->richEditor = array('UEditor_Plugin', 'render');
        Typecho_Plugin::factory('admin/write-page.php')->richEditor = array('UEditor_Plugin', 'render');
        
        Helper::addPanel(0, 'UEditor/ueditor/ueditor.config.js.php','', '', 'contributor');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
        Helper::removePanel(0, 'UEditor/ueditor/ueditor.config.js.php');
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
        /** 使用UPYUN */
        $c1 = new Typecho_Widget_Helper_Form_Element_Radio('upyun', array('0' => '不使用', '1' => '使用'), '1',
            '是否使用UPYUN', '开启后会把图片和文件上传到UPYUN服务器上');
        $form->addInput($c1);

        $c1 = new Typecho_Widget_Helper_Form_Element_Text('upyun_url', NULL, NULL, '空间地址', '大概是这样的:http://bucket.b0.upaiyun.com');
        $form->addInput($c1);
        
        $c1 = new Typecho_Widget_Helper_Form_Element_Text('upyun_bucket', NULL, NULL, '空间名称', '例如bucket');
        $form->addInput($c1);

        $c1 = new Typecho_Widget_Helper_Form_Element_Text('upyun_user', NULL, NULL, '操作员', '操作员名称');
        $form->addInput($c1);

        $c1 = new Typecho_Widget_Helper_Form_Element_Password('upyun_password', NULL, NULL, '操作员密码', '小心站你后面的物体');
        $form->addInput($c1);

        $c1 = new Typecho_Widget_Helper_Form_Element_Text('upyun_suffix', NULL, NULL, '缩略图版本', '在图片地址后添加的内容,例如 !default');
        $form->addInput($c1);

        $c1 = new Typecho_Widget_Helper_Form_Element_Checkbox('upyun_only', array('upyun_only' => '图片上传到UPYUN后删除本服务器上对应的图片文件'), array(), '图片仅上传到UPYUN', '如果勾选，则把图片文件上传到UPYUN并删除本地服务器上对应的图片文件');
        $form->addInput($c1);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render($post)
    {
        $options = Helper::options();
        $configJs = Typecho_Common::url('extending.php?panel=UEditor/ueditor/ueditor.config.js.php', $options->adminUrl);
        $js = Typecho_Common::url('UEditor/ueditor/ueditor.all.min.js', $options->pluginUrl);

        echo '<script type="text/javascript" src="'. $configJs. '"></script><script type="text/javascript" src="'. $js. '"></script>';
        echo '<script type="text/javascript">
            var ue1;
        	window.onload = function() {
				// 渲染
                ue1 = UE.getEditor("text");
        	}
    
    // 保存草稿时同步
	document.getElementById("btn-save").onclick = function() {
        ue1.sync("text");
    }

    // 提交时同步
	document.getElementById("btn-submit").onclick = function() {
		ue1.sync("text");
	}
	</script>';
    }
}
