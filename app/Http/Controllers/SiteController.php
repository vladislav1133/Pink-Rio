<?php

namespace App\Http\Controllers;

use App\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Menu;

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

    public function renderOutput(){
        $menu=$this->getMenu();
        $navigation=view(env('THEME').'.navigation')->with('menu',$menu);
        $this->templateVars=array_add($this->templateVars,'navigation',$navigation);

        return view($this->template)->with($this->templateVars);
    }

    protected function getMenu(){
        $menu=$this->menusRepository->get();

        $menuBuilder=Menu::make('MainNav',function ($m)use ($menu){
            foreach ($menu as $item){

                if($item->parent==null){
                    $m->add($item->title,$item->path)->id($item->id);

                } else {
                    if($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });

        return $menuBuilder;
    }
}
