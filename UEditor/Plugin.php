<?php
/**
 * 为Typecho启用UEditor编辑器
 * 
 * @package UEditor
 * @author 陈盛智
 * @version 1.4.3
 * @link http://chenshengzhi.com
 * @date 2014-9-12 8:59:54
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
    public static function config(Typecho_Widget_Helper_Form $form){}
    
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
        $js = Typecho_Common::url('UEditor/ueditor/ueditor.all.js', $options->pluginUrl);

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