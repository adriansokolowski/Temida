<div class="lg:w-2/5 md:w-1/2 w-2/3">
    <h2 class="text-lg font-bold text-center">Film</h2>
    <div class="bg-white p-10 rounded-lg shadow-lg min-w-full">
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Title</span> {{ $film->title }}
        </p>
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Opening crawl</span> {{ $film->opening_crawl }}
        </p>
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Director</span> {{ $film->director }}
        </p>
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Producer</span> {{ $film->producer }}
        </p>
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Release date</span> {{ $film->release_date }}
        </p>
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Created</span> {{ $film->created }}
        </p>
        <p>
            <span class="text-gray-800 font-bold my-3 text-md">Edited</span> {{ $film->edited }}
        </p>
    </div>
    <h2 class="text-lg font-bold text-center">People</h2>
    <div class="bg-white p-10 rounded-lg shadow-lg min-w-full">
        @foreach ($film->people as $value)
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Name</span> {{ $value->name }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Height</span> {{ $value->height }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Mass</span> {{ $value->mass }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">hair_color</span> {{ $value->hair_color }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Skin color</span> {{ $value->skin_color }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Eye color</span> {{ $value->eye_color }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Birth year</span> {{ $value->birth_year }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Gender</span> {{ $value->gender }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Created</span> {{ $value->created }}
            </p>
            <p>
                <span class="text-gray-800 font-bold my-3 text-md">Edited</span> {{ $value->edited }}
            </p>
            <hr>
        @endforeach
    </div>

</div>
