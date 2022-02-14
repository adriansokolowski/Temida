<?php

namespace App\Jobs;

use App\Models\Planet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CrawlPlanet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $person;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $person)
    {
        $this->url = $url;
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = Http::get($this->url);

        $planet = Planet::where('name', $data['name'])->first();

        if ($planet === null)
        {
            $planet = \App\Models\Planet::factory()->create([
                'name' => $data['name'],
                'rotation_period' => $data['rotation_period'],
                'orbital_period' => $data['orbital_period'],
                'diameter' => $data['diameter'],
                'climate' => $data['climate'],
                'gravity' => $data['gravity'],
                'terrain' => $data['terrain'],
                'surface_water' => $data['surface_water'],
                'population' => $data['population'],
                'created' => Carbon::createFromFormat('Y-m-d\TH:i:s+', $data['created']),
                'edited' => Carbon::createFromFormat('Y-m-d\TH:i:s+', $data['edited'])
            ]);
        }

        $planet->people()->save($this->person);
    }
}
