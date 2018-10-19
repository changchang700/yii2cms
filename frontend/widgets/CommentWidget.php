<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Comment;

class CommentWidget extends Widget
{
	public $article_id;
	
	public $comment_list =array();
	
	public function run()
    {
		$key = 'comment_list_' . $this->article_id;
		$html = Yii::$app->cache->get($key);
		if(!$html){
			$comment_list = Comment::find()
					->from("t_comment as a")
					->select("a.id,a.u_id,a.parent_id,a.article_id,a.comment_content,a.created_at,a.status,b.nickname,b.head_pic,b.r_id,c.name")
					->leftJoin('t_user as b','b.id = a.u_id')
					->leftJoin('t_user_rank as c','c.id = b.r_id')
					->where(['article_id'=> $this->article_id])
					->asArray()
					->all();
			if(empty($comment_list)){
				return;
			}
			//此处可以把评论缓存起来，不然后期评论多了会消耗服务器资源
			$comments = $this->listToTree($comment_list);
			$this->treeToOne($comments);
			$html = $this->html();
			Yii::$app->cache->set($key,$html,300);
		}
		return $html;
    }
	
		public function listToTree($list, $pk = 'id', $pid = 'parent_id', $child = '_child', $root=0) {  
		$tree = array();
		if(is_array($list)){
			//重新排序数组，对数组的索引变成id
			$refer = array();
			foreach ($list as $key => $data) {
				$refer[$data[$pk]] = &$list[$key];
				
			}
			foreach ($list as $key => $data) {
				$parentId = $data[$pid];
				if ($root == $parentId) {
					$tree[$data[$pk]] = &$list[$key];
				}else{
					if (isset($refer[$parentId])){
						$parent = &$refer[$parentId];
						$parent[$child][] = &$list[$key];
					}
				}
			}
		}  
		return $tree;
	}
	
	public function treeToOne($tree){
		if(is_array($tree)){
			foreach ($tree as $value){
				$data = $value;
				if(array_key_exists('_child', $value)){
					unset($data['_child']);
					$this->comment_list[] = $data;
					$this->treeToOne($value['_child']);
				}else{
					$this->comment_list[] = $data;
				}
			}
		}
	}
	
	public function getParentNickname($id){
		foreach ($this->comment_list as $value) {
			if($value['id']==$id){
				return $value['nickname'];
			}
		}
	}
	
	public function html(){
		$html = '';
		foreach ($this->comment_list as $value) {
			switch ($value['status']){
				case 1:
					$content = "<span style='color:#ccc'>该评论还未审核</span>";
					break;
				case 2:
					$content = $value['comment_content'];
					break;
				case 3:
					$content = "<span style='color:#ff0000'>该评论已违规</span>";
					break;
			}
			if($value['parent_id']==0){
				$html .=	'<li class="comment odd alt thread-odd thread-alt depth-1" id="li-comment-' . $value['id'] . '">
							<div id="comment-' . $value['id'] . '" class="comment-body">
								<div class="author">
									<img alt="" src="' . $value['head_pic'] . '" srcset="' . $value['head_pic'] . '" class="avatar avatar-38 photo">
								</div>
								<span class="time">
									' . date("Y-m-d", $value['created_at']) . '
								</span>
								<div class="commlist-middle">
									<span class="name">
										<a href="#" rel="external nofollow" class="url">' . $value['nickname'] . '</a>
									</span>
									<div class="reply">
										<a rel="nofollow" class="comment-reply-link" href="#" onclick="return addComment.moveForm(\'comment-' . $value['id'] . '\', \'' . $value['id'] . '\', \'respond\', \''.$value['article_id'].'\' )" aria-label="">回复</a>
									</div>
									<div class="text">
										<p>' . $content . '</p>
									</div>
								</div>
							</div>
						</li>';
			}else{
				$html .=	'<ul class="children">
							<li class="comment even depth-2" id="li-comment-' . $value['id'] . '">
								<div id="comment-' . $value['id'] . '" class="comment-body">
									<div class="author">
										<img alt="" src="' . $value['head_pic'] . '" srcset="' . $value['head_pic'] . '" class="avatar avatar-38 photo">
									</div>
									<span class="time">
										' . date("Y-m-d", $value['created_at']) . '
									</span>
									<div class="commlist-middle">
										<span class="name">
											<a href="#" rel="external nofollow" class="url">' . $value['nickname'] . '</a>
										</span>
										<div style="display: none;" class="reply">
											<a rel="nofollow" class="comment-reply-link" href="http://www.alilinet.com/" onclick="return addComment.moveForm(\'comment-' . $value['id'] . '\', \'' . $value['id'] . '\', \'respond\', \''.$value['article_id'].'\')" aria-label="">回复</a>
										</div>
										<div class="text">
											<span class="comment-to">
												<span>
													<a href="#" rel="external nofollow" class="url">
														@ ' . $this->getParentNickname($value['parent_id']) . '
													</a>&nbsp;&nbsp;
												</span>
											</span>' . $content . '
										</div>
									</div>
								</div>
							</li>
						</ul>';
			}
		}
		return $html;
	}
}
