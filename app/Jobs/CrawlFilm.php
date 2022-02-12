<?php

namespace App\Jobs;

use App\Models\Film;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CrawlFilm implements ShouldQueue
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

        $film = Film::where('title', $data['title'])->first();

        if ($film === null)
        {
            $film = \App\Models\Film::factory()->create([
                'title' => $data['title'],
                'episode_id' => $data['episode_id'],
                'opening_crawl' => $data['opening_crawl'],
                'director' => $data['director'],
                'producer' => $data['producer'],
                'release_date' => $data['release_date'],
                'created' => Carbon::createFromFormat('Y-m-d\TH:i:s+', $data['created']),
                'edited' => Carbon::createFromFormat('Y-m-d\TH:i:s+', $data['edited'])
            ]);
        }

        $film->people()->save($this->person);
    }
}
