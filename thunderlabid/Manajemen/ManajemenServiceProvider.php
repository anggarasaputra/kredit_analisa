<?php

namespace Thunderlabid\Manajemen;

use Illuminate\Support\ServiceProvider;
use Event;

class ManajemenServiceProvider extends ServiceProvider
{
	public function boot()
	{
		////////////////
		// Validation //
		////////////////
		Event::listen('Thunderlabid\Manajemen\Events\Orang\OrangCreating', 'Thunderlabid\Manajemen\Listeners\SavingOrang');
		Event::listen('Thunderlabid\Manajemen\Events\Orang\OrangUpdating', 'Thunderlabid\Manajemen\Listeners\SavingOrang');
		Event::listen('Thunderlabid\Manajemen\Events\Orang\OrangDeleting', 'Thunderlabid\Manajemen\Listeners\DeletingOrang');
		Event::listen('Thunderlabid\Manajemen\Events\Orang\OrangDeleting', 'Thunderlabid\Manajemen\Listeners\DeletingPenempatan');
		
		//Event::listen('Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanCreating', 'Thunderlabid\Manajemen\Listeners\SavingPenempatanKaryawan');
		//Event::listen('Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanUpdating', 'Thunderlabid\Manajemen\Listeners\SavingPenempatanKaryawan');

		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorCreating', 'Thunderlabid\Manajemen\Listeners\AssignIDKantor');
		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorCreating', 'Thunderlabid\Manajemen\Listeners\SavingKantor');
		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorUpdating', 'Thunderlabid\Manajemen\Listeners\SavingKantor');

		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorDeleting', 'Thunderlabid\Manajemen\Listeners\DeletingPenempatan');


		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorCreating', 'Thunderlabid\Manajemen\Listeners\HanyaSatuHolding');
		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorUpdating', 'Thunderlabid\Manajemen\Listeners\HanyaSatuHolding');

		Event::listen('Thunderlabid\Manajemen\Events\MobileApi\MobileApiCreating', 'Thunderlabid\Manajemen\Listeners\SavingMobileApi');
		Event::listen('Thunderlabid\Manajemen\Events\MobileApi\MobileApiUpdating', 'Thunderlabid\Manajemen\Listeners\SavingMobileApi');
		
		//////////////////////
		// Encrypt Password //
		//////////////////////
		Event::listen('Thunderlabid\Manajemen\Events\Orang\OrangCreating', 'Thunderlabid\Manajemen\Listeners\EncryptPassword');
		Event::listen('Thunderlabid\Manajemen\Events\Orang\OrangUpdating', 'Thunderlabid\Manajemen\Listeners\EncryptPassword');
	
		//////////////////////
		//  Encrypt Secret  //
		//////////////////////	
		Event::listen('Thunderlabid\Manajemen\Events\MobileApi\MobileApiCreating', 'Thunderlabid\Manajemen\Listeners\EncryptSecret');
		Event::listen('Thunderlabid\Manajemen\Events\MobileApi\MobileApiUpdating', 'Thunderlabid\Manajemen\Listeners\EncryptSecret');
		
		//////////////////////
		//    Assign  NIP   //
		//////////////////////
		Event::listen('Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanCreating', 'Thunderlabid\Manajemen\Listeners\AutoAssignNIP');
		Event::listen('Thunderlabid\Manajemen\Events\PenempatanKaryawan\PenempatanKaryawanUpdating', 'Thunderlabid\Manajemen\Listeners\AutoAssignNIP');

		Event::listen('Thunderlabid\Manajemen\Events\Kantor\KantorCreated', 'Thunderlabid\Manajemen\Listeners\AutoAssignLoggedUser');
	}

	public function register()
	{
		
	}
}