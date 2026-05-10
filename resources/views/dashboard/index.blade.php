@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <header>
        <h1 class="text-2xl font-semibold text-slate-800 dark:text-slate-100">Dashboard</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Welcome back{{ isset($authUser) ? ', ' . $authUser->name : '' }}.
        </p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([
            ['label' => 'Employees',      'value' => '—'],
            ['label' => 'On leave today', 'value' => '—'],
            ['label' => 'Open positions', 'value' => '—'],
            ['label' => 'Pending tasks',  'value' => '—'],
        ] as $stat)
            <div class="card p-5">
                <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                    {{ $stat['label'] }}
                </p>
                <p class="mt-2 text-2xl font-semibold text-slate-800 dark:text-slate-100">
                    {{ $stat['value'] }}
                </p>
            </div>
        @endforeach
    </div>

    <div class="card p-6">
        <h2 class="text-base font-semibold text-slate-800 dark:text-slate-100 mb-2">
            HRMS scaffolding ready
        </h2>
        <p class="text-sm text-slate-600 dark:text-slate-300">
            This is the bare layout. Modules (Employees, Attendance, Leave, Payroll) plug
            into the sidebar and follow the same Repository → Service → Controller flow.
        </p>
    </div>
</div>
@endsection
