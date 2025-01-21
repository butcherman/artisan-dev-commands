<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanLogs extends Command
{
    /**
     * @var string
     */
    protected $signature   = 'log:clean';

    /**
     * @var string
     */
    protected $description = 'Empty the active log file without deleting it.';

    /**
     * Clear the active log file without deleting it.
     */
    public function handle()
    {
        /**
         * Current Log Channel logs are being saved to
         */
        $channel = config('logging.default');

        //  If the default channel is 'stack' we must clear all in the stack
        if ($channel === 'stack') {
            $stackArr = config('logging.channels.stack.channels');
            foreach ($stackArr as $chan) {
                $path = $this->getChanelPath($chan);
                $file = $this->getLogFile($path);
                $this->cleanLogFile($file);
            }
        } else {
            $path    = $this->getChanelPath($channel);
            $file    = $this->getLogFile($path);

            if ($file) {
                $this->cleanLogFile($file);
            }
        }

        return 0;
    }

    /**
     * Get the path the log file is being stored in
     */
    private function getChanelPath($channel)
    {
        return config('logging.channels.' . $channel . '.path');
    }

    /**
     * Get the full log file
     */
    private function getLogFile($path)
    {
        if (file_exists($path)) {
            return $path;
        } else {
            $fileParts = pathinfo($path);
            $timeStamp = Carbon::now()->format('Y-m-d');
            $logFile   = $fileParts['dirname'] .
                DIRECTORY_SEPARATOR .
                $fileParts['filename'] .
                '-' .
                $timeStamp .
                '.' .
                $fileParts['extension'];

            if (file_exists($logFile)) {
                return $logFile;
            }

            return $this->returnError($logFile);
        }
    }

    /**
     * Exception for when the log file is not found
     */
    private function returnError($logFile)
    {
        $this->error('Well, this is embarrassing...');
        $this->error('It seems I cannot find your log file');
        $this->newLine();
        $this->error('I was looking for ' . $logFile);
        $this->error('It either has not been created yet, or there was a problem with my algorithm');

        return false;
    }

    /**
     * Empty the log file into a single '' blank entry.
     */
    private function cleanLogFile($logFile)
    {
        //  Verify the file exists before trying to clear it
        if (file_exists($logFile)) {
            file_put_contents($logFile, '');
            $this->info('Log File Emptied');
        } else {
            $this->returnError($logFile);
        }

        $this->line('');
    }
}
