<?php

namespace SavyCon\Console\Commands;

use Illuminate\Console\Command;

use SavyCon\Imports\UserServicesImport;

class ImportUserServicesFromExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:services {file? : Enter a file name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel Excel Importer (User Services)';

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
        $file = ucwords($this->argument('file'));
        if ($file === 'akwa-ibom') {
            $file = 'Akwa-Ibom';
        }
        if ($file === 'cross-river') {
            $file = 'Cross-River';
        }

        $state = $file;

        $this->output->title('Starting import...');
        
        (new UserServicesImport($state))->withOutput($this->output)->import(public_path('states/state_'.$file.'.csv'));
        
        $this->output->success('Import successful');
    }
}
