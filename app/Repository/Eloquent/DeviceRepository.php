<?php

namespace App\Repository\Eloquent;

use App\Device; 
use App\Repository\DeviceRepositoryInterface;
use Illuminate\Support\Collection;

class DeviceRepository extends BaseRepository implements DeviceRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Device $model)
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