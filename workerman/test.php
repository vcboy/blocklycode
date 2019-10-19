<?php
use Workerman\Worker;
require_once __DIR__ . '/Workerman/Autoloader.php';
require_once __DIR__ . '/vendor/autoload.php';

// 注意：这里与上个例子不同，使用的是websocket协议
$ws_worker = new Worker("websocket://0.0.0.0:2000");

// 启动4个进程对外提供服务
$ws_worker->count = 4;

// 当收到客户端发来的数据后返回hello $data给客户端
$ws_worker->onMessage = function($connection, $data)
{
    // 向客户端发送hello $data
    //$connection->send('hello ' . $data);
    $dataArr = json_decode($data,true);
    var_dump($dataArr);
    $connection->send('hello ' . $dataArr['msgtype']);
    /*foreach($connection->worker->connections as $con)
    {
        $con->send($data);
        echo $data;
    }*/
    // 通过全局变量获得db实例
    global $db;
    // 执行SQL
    //$all_tables = $db->query('show tables');
    //$connection->send(json_encode($all_tables));
    $row_count = $db->query("UPDATE `wx_member` SET `lan_ip` = '$dataArr[lanip]' WHERE username='$dataArr[username]'");
    //$connection->send('hello ' . $row_count);
};

//当客户端与Workerman建立连接时(TCP三次握手完成后)触发的回调函数
$ws_worker->onConnect = function($connection)
{
    echo "new connection from ip " . $connection->getRemoteIp() . "\n";
};

//当客户端的连接上发生错误时触发
$ws_worker->onError = function($connection, $code, $msg)
{
    echo "error $code $msg\n";
};

//Worker子进程启动时的回调函数
$ws_worker->onWorkerStart = function($worker)
{
    echo "Worker starting...\n";
    global $db;
    $db = new \Workerman\MySQL\Connection('localhost', '3306', 'root', 'root', 'blocklyrobot');
};

// 运行worker
Worker::runAll();