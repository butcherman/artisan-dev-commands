<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\Command;

class MakeTrait extends Command
{
    protected $signature   = 'make:trait
                            {name : Name of the trait to be created}';
    protected $description = 'Create a new Trait Class';
    protected $basePath;

    //  Create the new Page
    public function handle()
    {
        $this->basePath = app_path('Traits');

        //  Get the name and path the Page will be placed
        $nameArr   = explode('/', $this->argument('name'));
        $path      = $this->basePath.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameArr).'.php';
        $pathInfo  = pathinfo($path);
        $traitName = end($nameArr);

        //  Determine if the /app/Traits directory exists - if not, create it
        if(!is_dir($this->basePath))
        {
            mkdir($this->basePath);
        }

        //  If the page already exists, we will trigger an error
        if(file_exists($path))
        {
            $this->error('This page already exists');
            return 0;
        }

        if(!is_dir($pathInfo['dirname']))
        {
            mkdir($pathInfo['dirname']);
        }

        $this->generateStub($path, $traitName);
        $this->info('New page created successfully');

        return 0;
    }

    protected function getStubVariables($traitName)
    {
        return [
            'TRAIT_NAME' => ucwords($traitName),
        ];
    }

    //  Get the stub file for the generator.
    protected function getStub()
    {
        return  base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/TraitStub.stub');
    }

    //  Create the stub and write it to the file system
    protected function generateStub($path, $traitName)
    {
        $contents = file_get_contents($this->getStub());
        $variables = $this->getStubVariables($traitName);

        foreach($variables as $search => $replace)
        {
            $contents = str_replace('$'.$search, $replace, $contents);
        }

        file_put_contents($path, $contents);
    }
}
