<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="icon" type="image/png" href="{{ asset('storage/GoBlog-3.png') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">



    {{-- trix --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>



    <title>{{$title}}</title>
</head>

<body class="h-full">
<div class="min-h-full">
    <x-navbar></x-navbar>
  
    <x-header>{{$header_title}}</x-header>

    <main>
      <div class="mx-auto ">
        {{$slot}}
      </div>
    </main>

  </div>
  
</body>
<x-footer></x-footer>
</html>

