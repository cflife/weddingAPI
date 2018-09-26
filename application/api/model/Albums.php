<?php
namespace app\api\model;
use think\Model;

class Albums extends Model
{
    public function getAlbum(){
        $res = $this->select();
        return $res;
    }

    public function imgs(){
        return $this->hasMany('Albumsimgs','aid','id');
    }

    public static function getDetailById($id){
        $item = self::with('imgs')
            ->find($id);
        return $item;
    }

}