<?php

namespace App\Repository;
 
use App\Subscription;
use Illuminate\Support\Collection;

interface SubscriptionRepositoryInterface
{
   public function all(): Collection;
}
 
