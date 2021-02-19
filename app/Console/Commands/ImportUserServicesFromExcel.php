<?php

namespace SavyCon\Console\Commands;

use Illuminate\Console\Command;

use SavyCon\Imports\UserServicesImport;
use SavyCon\Models\User;
use SavyCon\Models\UserService;

class ImportUserServicesFromExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'import:services {file? : Enter a file name}';
    protected $signature = 'import:services';

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
        // $file = $this->argument('file');

        $this->output->title('Starting import...');

        (new UserServicesImport(33))->withOutput($this->output)->import(public_path('states/state_Missing.csv'));

        $this->output->success('Import successful');
    }
}
