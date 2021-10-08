
<?php


 
use App\Device;
use Illuminate\Support\Collection;

interface DeviceRepositoryInterface
{
   public function all(): Collection;
}
 
