<?php

namespace App\Http\Service\UI;

use Illuminate\Support\Str;
use Exception, Validator;
use Carbon\Carbon;

use Illuminate\Http\UploadedFile;

class UploadedGambar
{
	protected $file;

	/**
	 * Create a new job instance.
	 *
	 * @param  $file
	 * @return void
	 */
	public function __construct($pre, $file)
	{
		$this->file     		= $file;
		$this->pre     			= $pre;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		try
		{
			$fn 		= $this->pre.'-'.Str::slug(microtime()).'.'.$this->file->getClientOriginalExtension(); 
			$dp 		= date('Y/m/d');

			if (!file_exists(public_path().'/'.$dp)) 
			{
				mkdir(public_path().'/'.$dp, 0777, true);
			}

			$this->file->move(public_path().'/'.$dp, $fn); 

			return ['url' => url('/'.$dp.'/'.$fn)];
		}
		catch(Exception $e)
		{
			throw $e;
		}
	}
}