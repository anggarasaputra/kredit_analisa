<?php

namespace App\Http\Controllers;

////////////
// Others //
////////////
use Exception;
use Auth;
use GuzzleHttp\Client;
use App\Exceptions\AppException;
use MessageBag;

////////////
// Models //
////////////
use Thunderlabid\Socialmedia\Models\Instagram;
use Thunderlabid\Socialmedia\Models\IGEngage;
use Thunderlabid\Socialmedia\Models\IGMedia;

class InstagramController extends Controller
{
	protected $view_dir = 'social_medias.accounts.instagram.';

	function __construct()
	{
		parent::__construct();

		$this->layout->submenu = [
			// 'Company'	=> route('social_medias.index'),
		];

		view()->share('active_menu', 'social_media');
	}

	public function index($id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		///////////////////////////
		// Create Follower Chart //
		///////////////////////////
		// Get Data
		$since = \Carbon\Carbon::now()->endofDay()->subDay(28);
		$statistics = $account->statistics()->newQuery()->of($account->id)->between($since, \Carbon\Carbon::now()->endOfDay())->get();

		// Chart Settings
		$chart_label = [];
		$chart_dataset = [];

		// Dataset: Total followers
		$chart_dataset['followers']['label'] = 'Total Followers';
		$chart_dataset['followers']['borderColor'] = '#000';
		$chart_dataset['followers']['backgroundColor'] = '#000';
		$chart_dataset['followers']['fill'] = false;

		$chart_dataset['follows']['label'] = 'Total Follows';
		$chart_dataset['follows']['borderColor'] = '#09f';
		$chart_dataset['follows']['backgroundColor'] = '#09f';
		$chart_dataset['follows']['fill'] = false;

		$chart_dataset['media']['label'] = 'Total Media';
		$chart_dataset['media']['borderColor'] = '#f00';
		$chart_dataset['media']['backgroundColor'] = '#f00';
		$chart_dataset['media']['fill'] = false;

		$i = 0;
		while ($since->lte(\Carbon\Carbon::now()->endOfDay())) {
			// Chart Settings
			$chart_label[] = $since->format('d/m');

			$today_statistics = $statistics->filter(function($item) use ($since) {
				return $item->created_at->gte($since->startOfDay()) && $item->created_at->lte($since->endOfDay());
			});

			// Dataset: Total Followers
			if ($today_statistics->first())
			{
				$chart_dataset['followers']['data'][] = $today_statistics->first()->followers;
				$chart_dataset['follows']['data'][] = $today_statistics->first()->follows;
				$chart_dataset['media']['data'][] = $today_statistics->first()->media;
			}
			else
			{
				$chart_dataset['followers']['data'][] = 0;	
				$chart_dataset['follows']['data'][] = 0;	
				$chart_dataset['media']['data'][] = 0;	
			}
			$since->addDay(1);
		}

		view()->share('statistics', $statistics);
		view()->share('chart_label', $chart_label);
		view()->share('chart_dataset', [$chart_dataset['followers'], $chart_dataset['follows'], $chart_dataset['media']]);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'overview');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}

	////////////
	// ENGAGE //
	////////////
	public function engage($id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////
		// Get Data //
		//////////////
		$filters['type'] 		= request()->input('type');
		$filters['q'] 			= request()->input('q');
		$filters['active'] 		= request()->input('active');

		$q = IGEngage::of($account->id)->type($filters['type'])->orderBy('type')->orderBy('value');
		if (request()->has('active') && request()->get('active') == 0)
		{
			$q = $q->inactive();
		}
		else
		{
			$q = $q->active();
		}
		$q = $q->search(request()->get('q'));
		$ig_engage = $q->paginate(100);
		view()->share('ig_engages', $ig_engage);
		view()->share('filters', $filters);
		view()->share('engage_type', IGEngage::$type);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'engage');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}

	public function post_engage($account_id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::findorfail($account_id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		/////////////////////
		// Save engagement //
		/////////////////////
		try {
			$value 	= request()->input('engage');
			$type 	= request()->input('type');

			if ($value && $type && IGEngage::type($type)->of($account_id)->search($value)->count())
			{
				session()->flash('alert_info', $value . ' is already in this account engagement list before');
				return redirect()->route('social_media.instagram.engage', ['account' => $account_id]);
			}

			$ig_engage = new IGEngage(['account_id' => $account->id, 'type' => $type, 'value' => $value]);
			$ig_engage->save();
			session()->flash('alert_success', 'New engagement has been added');
			return redirect()->back();

		} catch (Exception $e) {
			return redirect()->back()->withErrors($e->getMessage())->withInput();
		}
	}

	public function engage_activate($account_id, $engage_id, $is_active = 1)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner(Auth::user()->id)->findorfail($account_id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////////////
		// Get Watchlist ID //
		//////////////////////
		$engage = $account->engages->where('id', $engage_id)->first();
		if ($is_active)
		{
			$engage->activate();
		}
		else
		{
			$engage->deactivate();
		}

		/////////////
		// return  //
		/////////////
		session()->flash('alert_success', 'Watchlist ' . $engage->for_humans . ' has been ' . ($engage->is_active ? ' activated' : 'deactivated'));
		return redirect()->back();
	}

	///////////////
	// FOLLOWERS //
	///////////////
	public function followers($id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////
		// Get Data //
		//////////////
		if (request()->has('date'))
		{
			$input_date = explode(' ', request()->input('date'));
			try {
				$since = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[0]);
			} catch (Exception $e) {
				$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			}

			try {
				$until = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[2]);
			} catch (Exception $e) {
				$until = \Carbon\Carbon::now()->endOfDay();
			}
		}
		else
		{
			$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			$until = \Carbon\Carbon::now()->endOfDay();
		}

		$analysis = $account->analysis()->newQuery()->between($since, $until)->oldest()->get();

		$first_analysis 	= $analysis->first();
		$last_analysis 		= $analysis->last();

		view()->share('since', $since);
		view()->share('until', $until);
		view()->share('first_analysis', $first_analysis);
		view()->share('last_analysis', $last_analysis);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'followers');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}

	///////////////
	// MEDIA 	 //
	///////////////
	public function media($account_id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($account_id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////
		// Get Data //
		//////////////
		if (request()->has('date'))
		{
			$input_date = explode(' ', request()->input('date'));
			try {
				$since = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[0]);
			} catch (Exception $e) {
				$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			}

			try {
				$until = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[2]);
			} catch (Exception $e) {
				$until = \Carbon\Carbon::now()->endOfDay();
			}
		}
		else
		{
			$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			$until = \Carbon\Carbon::now()->endOfDay();
		}

		//////////////
		// Get Data //
		//////////////
		$most_liked_media = IGMedia::of($account->id)->between($since, $until)->orderBy('likes', 'desc')->paginate(15);
		$most_commented_media = IGMedia::of($account->id)->between($since, $until)->orderBy('comments', 'desc')->paginate(15);
		$total_video = IGMedia::of($account->id)->between($since, $until)->type('video')->count();
		$total_image = IGMedia::of($account->id)->between($since, $until)->type('image')->count();

		view()->share('since', $since);
		view()->share('until', $until);
		view()->share('most_liked_media', $most_liked_media);
		view()->share('most_commented_media', $most_commented_media);
		view()->share('total_video', $total_video);
		view()->share('total_image', $total_image);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'media');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}

	///////////////
	// TAG		 //
	///////////////
	public function tag($account_id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($account_id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////
		// Get Data //
		//////////////
		if (request()->has('date'))
		{
			$input_date = explode(' ', request()->input('date'));
			try {
				$since = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[0]);
			} catch (Exception $e) {
				$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			}

			try {
				$until = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[2]);
			} catch (Exception $e) {
				$until = \Carbon\Carbon::now()->endOfDay();
			}
		}
		else
		{
			$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			$until = \Carbon\Carbon::now()->endOfDay();
		}

		// $tag = ;

		////////////////
		// Share Data //
		////////////////
		view()->share('since', $since);
		view()->share('until', $until);
		view()->share('tag', $tag);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'tag');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}


	///////////////
	// AUDIENCE	 //
	///////////////
	public function audience($account_id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($account_id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////
		// Get Data //
		//////////////
		if (request()->has('date'))
		{
			$input_date = explode(' ', request()->input('date'));
			try {
				$since = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[0]);
			} catch (Exception $e) {
				$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			}

			try {
				$until = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[2]);
			} catch (Exception $e) {
				$until = \Carbon\Carbon::now()->endOfDay();
			}
		}
		else
		{
			$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			$until = \Carbon\Carbon::now()->endOfDay();
		}

		// $audience = ;

		////////////////
		// Share Data //
		////////////////
		view()->share('since', $since);
		view()->share('until', $until);
		view()->share('audience', $audience);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'audience');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}

	///////////////
	// ACTIVITY	 //
	///////////////
	public function activity($account_id)
	{
		/////////////////
		// GET ACCOUNT //
		/////////////////
		$account = Instagram::owner($this->me->id)->findorfail($account_id);
		view()->share('account', $account);
		view()->share('active_account', $account);

		//////////////
		// Get Data //
		//////////////
		if (request()->has('date'))
		{
			$input_date = explode(' ', request()->input('date'));
			try {
				$since = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[0]);
			} catch (Exception $e) {
				$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			}

			try {
				$until = \Carbon\Carbon::createFromFormat('d-m-Y', $input_date[2]);
			} catch (Exception $e) {
				$until = \Carbon\Carbon::now()->endOfDay();
			}
		}
		else
		{
			$since = \Carbon\Carbon::now()->startOfDay()->subMonth(1);
			$until = \Carbon\Carbon::now()->endOfDay();
		}

		// $activity = ;

		////////////////
		// Share Data //
		////////////////
		view()->share('since', $since);
		view()->share('until', $until);
		view()->share('activity', $activity);
		
		///////////////
		// View		 //
		///////////////
		view()->share('mode', 'activity');
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}


	////////////////////////////////////////////////////////////////////////////////
	// AUTHENTICATION 															  //
	////////////////////////////////////////////////////////////////////////////////
	public function authenticate($type)
	{
		//////////////
		// Get Data //
		//////////////
		switch (strtolower($type)) {
			case 'instagram':
				view()->share('type', 'instagram');
				view()->share('redirect_url', config('socialmedia.instagram.authorization_url'));
				break;
			
			default:
				# code...
				break;
		}

		//////////
		// View //
		//////////
		$this->layout->page = view($this->view_dir . 'authenticate');
		return $this->layout;
	}

	public function authenticate_callback()
	{
		if (request()->has('error'))
		{
			session()->flash('alert_danger', 'You have cancelled giving an authorization for instagram account @' . $account->name);
			return redirect()->route('social_media.index');
		}
		elseif (request()->has('code'))
		{
			$code = request()->input('code');

			//////////////////////////////
			// STEP 3: GET ACCESS TOKEN //
			//////////////////////////////
			$client = new Client;
			$response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
					'form_params'	=> [
						'client_id'		=> config('socialmedia.instagram.client_id'),
						'client_secret'	=> config('socialmedia.instagram.client_secret'),
						'grant_type'	=> 'authorization_code',
						'redirect_uri'	=> config('socialmedia.instagram.redirect_uri'),
						'code'			=> $code,
					]
				]);

			if ($response->getStatusCode() == 200)
			{
				$result = json_decode((string)$response->getBody());

				$account = Instagram::owner($this->me)->name($result->user->username)->firstornew([]);
				$account->owner 	= $this->me->id;
				$account->name 		= $result->user->username;
				$account->data 		= json_encode($result);
				$account->access_token = $result->access_token;
				$account->save();
				session()->flash('logout_ig', true);
				session()->flash('alert_success', 'Your have added Instagram account @' . $account->name . ' to your ' . config('app.name') . ' account');

				return redirect()->route('social_media.index');
			}
			else
			{
				session()->flash('alert_danger', 'Fail to authorize your instagram account');
				return redirect()->route('social_media.index');
			}
		}
	}
}
