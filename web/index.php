<?php
	//开启调试模式
    define('APP_DEBUG', true);
    //入口文件目录绝对路径
    define('SITE_ROOT', str_replace('\\', '/', __DIR__));
    //数据缓存目录绝对目录
    defined('DATA_PATH') or define('DATA_PATH', SITE_ROOT . '/data');
    //包含自动加载类
    $loader = require '../vendor/autoload.php';
    //smarty实例化
    $smarty = new \Smarty;
    //$smarty->left_delimiter = "{#";
    //$smarty->right_delimiter = "#}";
    $smarty->setTemplateDir(SITE_ROOT . '/tpl/'); //设置模板目录
    $smarty->setCompileDir(SITE_ROOT . '/data/cache/templates_c/');
    $smarty->setConfigDir(SITE_ROOT . '/config/');
    $smarty->setCacheDir(SITE_ROOT . '/data/cache/smarty_cache/');
    //$smarty->force_compile = true;
    if (APP_DEBUG) {
        //$smarty->debugging      = true;
        $smarty->caching        = false;
        $smarty->cache_lifetime = 0;
    } else {
        //$smarty->debugging      = false;
        $smarty->caching        = true;
        $smarty->cache_lifetime = 120;
    }
    $smarty->assign('title', '标题');
    $smarty->display('index.tpl');

?>