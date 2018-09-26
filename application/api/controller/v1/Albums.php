<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/17
 * Time: 14:15
 */
namespace app\api\controller\v1;

use think\Controller;
use app\api\model\Albums as AlbumsModel;

class Albums extends Controller
{
    protected $pmodel;
    public function __construct()
    {
        $this->pmodel = model('albums');
    }

    public function albums(){
        $res = $this->pmodel->getAlbum();
        return $res;
    }

    public function detail($id){
        $imgs = AlbumsModel::getDetailById($id);
        return json($imgs);
    }
}