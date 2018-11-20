<?php
/**
 * Created by PhpStorm.
 * User: zhq
 * Date: 2018/9/17
 * Time: 14:15
 */
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Comment as CommentModel;
use think\Controller;
use app\api\model\Albums as AlbumsModel;
use think\facade\Request;

class Albums extends BaseController
{
    protected $beforeActionList = [
        'checktoken' => ['only' => 'addshortcomment']
    ];
    protected $pmodel;

    public function __construct()
    {
        parent::__construct();
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

    public function getShortComment($aid){
        $cmtModel = new CommentModel();
        $res = $cmtModel->getComment($aid);
        return $res;
    }

    public function addShortComment(){
        $aid = Request::post('aid');
        $content = Request::post('comment');
        $user_comment = model('user_comment');
        $comment = CommentModel::where(['aid'=>$aid,'content'=>$content])->find();
        if($comment){
            $comment->num = ['inc',1];
            $comment->save();
            $user_comment->save([
                'uid'=>$this->uid,
                'cid'=>$comment->id
            ]);
        }else{
            $res = CommentModel::create([
                'content'=>$content,
                'aid'=>$aid,
            ]);
            $user_comment->save([
               'uid'=>$this->uid,
               'cid'=>$res['id']
            ]);
        }
        return json(['status'=>1,'msg'=>'评论成功']);
    }
}