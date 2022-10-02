<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanLogs extends Command
{
    protected $signature   = 'log:clean';
    protected $description = 'Empty the current active log file';

    public function handle()
    {
        $channel = config('logging.default');

        //  If the default channel is set to 'stack' then we must clear all in the stack
        if($channel === 'stack')
        {
            $stackArr = config('logging.channels.stack.channels');
            foreach($stackArr as $chan)
            {
                $path = $this->getChanelPath($chan);
                $file = $this->getLogFile($path);
                $this->cleanLogFile($file);
            }
        }
        else
        {
            $path    = $this->getChanelPath($channel);
            $file    = $this->getLogFile($path);

            if($file)
            {
                $this->cleanLogFile($file);
            }
        }

        return 0;
    }

    private function getChanelPath($channel)
    {
        return config('logging.channels.'.$channel.'.path');
    }

    private function getLogFile($path)
    {
        if(file_exists($path))
        {
            return $path;
        }
        else
        {
            $fileParts = pathinfo($path);
            $timeStamp = Carbon::now()->format('Y-m-d');
            $logFile   = $fileParts['dirname'].DIRECTORY_SEPARATOR.$fileParts['filename'].'-'.$timeStamp.'.'.$fileParts['extension'];

            if(file_exists($logFile))
            {
                return $logFile;
            }

            return $this->returnError($logFile);
        }
    }

    private function returnError($logFile)
    {
        $this->error('Well, this is embarrassing...');
        $this->error('It seems I cannot find your log file');
        $this->newLine();
        $this->error('I was looking for '.$logFile);
        $this->error('It either has not been created yet, or there was a problem with my algorithm');

        return false;
    }

    private function cleanLogFile($logFile)
    {
        //  Verify the file exists before trying to clear it
        if(file_exists($logFile)) {
            file_put_contents($logFile, '');
            $this->info('Log File Emptied');
        } else {
            $this->returnError($logFile);
        }

        $this->line('');
    }
}
