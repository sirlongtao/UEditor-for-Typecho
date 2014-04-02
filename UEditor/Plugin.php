<?php
/**
 * 为Typecho启用UEditor编辑器
 * 
 * @package UEditor
 * @author ChenShengzhi
 * @version 1.3.6.1
 * @link http://chenshengzhi.com
 * @date 2014-04-02 17:31:13
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
        
        Helper::addPanel(0, 'UEditor/ueditor/editor.config.js.php','', '', 'contributor');
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
        Helper::removePanel(0, 'UEditor/ueditor/editor.config.js.php');
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
    	/** 是否开始远程抓取 */
		$catcher = new Typecho_Widget_Helper_Form_Element_Radio('catcher', array('0' => _t('关闭'), '1' => _t('开启')), 1, 
				_t('是否开启远程抓取', _t('开启远程抓取后某些图片会抓取到服务器上')));
		$form->addInput($catcher);
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
        $js = Typecho_Common::url('UEditor/ueditor/ueditor.all.min.js', $options->pluginUrl);
        $configJs = Typecho_Common::url('extending.php?panel=UEditor/ueditor/editor.config.js.php', $options->adminUrl);
        
        echo '<style type="text/css">
	body{
        /** 保留此规则使dialogs的某些组件文字可见 */
		color:#000 !important;
    }
	.typecho-label + p{overflow:hidden;}
</style>';
        echo '<script type="text/javascript" src="'. $js. '"></script><script type="text/javascript" src="'. $configJs. '"></script>';
        echo '<script type="text/javascript">
        	var ue1 = new baidu.editor.ui.Editor();
        	window.onload = function() {
				// 渲染
        		ue1.render("text");
				
				// 更改高度以适应容器
				document.getElementsByClassName("edui-default").item(0).style.height = "";
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