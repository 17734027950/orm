<?php
	//开启调试模式
    define('APP_DEBUG', true);
    //入口文件目录绝对路径
    define('SITE_ROOT', str_replace('\\', '/', __DIR__));
    //数据缓存目录绝对目录
    defined('DATA_PATH') or define('DATA_PATH', SITE_ROOT . '/data');
    //包含自动加载类
    $loader = require '../vendor/autoload.php';

    // Db实例化
    use think\Db;

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


    $database = 'orm_test';

    // 数据库配置信息设置（全局有效）
    Db::setConfig([
    // 数据库类型
    'type'        => 'mysql',
    // 服务器地址
    'hostname'    => '127.0.0.1',
    // 数据库名
    'database'    => $database,
    // 数据库用户名
    'username'    => 'root',
    // 数据库密码
    'password'    => 'root',
    // 数据库连接端口
    'hostport'    => '',
    // 数据库连接参数
    'params'      => [],
    // 数据库编码默认采用utf8
    'charset'     => 'utf8',
    // 数据库表前缀
    'prefix'      => 'orm_',
]);

    // var_dump($database);die;

    // 进行CURD操作
    $test = Db::table('orm_test')
                ->where('id','>',10)
                ->order('id','desc')
                ->limit(10)
                ->select(); 

    // var_dump($test);die;

    $tb = array();
    $table_lists = Db::query("SHOW TABLES");
    // var_dump($table_lists);die;
    
    foreach ($table_lists as $key => $value) {
        $table_name = $value['Tables_in_'.$database.''];
        $table = Db::query("Select table_name,TABLE_COMMENT from INFORMATION_SCHEMA.TABLES where table_name='{$table_name}'");
        
        $table_field = Db::query("SHOW FULL COLUMNS FROM {$table_name}");
        $table_fields = array();
        foreach ($table_field as $key1 => $value1) {
            $table_fields[] = array(
                'field'   => $value1['Field'],
                'comment' => $value1['Comment'],
            );
        }
        $tb[$key]['table_name']      = $table_name;
        $tb[$key]['table_comment']   = $table[0]['TABLE_COMMENT'];
        $tb[$key]['table_fields']  =  $table_fields;
    }


    $smarty->assign('title', '标题');
    $smarty->assign('tb', $tb);
    $smarty->display('index.tpl');

?>