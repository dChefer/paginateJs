<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Paginação</title>

    <style>
        body {
            padding: 20px;
        }

    </style>

</head>

<body>
    <div class="container">
        <div class="card text-center">
            <div class="card-header">Tabela de Clientes</div>
            <div class="card-body">
                <h5 class="card-title" id="cardTitle">
                </h5>
                <table class="table table-hover" id="clientsTable">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">Email</th>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Dalmar</td>
                            <td>Guimarães</td>
                            <td>dalmar@guimaraes.com</td>
                        </tr>

                    </tbody>
                </table>
                <div class="card-footer">
                    <nav id="paginator">
                        <ul class="pagination justify-content-center">
                          {{-- <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active" aria-current="page">
                            <span class="page-link">
                              2
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                          </li> --}}
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <script type="text/javascript">


        function getItemNext(data, i){
            i = data.current_page + 1;
            if(data.last_page == data.current_page)
                line = '<li class="page-item disabled">'; 
            else
                line = '<li class="page-item">';
                line += '<a class="page-link" '+' page="' + i + '" href="javascript:void(0)">Próximo</a></li>';
            return line;
        }

        function getItemPrevious(data, i){
            i = data.current_page - 1;
            if(1 == data.current_page)
                line = '<li class="page-item disabled">'; 
            else
                line = '<li class="page-item">';
                line += '<a class="page-link" '+' page="' + i + '" href="javascript:void(0)">Anterior</a></li>';
            return line;
        }

        function getItem(data, i){
            if(i == data.current_page)
                line = '<li class="page-item active">'; 
            else
                line = '<li class="page-item">';
                line += '<a class="page-link" '+' page="' + i + '" href="javascript:void(0)">'+ i +'</a></li>';
            return line;
        }
        
        function mountPaginator(data){
            $("#paginator>ul>li").remove();
            $("#paginator>ul").append(getItemPrevious(data));

            maxPag=10;
            if(data.current_page - maxPag/2 <= 1)
            {
                start = 1;
            }
            else if(data.last_page - data.current_page < maxPag)
            {
                start = data.last_page - maxPag + 1;
            }
            else
            {
                start = data.current_page - maxPag/2;
            }
           
            end = start + maxPag - 1;

            for(i=start; i<=end; i++){
                line = getItem(data, i);
                $("#paginator>ul").append(line);
            }
            $("#paginator>ul").append(getItemNext(data));

        }

        function mountLine(client){
            return '<tr>'+
                '<td>' +client.id+'</td>'+
                '<td>' +client.name+'</td>'+
                '<td>' +client.surname+'</td>'+
                '<td>' +client.email+'</td>'+
            '</tr>';
        }
        
        function mountTable(data){
            $("#clientsTable>tbody>tr").remove();
            for(i=0; i<data.data.length; i++){
                line = mountLine(data.data[i]);
                $("#clientsTable>tbody").append(line);
            }
        }

        function clientLoading(page) {
            $.get('/json', {page: page},
                function (resp) {
                    console.log(resp);
                    mountTable(resp);
                    mountPaginator(resp);
                    $("#paginator>ul>li>a").click(function(){
                        clientLoading($(this).attr('page'));
                    });

                    $("#cardTitle").html("Exibindo " + resp.per_page +
                        " Clientes de " + resp.total +
                        " ("+ resp.from + " a " + resp.to + ")"
                    );
                });
        }

        $(function(){
            clientLoading(1);
        });

    </script>
</body>

</html>
