<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 李震
// +----------------------------------------------------------------------

namespace Home\Controller;

/**
 * 文档模型控制器
 * 文档模型列表和详情
 */
class ArticleController extends HomeController {

    /* 新闻列表页 */
	public function index($id=0){
					  $category = $this->category($id);
						$this->assign('category',$category);// 赋值分页输出
						$map = array();
						$map['category_id'] = $category['id'];
						$map['status'] = 1;
						$num = 15;
				    $Document = M('document');
						$lists = $Document->where($map)->order('create_time')->page($_GET['p'].','.$num)->select();
						foreach($lists as $key=>$val){
                   $lists[$key]['url'] = U('Article/detail',array('id'=>$val['id']));
						}
						$this->assign('lists',$lists);// 赋值数据集
						$count      = $Document->where($map)->count();// 查询满足要求的总记录数
				   	$_page = article_pages($count,$num);
						$this->assign('_page',$_page);// 赋值分页输出

            $Catelist = D('category');
            $cateList = $Catelist->getTree(2,false);
						$this->assign('cateList',$cateList);// 分类树
						$this->display();
	}


	/* 文档模型详情页 */
	public function detail($id = 0, $p = 1){
						/* 标识正确性检测 */
						if(!($id && is_numeric($id))){
							$this->error('文档ID错误！');
						}

						/* 页码检测 */
						$p = intval($p);
						$p = empty($p) ? 1 : $p;

						/* 获取详细信息 */
						$Document = D('Document');
						$info = $Document->detail($id);
						if(!$info){
							$this->error($Document->getError());
						}

						/* 分类信息 */
						$category = $this->category($info['category_id']);

						/* 获取模板 */
						if(!empty($info['template'])){//已定制模板
							$tmpl = $info['template'];
						} elseif (!empty($category['template_detail'])){ //分类已定制模板
							$tmpl = $category['template_detail'];
						} else { //使用默认模板
							$tmpl = 'Article/'. get_document_model($info['model_id'],'name') .'/detail';
						}

						/* 更新浏览数 */
						$map = array('id' => $id);
						$Document->where($map)->setInc('view');

						/* 模板赋值并渲染模板 */
						$this->assign('category', $category);
						$this->assign('info', $info);
						$this->assign('page', $p); //页码

						$Catelist = D('category');
						$cateList = $Catelist->getTree(2,false);
						$this->assign('cateList',$cateList);// 分类树
						$this->display();
	}

	/* 文档分类检测 */
	private function category($id = 0){
						/* 标识正确性检测 */
						$id = $id ? $id : I('get.catid', 1);
						if(empty($id)){
							$this->error('没有指定文档分类！');
						}
						/* 获取分类信息 */
						$category = D('Category')->info($id);
						if($category && 1 == $category['status']){
							switch ($category['display']) {
								case 0:
									$this->error('该分类禁止显示！');
									break;
								//TODO: 更多分类显示状态判断
								default:
									return $category;
							}
						} else {
							$this->error('分类不存在或被禁用！');
						}
				}
}
