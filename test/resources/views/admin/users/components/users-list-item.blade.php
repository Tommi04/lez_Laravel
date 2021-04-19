@if ($user)
    @php
        $class_delete = '';
    @endphp
    @if($user->trashed())
        @php
            $class_delete = $item_class;
        @endphp
    @endif
    <li class="list-group-item {{ $class_delete }}">
        <div class="row">
            <div class="d-flex col-xs-12 col-md-8">
                {{ $user->name }}
                <br>
                {{ $user->email }}
            </div>
            <div class="d-flex justify-content-end col-xs-12 col-md-4">
                <div class="d-inline">
                    <a href="{{ route('admin.adminusers.show', ['user' => $user->id]) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a href="{{ route('admin.adminusers.edit', ['user' => $user->id]) }}" class="btn btn-success">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    @if ($user->trashed())
                        <form method="post" action="{{ route('admin.adminusers.destroy', ['user' => $user->id]) }}" class="d-inline-block">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" name="delete_action" value="d">
                            <span class="fas fa-trash-alt"></span>
                            </button>
                        </form>
                    @else
                        {{-- direttiva per sapere se la policy ci permetti di cancellare l'utente --}}
                        @can('delete', $user)
                            <form method="post" action="{{ route('admin.adminusers.destroy', ['user' => $user->id]) }}" class="d-inline-block" >
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" name="delete_action" value="t">
                                    <span class="fas fa-times-circle"></span>
                                </button>
                            </form>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </li>
@else
    <li class="list-group-item alert alert-warning" role="alert">
        Spiacente non ci sono utenti attivi
    </li>
@endif