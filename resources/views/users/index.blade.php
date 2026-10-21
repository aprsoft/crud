@extends('layouts.app')

@section('title', 'Usuarios | ' . config('app.name', 'Laravel'))

@section('content')
    <section aria-labelledby="users-heading">
        <div class="mb-6">
            <h1 id="users-heading" class="text-2xl font-bold tracking-tight text-slate-900">
                Listado de usuarios
            </h1>
            <p class="mt-2 text-sm text-slate-600">
                Consulta y busca los usuarios registrados.
            </p>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">
            <livewire:user-table />
        </div>
    </section>
@endsection
