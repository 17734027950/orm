<?php
	include_once('../vendor/autoload.php');

	use think\Db;

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

    // var_dump($tb);die;


    $loader = new Twig_Loader_Filesystem('../tpl');
    $twig = new Twig_Environment($loader, array(
        'cache' => '../tpl/cache',
    ));
    $template = $twig->load('index.html');
    echo $template->render(array('tb' => $tb));
?>