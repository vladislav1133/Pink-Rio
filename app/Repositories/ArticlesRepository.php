<?php

namespace App\Repositories;

use App\Article;


class ArticlesRepository extends Repository {

    public function __construct(Article $article) {
        $this->model=$article;
    }

    public function one($alias,$relation=false){
        $article=parent::one($alias,$relation);

        if($article&&$relation){
            $article->load('comments','user','category');
            $article->comments->load('user');
        }

        if($article)$article->img=json_decode($article->img);
        return $article;
    }
}

