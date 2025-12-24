@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white border rounded-xl p-6">
  <h1 class="text-2xl font-bold mb-4">Admin Login</h1>

  @if(session('ok'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
      {{ session('ok') }}
    </div>
  @endif

  @if($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.login.post') }}">
    @csrf

    <label class="block mb-2">Email</label>
    <input name="email" type="email" value="{{ old('email') }}"
           class="w-full border rounded px-3 py-2 mb-4" required>

    <label class="block mb-2">Password</label>
    <input name="password" type="password"
           class="w-full border rounded px-3 py-2 mb-4" required>

    <button class="w-full px-4 py-2 rounded bg-gray-900 text-white">
      Login
    </button>
  </form>
</div>
@endsection
