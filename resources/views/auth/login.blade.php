@extends('layouts.guest')

@section('title', 'Sign in')

@section('content')
<div class="w-full max-w-md card p-8">
    <div class="flex items-center gap-3 mb-6">
        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg
                     bg-brand-600 text-white font-bold">H</span>
        <div>
            <h1 class="text-lg font-semibold text-slate-800">{{ config('app.name') }}</h1>
            <p class="text-sm text-slate-500">Sign in to continue</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700 ring-1 ring-red-200">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
        @csrf
        <div>
            <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
            <input id="username" name="username" type="text" required autofocus autocomplete="username"
                   value="{{ old('username') }}" class="form-input">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                   class="form-input">
        </div>

        <button type="submit" class="btn-primary w-full">Sign in</button>
    </form>

    <p class="mt-6 text-xs text-slate-400 text-center">
        Demo account: <code>admin</code> / <code>password</code>
    </p>
</div>
@endsection
