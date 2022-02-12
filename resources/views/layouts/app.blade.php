<head>
    @livewireStyles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
</head>
<body>
    <div class="bg-cyan-100 flex justify-center items-center">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
