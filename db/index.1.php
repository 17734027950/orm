<?php
	include_once('../vendor/autoload.php');

	use think\Db;



	// 数据库配置信息设置（全局有效）
	Db::setConfig([
    // 数据库类型
    'type'        => 'mysql',
    // 服务器地址
    'hostname'    => '127.0.0.1',
    // 数据库名
    'database'    => 'jkzz',
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
    'prefix'      => 'cmf_',
]);
	// 进行CURD操作
	$user = Db::table('cmf_user')
				->where('id','>',10)
				->order('id','desc')
				->limit(10)
				->select();	

	// var_dump($user);

    $tb = array();
    $table_lists = Db::query("SHOW TABLES");
    foreach ($table_lists as $key => $value) {
        $table = Db::query("Select table_name,TABLE_COMMENT from INFORMATION_SCHEMA.TABLES where table_name='{$value['Tables_in_jkzz']}'");
        echo "表名：{$value['Tables_in_jkzz']} 注释：{$table[0]['TABLE_COMMENT']}";
        $table_field = Db::query("SHOW FULL COLUMNS FROM {$value['Tables_in_jkzz']}");
        // var_dump($table_field);
        echo "<br />";
        echo "&nbsp;&nbsp;";
        foreach ($table_field as $key1 => $value1) {
            echo "字段名：{$value1['Field']} 注释：{$value1['Comment']}&nbsp;";
        }
        echo "<br />";

        $tb[$key]['table_name']    = $value['Tables_in_jkzz'];
        $tb[$key]['table_comment'] = $table[0]['TABLE_COMMENT'];
        $tb[$key]['table_fields'][]  =  array(
            'field' = > $field,
        );
    }


    $loader = new Twig_Loader_Filesystem('../tpl');
    $twig = new Twig_Environment($loader, array(
        'cache' => '../tpl/cache',
    ));
    $template = $twig->load('index.html');
    echo $template->render(array('the' => 'variables', 'go' => 'here'));
?>