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
                    ЗАДАЧИ
                </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                     
                        <th scope="col">tasks</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <tr>    
                      
                        <td></td>
                    </tr>
                  
                </tbody>
            </table>

            <a  href="/tasks/new" class="btn btn-lg btn-outline-primary disabled">Добавить задачу</a>   
            
        </div>
    </body>
</html>
