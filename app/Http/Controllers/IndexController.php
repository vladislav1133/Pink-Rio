<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use App\Repositories\SlidersRepository;
use Illuminate\Http\Request;

use Config;

class IndexController extends SiteController
{

    public function __construct(SlidersRepository $slidersRepository,PortfoliosRepository $portfoliosRepository){
        parent::__construct(new MenusRepository(new Menu()));

        $this->portfoliosRepository=$portfoliosRepository;
        $this->slidersRepository=$slidersRepository;

        $this->bar='right';
        $this->template=env('THEME').'.index';
    }


    public function index(){
        $portfolios=$this->getPortfolio();
        $content=view(env('THEME').'.content')->with('portfolios',$portfolios);

        $sliderItems=$this->getSliders();
        $sliders=view(env('THEME').'.slider')->with('sliders',$sliderItems);


        $this->templateVars=array_add($this->templateVars,'sliders',$sliders);
        $this->templateVars=array_add($this->templateVars,'content',$content);

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
