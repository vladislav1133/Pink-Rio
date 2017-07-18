<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Menu;
use App\Category;

use App\Repositories\PortfoliosRepository;
use App\Repositories\ArticlesRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\MenusRepository;

class ArticlesController extends SiteController
{
    protected $commentsRepository;

    public function __construct(PortfoliosRepository $portfoliosRepository,ArticlesRepository $articlesRepository,CommentsRepository $commentsRepository){
        parent::__construct(new MenusRepository(new Menu()));

        $this->portfoliosRepository=$portfoliosRepository;
        $this->articlesRepository=$articlesRepository;
        $this->commentsRepository=$commentsRepository;

        $this->bar='right';
        $this->template=env('THEME').'.articles';
    }

    public function index($categoryAlias=false){

        $articles=$this->getArticles($categoryAlias);
        $content=view(env('THEME').'.articlesContent')->with('articles',$articles);
        $this->templateVars['content']=$content;

        $this->getArticlesBar();

        return $this->renderOutput();
    }

    public function show($alias=false){
        $article=$this->articlesRepository->one($alias,true);

        $this->title=$article->title;
        $this->keywords=$article->keywords;
        $this->metaDescription=$article->meta_desc;

        $content=view(env('THEME').'.articleContent')->with('article',$article);

        //$this->templateVars=array_add($this->templateVars,'content',$content);
        $this->templateVars['content']=$content;
        $this->getArticlesBar();

        return $this->renderOutput();
    }

    public function getArticlesBar(){
        $comments=$this->getComments(config('settings.recent_comments'));
        $portfolios=$this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar=view(env('THEME').'.articlesBar')->with(['comments'=>$comments,'portfolios'=>$portfolios]);
    }















    protected function getComments($take){
        $comments=$this->commentsRepository
            ->get(['text','name','email','site','article_id','user_id'],$take);

        if($comments)$comments->load('article','user');
        return $comments;
    }

    protected function getPortfolios($take){
        $portfolios=$this->portfoliosRepository
        ->get(['title','text','alias','customer','img','filter_alias'],$take);

        if($portfolios)$portfolios->load('filter');
        return $portfolios;
    }

    protected function getArticles($categoryAlias=false){
        $where=false;

        if($categoryAlias){
            $id=Category::select('id')->where('alias',$categoryAlias)->first()->id;
            $where=['category_id',$id];
        }


        $articles=$this->articlesRepository
            ->get(['id','title','alias','created_at','img','desc','user_id','category_id','keywords','meta_desc'],false,true,$where);

        if($articles)$articles->load('user','category','comments');

        return $articles;
    }

}
