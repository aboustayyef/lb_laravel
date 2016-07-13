<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CleanupExitLog extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseBlogs:cleanupExitLog';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove items from Exit log that are older than one month';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$oneMonthAgo = (new \Carbon\Carbon)->subMonth(1)->getTimeStamp();
		$this->info('Deleting Exit Logs that are more than one month old');
		ExitLog::where('exit_time','<', $oneMonthAgo )->delete();
		$this->info('Done');
	}

}
