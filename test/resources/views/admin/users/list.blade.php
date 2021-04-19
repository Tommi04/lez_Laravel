@extends('layouts.admin-movie')

@section('content')
    <div class="container">

        @include('components.messages')

    {{-- SPOSTATI in components.messages --}}
        {{-- qui dentro ho appena preso la variabile error che deriva da php, dalla session --}}
        {{-- @if( session( 'success' )) --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-xs-12"> --}}
                    {{-- <div class="alert alert-success alert-dismissible fade show" role="alert"> --}}
                      {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
                        {{-- <span aria-hidden="true">&times;</span> --}}
                        {{-- {{ session('success') }}  --}}
                        {{-- usando la sintassi blade, se avessimo qualcosa in html, blade ci fa l'escape dei caratteri.  --}}
                        {{-- Per non farlo forzare dobbiamo mettere questo qua sotto --}}
                        {{-- {{ !! qualcosa in html qua dentro !!}} --}}
                      {{-- </button> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- @endif --}}

    {{-- qui dentro ho appena preso la variabile error che deriva da php, dalla session --}}
    {{-- @if( session( 'error' )) --}}
            {{-- prendere l'errore dalla sessione --}}
        {{-- @php  --}}
            {{-- $creation_errors = session('error') --}}
        {{-- @endphp --}}
        {{-- <div class="row"> --}}
            {{-- <div class="col-xs-12"> --}}
                {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert"> --}}
                  {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
                    {{-- <span aria-hidden="true">&times;</span> --}}
                    {{-- <strong>{{ $creattion_error['error_message'] }}</strong> --}}
                    {{-- <p> --}}
                        {{-- {{ $creation_errors['details'] }} --}}
                    {{-- </p> --}}
                    {{-- prendere l'errore dalla sessione --}}
                    {{-- {{ session('error') }}  --}}
                    {{-- usando la sintassi blade, se avessimo qualcosa in html, blade ci fa l'escape dei caratteri.  --}}
                    {{-- Per non farlo forzare dobbiamo mettere questo qua sotto --}}
                    {{-- {{ !! qualcosa in html qua dentro !!}} --}}
                  {{-- </button> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- @endif --}}

        <div class="row">
            <div class="col-xs-12" style="width: 100%;">
                <div class="card">
                    <div class="card-header">
                      Lista utenti
                    </div>
                    <div class="card-body">

                        <p class="card-text">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                {{-- se non metto data-toggle="tab" mi porta nell'href, li userò per entrare nella pagina usando i parametri del querystring --}}
                                {{-- <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="{{ route('admin.adminusers.index',['tab' => 1]) }}" role="tab">Active</a> --}}
                                <a class="nav-item nav-link @if($current_tab == 1) active @endif" id="nav-home-tab" href="{{ route('admin.adminusers.index',['tab' => 1]) }}" role="tab">Active</a>
                                <a class="nav-item nav-link @if($current_tab == 2) active @endif" id="nav-profile-tab" href="{{ route('admin.adminusers.index',['tab' => 2]) }}" role="tab">Non active</a>
                                </div>
                            </nav>
                                {{-- se abbiamo un utente cancellato metti la classe --}}
                                {{-- $item_class = $user->trashed() ? 'list-group-item-danger' : ''; --}}
                            @php
                                $item_class ='list-group-item-danger';
                            @endphp 
                            {{-- questo è un ciclo proprio di laravel, al posto del ciclo sotto foreach --}}

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade @if($current_tab == 1) show active @endif" id="tab-active" role="tabpanel">
                                    <div class="row" style="padding-top:25px; padding-bottom:25px; border-left: 1px solid #ddd; border-right: 1px solid #ddd">
                                        <div class="col-xs-6">
                                            <a class="btn btn-primary" href="{{ route('admin.adminusers.index',['tab' => $current_tab, 'page' => $users['active']->currentPage(), 'sort' => 'asc']) }}">
                                                <span class="fas fa-sort-up"></span>
                                            </a>
                                            <a class="btn btn-primary" href="{{ route('admin.adminusers.index',['tab' => $current_tab, 'page' => $users['active']->currentPage(), 'sort' => 'desc']) }}">
                                                <span class="fas fa-sort-down"></span>
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            {{ $users['active']->currentPage() . ' / ' . $users['active']->lastPage() }}
                                        </div>
                                    </div>
                                    <ul class="list-group">
                                       @forelse($users['active'] as $u => $user)
                                           {{-- per prendere il component --}}
                                           @include('admin.users.components.users-list-item', ['user' => $user, 'item_class' => $item_class])
                                       @empty
                                           @include('admin.users.components.users-list-item', ['user' => null, 'item_class' => null])
                                       @endforelse
                                    </ul>
                                    <div>
                                        {{-- con il paginate() in AdminUsersController@index, posso creare le pagine funzionanti
                                        con questo semplice comando --}}
                                        {{-- appends() per passare una serie di parametri dopo il querystring --}}
                                        {{ $users['active']->appends(['tab' => 1])->links('admin.users.components.users-list-paginator') }}
                                    </div>
                                </div>
                                <div class="tab-pane fade  @if($current_tab == 2) show active @endif" id="tab-non-active" role="tabpanel">
                                    
                                    <ul class="list-group">
                                        @forelse($users['not_active'] as $u => $user)
                                            {{-- per prendere il component --}}
                                            @include('admin.users.components.users-list-item', ['user' => $user, 'item_class' => $item_class])
                                        @empty
                                            @include('admin.users.components.users-list-item', ['user' => null, 'item_class' => null])
                                        @endforelse
                                    </ul>
                                    <div>
                                        {{-- con il paginate() in AdminUsersController@index, posso creare le pagine funzionanti
                                        con questo semplice comando che creerà il codice html preso di default da 
                                            vendor\laravel\framework\src\Illuminate\Pagination\resources\views
                                        oppure dalla cartella che mettiano dentro links()--}}
                                        {{ $users['not_active']->appends(['tab' => 2])->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        <p>
                    
                    {{-- 
                        @if (count($movies) > 0)
                        <p class="card-text">
                          <ul class="list-group">
                            @foreach ($movies as $movie_name)
                                <li class="list-group-item">
                                    {{ $movie_name }}
                                </li>
                            @endforeach
                            </ul>
                        </p>
                        @else
                            <div class="alert alert-warning" role="alert">
                              Spiacente non ci sono film nella base dati
                            </div>
                            <a href="#" class="btn btn-primary">Clicca qui per aggiungere il tuo primo film</a>
                        @endif
                    --}}
                      <a href="{{ url('/') }}" class="btn btn-danger margin-auto">Indietro</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection