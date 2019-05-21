<?php

namespace AutoGenerator\Commands;


use AutoGenerator\EnvBuilder;
use Illuminate\Console\Command;

class EnvBuilderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:build {feature} {--scope=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    protected $builder;

    public function __construct(EnvBuilder $builder)
    {
        $this->builder = $builder;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $feature = $this->argument('feature');
        $scope = $this->option('scope');
        $this->line('auto generate env: '. $this->builder->build($feature, $scope));
    }
}