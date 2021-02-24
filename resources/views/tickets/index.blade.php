@extends('layouts.app')
@section('content')
    @if(Auth::user()->role === 'ADMIN')
        @if(session('message'))
            <script> window.flashMessage = "{{ session('message') ?? '' }}"</script>
            <snackbar-component></snackbar-component>
        @endif
        <div class="container">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Categoría</th>
                    <th scope="col">Título</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Última actualización</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="link">
                            <td>{{$ticket->name}}</td>
                            <td>
                                <a href="{{route('ticket.show', $ticket->uid)}}">
                                    <strong>
                                        #{{$ticket->uid}} - {{$ticket->title}}
                                    </strong>
                                </a>
                            </td>
                            <td>
                                <div class="status {{$ticket->status}}">
                                    {{$ticket->status}}
                                </div>
                            </td>
                            <td>
                                {{formatDateToEsp($ticket->updated_at)}}
                            </td>
                            <td>
                                <form action="{{ route('ticket.close', $ticket->uid) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">
                                        Cerrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">{{ $tickets->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        @if(session('message'))
            <script> window.flashMessage = "{{ session('message') ?? '' }}"</script>
            <snackbar-component></snackbar-component>
        @endif
        <div class="container">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Categoría</th>
                    <th scope="col">Título</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Última actualización</th>
                </tr>
                </thead>
                <tbody>
                @foreach($myTickets as $ticket)
                    <tr class="link">
                        <td>{{$ticket->name}}</td>
                        <td>
                            <a href="{{route('ticket.show', $ticket->uid)}}">
                                <strong>
                                    #{{$ticket->uid}} - {{$ticket->title}}
                                </strong>
                            </a>
                        </td>
                        <td>
                            <div class="status {{$ticket->status}}">
                                {{$ticket->status}}
                            </div>
                        </td>
                        <td>{{formatDateToEsp($ticket->updated_at)}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">{{ $myTickets->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif
@endsection
