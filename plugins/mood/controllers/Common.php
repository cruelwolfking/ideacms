<?php

/**
 * PluginCommon.php for v1.5 +
 * 应用控制器公共类 
 */

class Plugin extends Common {
    
    protected $plugin;   //应用模型
	protected $data;     //应用数据
	protected $viewpath; //视图目录
    
    public function __construct() {
        parent::__construct();
		$this->plugin  = $this->model("plugin");
        $this->data    = $this->plugin->where("dir=?", $this->namespace)->select(false);
		if (empty($this->data)) $this->adminMsg('应用尚未安装', url('admin/plugin'));
		if ($this->data['disable']) $this->adminMsg('应用尚未开启', url('admin/plugin'));
		$this->viewpath= SITE_PATH . $this->site['PLUGIN_DIR'] . '/' . $this->data['dir'] . '/views/';
		$this->assign(array(
		    'viewpath' =>  $this->viewpath,  
		));
    }
    
}
