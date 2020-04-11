<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\Command;

class PurgeLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a separate class in a folder called actions for separating business logic from Laravel logic';

    protected $path, $lines;
    protected $actionArr = [];
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = 'App'.DIRECTORY_SEPARATOR.'Actions'.DIRECTORY_SEPARATOR;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setActionArr($this->argument('location'));
        $this->setActionLines();
        $this->writeActionFile();
    }

    private function setActionArr($arg)
    {
        $arr = explode(DIRECTORY_SEPARATOR, $arg);

        if(count($arr) > 1)
        {
            $this->actionArr['file'] = last($arr);
            array_pop($arr);

            $folder = '';
            foreach($arr as $key => $a)
            {
                $folder .= $a;
                if(++$key != count($arr))
                {
                    $folder .= DIRECTORY_SEPARATOR;
                }
            }

            $this->actionArr['folder'] = $folder;
        }
        else
        {
            $this->actionArr['file'] = $arr[0];
            $this->actionArr['folder'] = null;
        }
    }

    private function setActionLines()
    {
        $this->lines[] = "<?php\n";
        $this->lines[] = "\n";
        $this->lines[] = 'namespace '.$this->path.$this->actionArr['folder'].";\n";
        $this->lines[] = "\n";
        $this->lines[] = 'class '.$this->actionArr['file']."\n";
        $this->lines[] = "{\n";
        $this->lines[] = "\n";
        $this->lines[] = "     public function __construct()\n";
        $this->lines[] = "     {\n";
        $this->lines[] = "          //\n";
        $this->lines[] = "     }\n";
        $this->lines[] = "\n";
        $this->lines[] = "\n";
        $this->lines[] = "\n";
        $this->lines[] = "\n";
        $this->lines[] = "\n";
        $this->lines[] = "}\n";
    }

    private function writeActionFile()
    {
        $filePath = base_path() . DIRECTORY_SEPARATOR . $this->path . $this->actionArr['folder'] . DIRECTORY_SEPARATOR;
        if (!is_dir($filePath)) {
            mkdir($filePath, 077, true);
        }

        $file = fopen($filePath.$this->actionArr['file'].'.php', 'a');
        foreach($this->lines as $line)
        {
            fwrite($file, $line);
        }
        fclose($file);
    }
}
