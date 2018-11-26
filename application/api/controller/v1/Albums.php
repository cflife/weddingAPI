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
use app\api\model\LikeAlbums;
use think\Controller;
use app\api\model\Albums as AlbumsModel;
use think\facade\Request;
use app\api\model\User as UserModel;

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

    public function like()
    {
        $aid = Request::post('aid');
        $res = LikeAlbums::create([
            'aid'=>$aid,
            'uid'=>$this->uid
        ]);
        if($res){
            return json(['status'=>0,'msg'=>'点赞成功']);
        }else{
            return json(['status'=>-1,'msg'=>'点赞失败']);
        }
    }

    public function cancelLike()
    {
        $aid = Request::post('aid');
        $res = LikeAlbums::destroy(['aid'=>$aid,'uid'=>$this->uid]);
        if($res){
            return json(['status'=>0,'msg'=>'删除成功']);
        }else{
            return json(['status'=>-1,'msg'=>'删除失败']);
        }
    }

    public function getLike($aid)
    {
        $likeModel = new LikeAlbums();
        $num = $likeModel->getDistanceLike($aid);
        $res = $likeModel->where(['uid'=>$this->uid,'aid'=>$aid])->find();
        $isLike = $res ? true : false;
        return json(['num'=>$num,'isLike'=>$isLike]);
    }

    public function myLike()
    {
        $user = UserModel::get($this->uid);
        $albums = $user->albums;
        return $albums;
    }
}