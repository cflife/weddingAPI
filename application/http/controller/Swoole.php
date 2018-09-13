<?php
namespace app\http\controller;
use think\swoole\Server;

class Swoole extends Server
{
    protected $host = '127.0.0.1';
    protected $port = 9501;
    protected $serverType = 'socket';
    protected $mode = SWOOLE_PROCESS;
    protected $sockType = SWOOLE_SOCK_TCP;
    protected $option = [
        'worker_num'=> 4,
        'daemonize'	=> false,
        'backlog'	=> 128
    ];
    public function onOpen($server,$request){
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function onMessage($server,$frame){
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish},hellocaicai\n";
        $server->push($frame->fd, "this is server");
    }

    public function onRequest($request,$response){
        $response->end("<h1>Hello Swoole. #" . rand(1000, 9999) . "</h1>");
    }

    public function onClose($ser,$fd){
        echo "client {$fd} closed\n";
    }

    public function onReceive($server, $fd, $from_id, $data)
    {
        $server->send($fd, 'Swoole: '.$data);
    }
}