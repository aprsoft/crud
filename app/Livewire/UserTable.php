<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

class UserTable extends PowerGridComponent
{
    public string $tableName = 'users-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage(10, [10, 25, 50])
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        // Protege también las solicitudes de actualización de Livewire.
        abort_unless(Auth::check(), 403);

        return User::query()
            ->select(['id', 'name', 'email', 'created_at']);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('created_at')
            ->add(
                'created_at_formatted',
                fn (User $user): string => $user->created_at?->format('d/m/Y H:i') ?? '—'
            );
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Nombre', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Correo electrónico', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Fecha de registro', 'created_at_formatted', 'created_at')
                ->sortable(),
        ];
    }
}
