<?php

namespace Database\Seeders;

use App\Jobs\CrawlFilm;
use App\Jobs\CrawlPlanet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $output = new ConsoleOutput();
        $response = Http::get('https://swapi.dev/api/people');
        $count = $response->json()['count'];
        $keyX = 1;
        $progressBar = new ProgressBar($output, $count);

        $output->write('<fg=black;bg=cyan>Gathering data from SWAPI started.</>', true);

        $progressBar->start();

        do {
            foreach ($response->json()['results'] as $value){
                $progressBar->advance();

                $keyX++;

                $person = \App\Models\Person::factory()->create([
                    'name' => $value['name'],
                    'height' => $value['height'],
                    'mass' => $value['mass'],
                    'hair_color' => $value['hair_color'],
                    'skin_color' => $value['skin_color'],
                    'eye_color' => $value['eye_color'],
                    'birth_year' => $value['birth_year'],
                    'gender' => $value['gender'],
                    'created' => Carbon::createFromFormat('Y-m-d\TH:i:s+', $value['created']),
                    'edited' => Carbon::createFromFormat('Y-m-d\TH:i:s+', $value['edited'])
                ]);

                CrawlPlanet::dispatch($value['homeworld'], $person);

                foreach ($value['films'] as $value)
                {
                    CrawlFilm::dispatch($value, $person);
                }

            }
            if ($count > $this->getPeopleCount()){
                $response = Http::get($response->json()['next']);
            }
        }
        while ($count != $this->getPeopleCount());

        $progressBar->finish();

        $output->write(' Finished', true);
    }

    private function getPeopleCount()
    {
        return \App\Models\Person::count();
    }
}
