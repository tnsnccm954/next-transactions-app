<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SeedByDirCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed-dir {dir : The directory to seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed database from a specific directory';

    protected $baseSeederNamespace, $baseSeederDirectory;

    public function __construct()
    {
        parent::__construct();
        $this->baseSeederDirectory = app()->databasePath('seeders');
        $this->baseSeederNamespace = 'Database\\Seeders';
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dir = $this->argument('dir');
        if (!isset($dir)) {
            $this->error('Please provide a directory to seed!');
            return 1;
        }

        $files = collect(scandir($this->baseSeederDirectory . '/' . $dir))
            ->filter(fn($file) => preg_match("/Seeder.php$/", $file) && $file !== 'DatabaseSeeder.php')
            ->map(fn($file) => [
                'file_name' => $file,
                'class_name' => $this->baseSeederNamespace . '\\' . $dir . '\\' . str_replace('.php', '', $file),
            ]);

        $seededFiles = DB::table('seeders')->get()->keyBy('file_name')->toArray();
        $seeders = $files->filter(fn($file) => !array_key_exists($file['file_name'], $seededFiles));

        if ($files->isEmpty()) {
            $this->info('No seeders found!');
        } elseif ($seeders->isEmpty()) {
            $this->info('Nothing to seed!');
        } else {
            try {
                DB::beginTransaction();

                // Run each seeder
                $seeders->each(function ($file) {
                    Artisan::call('db:seed', ['--class' => $file['class_name']]);
                    DB::table('seeders')->insert(['file_name' => $file['file_name'], 'class_name' => $file['class_name']]);
                });

                DB::commit();
                $this->info('Database seeded successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error('Seeding failed: ' . $e->getMessage());
            }
        }

        return 0; // Indicate that the command was successful
    }
}
