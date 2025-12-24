<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>{{ config('app.name', 'Mini Shop') }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
  <header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
      <a href="{{ route('store.index') }}" class="font-bold text-xl">Mini Shop</a>
      <a href="{{ route('cart.index') }}" class="px-3 py-2 rounded bg-gray-900 text-white">
        Cart ({{ count(session('cart', [])) }})
      </a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-6">
    @if(session('ok'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('ok') }}</div>
    @endif
    @yield('content')
  </main>

  <footer class="py-8 text-center text-sm text-gray-500">
    © {{ date('Y') }} Mini Shop
  </footer>
</body>
</html>
