<?php

namespace App\Http\Controllers;

use App\Repositories\MenusRepository;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    protected $portfoliosRepository;
    protected $slidersRepository;
    protected $articlesRepository;
    protected $menusRepository;

    protected $template;
    protected $templateVars;

    protected $contentRightBar=FALSE;
    protected $contentLefBar=FALSE;

    protected $bar=FALSE;

    public function __construct(MenusRepository $menusRepository){
        $this->menusRepository=$menusRepository;
    }

    protected function renderOutput(){
        $menu=$this->getMenu();
        dd($menu);

        $navigation=view(env('THEME').'.navigation');
        $this->templateVars=['navigation'=>$navigation];
        return view($this->template)->with($this->templateVars);
    }

    protected function getMenu(){
        $menu=$this->menusRepository->get();

        return $menu;
    }
}
