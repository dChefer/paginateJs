<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        
        <title>Paginação</title>

        <style>
            body{
                padding: 20px;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">Tabela de Clientes</div>
                    <div class="card-body">
                        <h5 class="card-title">
                            Exibindo {{$clients->count()}} Clientes de {{$clients->total()}} <br>
                            <b>{{$clients->firstItem()}} a {{$clients->lastItem()}}</b>
                        </h5>
                        <table class="table table-hover">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Sobrenome</th>
                                <th scope="col">Email</th>
                            </thead>
                            <tbody>
                                @foreach ($clients as $cli)
                                
                                <tr>
                                    <td>{{ $cli->id }}</td>
                                    <td>{{ $cli->name  }}</td>
                                    <td>{{ $cli->surname  }}</td>
                                    <td>{{ $cli->email  }}</td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            Páginas
                            {{$clients->links()}}
                        </div>
                    </div>
            </div>
        </div>
        <script class="{asset('js/app.js')}" type="text/javascript">
        
        </script>
    </body>
</html>
