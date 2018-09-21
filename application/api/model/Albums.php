<?php
namespace app\api\model;
use think\Model;

class Albums extends Model
{
    public function getAlbum(){
        $res = $this->select();
        return $res;
    }
}