<?php
namespace Database\Seeders;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Page;
use App\Models\tool;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->importCSV('users', new User());
        $this->importCSV('tools', new tool());
        $this->importCSV('pages', new Page());
        $this->importCSV('faqs', new Faq());
        $this->importCSV('blogs', new Blog());

    }

    private function importCSV($file, $model) {
        $csv = fopen(__DIR__."/{$file}.csv", 'r');
        $data = [];
        $headers = fgetcsv($csv, 1000, ",");

        printf("*Start import `{$file}.csv`\n");

        $i=0;
        while (($row = fgetcsv($csv, 1000000,",")) !== FALSE) {
            $data=[];
            $j=0;
            foreach ( $headers as $header) {
                $data[$header]= $row[$j];
                $j++;
            }
            $model->create($data);
            $i++;
        }

        fclose($csv);
        printf("=imported `{$file}` ({$i}) rows\n\n");
    }
}
