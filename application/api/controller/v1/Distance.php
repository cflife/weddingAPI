<?php
/**
 * Created by PhpStorm.
 * User: liqiaowei
 * Date: 2018/9/3
 * Time: 下午8:20
 */

namespace app\api\controller\v1;


class Distance
{
    private $pmodel;

    public function __construct()
    {
        $this->pmodel = model('distance');
    }


    public function getLastDistance()
    {
        $res = $this->pmodel->lastDistance();
        return json($res);
    }

    public function previousDistance($id)
    {
        $this->pmodel->previousDistance($id);
    }

    public function nextDistance($id)
    {
        $this->pmodel->nextDistance($id);
    }
}