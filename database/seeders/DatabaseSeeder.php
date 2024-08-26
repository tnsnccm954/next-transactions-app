<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema as Schema;

class DatabaseSeeder extends Seeder
{
    protected $seederPath;
    protected $seederNamespace;

     public function __construct() {
        $this->seederPath = app()->databasePath('seeders');
        $this->seederNamespace = 'Database\\Seeders';
    }
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(!Schema::hasTable('seeders')){
            Schema::create('seeders', function($table){
                $table->id();
                $table->string('file_name');
                $table->string('class_name');
                $table->timestamps();
            });
        }

        $files = collect(scandir($this->seederPath))->filter(fn($file) => preg_match("/Seeder.php$/", $file) && $file !== 'DatabaseSeeder.php')
        ->map(fn($file) => [
            'file_name' => $file,
            'class_name' => $this->seederNamespace . '\\' . str_replace('.php', '', $file)
        ]);

        $seededFiles = \DB::table('seeders')->get()->keyBy('file_name')->toArray();
        $seeders = $files->filter(fn($file) => !key_exists($file['file_name'], $seededFiles));

        if ($files->isEmpty()) {
            $this->command->info('No seeders found!');
        } else if ($seeders->isEmpty()) {
            $this->command->info('Nothing to seed!');
        } else if($seeders->isNotEmpty()){
            try {
                \DB::beginTransaction();
                $this->call($seeders->map(fn($file) => $file['class_name'])->toArray());
                $seeders->each(fn($file) => \DB::table('seeders')->insert($file));
                \DB::commit();
                $this->command->info('Database seeded!');
            } catch (\Exception $e) {
                \DB::rollBack();
                $this->command->error('Seed failed!');
                print($e->getMessage());
            }
        }
    }
}
