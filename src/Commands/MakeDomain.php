<?php

namespace Butcherman\ArtisanDevCommands\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeDomain extends GeneratorCommand
{
    protected $name = 'make:domain';
    protected $description = 'Create a new Domain Class';
    protected $type = 'Domain';
    protected $domainClass;
    // protected $model;

    //  Create the new Domain
    public function fire(){

        $this->setDomainClass();
        $path = $this->getPath($this->domainClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($this->domainClass));

        $this->info($this->type.' created successfully.');
    }

    //  Set Domain class name
    private function setDomainClass()
    {
        $name = ucwords(strtolower($this->argument('name')));
        $this->domainClass = $this->parseName($name);

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
        return  base_path('vendor/butcherman/artisan-dev-commands/src/Stubs/DomainStub.stub');
    }
    //  Get the default namespace for the class
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domains';
    }

    //  Get the console command arguments
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }
}
