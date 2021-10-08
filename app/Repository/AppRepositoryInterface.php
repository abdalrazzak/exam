
<?php


 
use App\App;
use Illuminate\Support\Collection;

interface AppRepositoryInterface
{
   public function all(): Collection;
}
 
