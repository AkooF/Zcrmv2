<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
        
    </head>
    <body>
        <div class="container">
            
            
                <div class="display-4 center">
                    СДЕЛКИ
                </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">entityId</th>
                        <th scope="col">ownerName</th>
                        <th scope="col">ownerId</th>
                        <th scope="col">accountName</th>
                       <?// <th scope="col">contactName</th> ?>
                        <th scope="col">amount</th>
                        <th scope="col">closingDate</th>
                        <th scope="col">stage</th>
                        <th scope="col">tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deals as $deal)
                    <tr>    
                        <td>{{ $deal['entityId'] }}</td>
                        <td>{{ $deal['ownerName'] }}</td>
                        <td>{{ $deal['ownerId'] }}</td>
                        <td>{{ $deal['accountName'] }}</td>
                      <?//  <td>{{ $deal['contactName'] }}</td> ?>
                        <td>{{ $deal['amount'] }}</td>
                        <td>{{ $deal['closingDate'] }}</td>
                        <td>{{ $deal['stage'] }}</td>
                        <td><a href="/tasks/{{ $deal['entityId'] }}">Add task</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a  href="/potential/new" class="btn btn-lg btn-outline-primary ">Создать сделку</a>   
            
        </div>
    </body>
</html>
