<?php

namespace Jay\Paypal\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'paypal:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is generate paypal model and paypal table in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->info('first set up running');

        $this->call("key:generate");
        $this->info('key generated');

        $this->call("migrate");
        $this->info('migrate table added');

        $this->call('migrate', array('--package' => 'jay/paypal'));
        $this->info('paypal migrated');

//        $this->call('config:publish', array('package' => 'jay/paypal'));
//        $this->info('paypal config publish');
        
        
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
//            array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
//            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}
