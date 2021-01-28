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
use Thunderlabid\Socialmedia\Models\Account;
use Thunderlabid\Socialmedia\Models\Instagram;
use Thunderlabid\Socialmedia\Models\Watchlist;

class SocialMediaController extends Controller
{
	protected $view_dir = 'social_medias.accounts.';

	function __construct()
	{
		parent::__construct();

		$this->layout->submenu = [
			// 'Company'	=> route('social_medias.index'),
		];

		view()->share('active_menu', 'social_media');
	}

	public function index() 
	{
		//////////////
		// Get Data //
		//////////////
		$data = Account::owner(Auth::user()->id)
						->name(request()->input('name'))
						->orderBy('name')
						->get();
		view()->share('data', $data);

		//////////
		// View //
		//////////
		$this->layout->page = view($this->view_dir . 'index');
		return $this->layout;
	}

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
}
