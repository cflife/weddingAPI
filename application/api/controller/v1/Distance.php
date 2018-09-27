<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/27
 * Time: 10:45
 */

namespace app\api\controller\v1;

use think\facade\Cache;
use think\Controller;

class Distance extends Controller
{
    protected $pmodel;
    public function __construct()
    {
        $this->pmodel = model('distance');
    }

    public function lastdistance(){
        $res = $this->pmodel->getLastDistance();
        return $res;
    }

    public function previous(){
        $res = $this->pmodel->previousDistance();
        return $res;
    }

    public function next(){
        $res = $this->pmodel->nextDistance();
        return $res;
    }
}