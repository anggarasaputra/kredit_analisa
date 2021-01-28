<?php

namespace Thunderlabid\Survei;

use Illuminate\Support\ServiceProvider;
use Event;

class SurveiServiceProvider extends ServiceProvider
{
	public function boot()
	{
		////////////////
		// Validation //
		////////////////
		Event::listen('Thunderlabid\Survei\Events\Survei\SurveiCreating', 'Thunderlabid\Survei\Listeners\SavingSurvei');
		Event::listen('Thunderlabid\Survei\Events\Survei\SurveiUpdating', 'Thunderlabid\Survei\Listeners\SavingSurvei');

		Event::listen('Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailCreating', 'Thunderlabid\Survei\Listeners\SavingSurveiDetail');
		Event::listen('Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailUpdating', 'Thunderlabid\Survei\Listeners\SavingSurveiDetail');

		Event::listen('Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoCreating', 'Thunderlabid\Survei\Listeners\SavingSurveiFoto');
		Event::listen('Thunderlabid\Survei\Events\SurveiFoto\SurveiFotoUpdating', 'Thunderlabid\Survei\Listeners\SavingSurveiFoto');

		Event::listen('Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiCreating', 'Thunderlabid\Survei\Listeners\SavingSurveiLokasi');
		Event::listen('Thunderlabid\Survei\Events\SurveiLokasi\SurveiLokasiUpdating', 'Thunderlabid\Survei\Listeners\SavingSurveiLokasi');

		Event::listen('Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorCreating', 'Thunderlabid\Survei\Listeners\SavingAssignedSurveyor');
		Event::listen('Thunderlabid\Survei\Events\AssignedSurveyor\AssignedSurveyorUpdating', 'Thunderlabid\Survei\Listeners\SavingAssignedSurveyor');

		Event::listen('Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailCreated', 'Thunderlabid\Survei\Listeners\UpdateSurveiIsLengkap');
		Event::listen('Thunderlabid\Survei\Events\SurveiDetail\SurveiDetailUpdated', 'Thunderlabid\Survei\Listeners\UpdateSurveiIsLengkap');

	}

	public function register()
	{
		
	}
}