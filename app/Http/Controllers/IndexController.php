<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Category;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use App\Repositories\SlidersRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Config;

class IndexController extends SiteController
{

    public function __construct(SlidersRepository $slidersRepository,PortfoliosRepository $portfoliosRepository,ArticlesRepository $articlesRepository){
        parent::__construct(new MenusRepository(new Menu()));

        $this->portfoliosRepository=$portfoliosRepository;
        $this->slidersRepository=$slidersRepository;
        $this->articlesRepository=$articlesRepository;

        $this->bar='right';
        $this->template=env('THEME').'.index';
    }


    public function index(){
        $portfolios=$this->getPortfolio();
        $content=view(env('THEME').'.content')->with('portfolios',$portfolios);

        $sliderItems=$this->getSliders();
        $sliders=view(env('THEME').'.slider')->with('sliders',$sliderItems);

        $articles=$this->getArticles();
        $this->contentRightBar=view(env('THEME').'.indexBar')->with('articles',$articles);

        $this->templateVars['sliders']=$sliders;
        $this->templateVars['content']=$content;

        $this->keywords='Pink rio';
        $this->metaDescription='Pink rio';
        $this->title='Pink rio';

        return $this->renderOutput();
    }

    protected function getSliders(){
        $sliders=$this->slidersRepository->get();

        if($sliders->isEmpty())return false;
        $sliders->transform(function ($item,$key){
            $item->img=Config::get('settings.slider_path').'/'.$item->img;
            return $item;
        });

        return $sliders;
    }

    protected function getArticles(){
        $articles=$this->articlesRepository->get(['title','img','created_at','alias'],Config::get('settings.home_arts_count'));
        if($articles)$articles->load('category');
        return $articles;
    }

    protected function getPortfolio(){
        $portfolio=$this->portfoliosRepository->get('*',Config::get('settings.home_portf_count'));

        return $portfolio;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
