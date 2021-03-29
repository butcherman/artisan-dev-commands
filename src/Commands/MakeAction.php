<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeAction extends GeneratorCommand
{
    protected $name = 'make:action';
    protected $description = 'Create a new Action Class';
    protected $type = 'Action';
    protected $actionClass;
    // protected $model;

    //  Create the new Action
    public function fire(){

        $this->setActionClass();
        $path = $this->getPath($this->actionClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($this->domainClass));

        $this->info($this->type.' created successfully.');
    }

    //  Set Domain class name
    private function setActionClass()
    {
        $name = ucwords(strtolower($this->argument('name')));
        $this->actionClass = $this->parseName($name);

        return $this;
    }

    //  Replace the class name for the given stub.
    protected function replaceClass($stub, $name)
    {
        if(!$this->argument('name')){
            throw new InvalidArgumentException("Missing required argument model name");
        }

        $stub = parent::replaceClass($stub, $name);

        return $stub;
    }

    //  Get the stub file for the generator.
    protected function getStub()
    {
        return  base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/ActionStub.stub');
    }

    //  Get the default namespace for the class
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Actions';
    }

    //  Get the console command arguments
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }
}
