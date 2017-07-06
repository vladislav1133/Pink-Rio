<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 05.07.2017
 * Time: 9:49
 */

namespace App\Repositories;
use Config;

abstract class Repository {

    protected $model=false;

    public function get(){

        $builder=$this->model->select('*');
        return $builder->get();
    }
}