<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PurgeLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete all log files in the logs storage location';

    //  Supported log channels
    protected $supported = ['daily', 'single'];
    //  Extension name of the log files (to be sure only logs are deleted)
    protected $logExt = '.log';

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
    public function handle()
    {
        $channel = config('logging.default');

        //  Determine if the daily or single log channel is being used
        switch ($channel) {
            case 'daily':
                $path = config('logging.channels.daily.path');
                $this->wipeLogs($path);
                break;
            case 'single':
                $path = config('logging.channels.single.path');
                $this->wipeLogs($path);
                break;
            default:
                $this->line('Sorry, but this command only support Single and Daily log channels.');
        }
    }

    private function wipeLogs($path)
    {
        $fileParts = pathinfo($path);
        $fullPath = $fileParts['dirname'].DIRECTORY_SEPARATOR;
        array_map('unlink', glob($fullPath.'*'.$this->logExt));

        $this->line('All log files removed');
    }
}
