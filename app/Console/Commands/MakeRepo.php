<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new Repository class.';

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->files = $filesystem;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $fileContents = <<<EOT
<?php

    namespace App\Repositories;

    class {$name}Repository
    {

    }

EOT;


        $written = \Storage::put('repositories/'.$name.'Repository.php', $fileContents);
        if($written)
        {
            $this->info('Created new Repo '.$name.'Repository.php in App\Repositories.');
        } else {
            $this->info('Something went wrong');
        }
    }
}
