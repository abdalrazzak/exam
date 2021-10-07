
<?php


 
use App\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
   public function all(): Collection;
}
 
