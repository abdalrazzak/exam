<?php

namespace App\Repository\Eloquent;

use App\App;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;

class AppRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(App $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }
}