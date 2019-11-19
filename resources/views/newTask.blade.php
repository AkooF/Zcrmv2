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
                   СОЗДАТЬ ЗАДАЧУ
                </div>
            <form action="/tasks/store" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                
                    <input type="hidden" name="What_Id" value="{{ $id }}">    
                    
                <div class="form-group">
                    <label for="Owner">Task owner</label>
                    
                    <select name="Owner" class="form-control" id="Owner">
                        <option value="{{ $userId }}">{{ $fullName }}</option> 
                    </select>    
                </div>
                <div class="form-group">
                    <label for="Subject">Subject</label>
                    <input type="text" name="Subject" class="form-control" id="Subject" placeholder="Subject">        
                </div>
                <div class="form-group">
                    <label for="Who_Id">Contact name</label>
                    <select  name="Who_Id" class="form-control" id="Who_Id">
                        @foreach ( $contacts as $contact)
                        <option value="{{ $contact['Who_Id'] }}">{{ $contact['FullName'] }}</option>
                        @endforeach
                    </select>
                </div>
                    
                <div class="form-group">
                    <label for="Status">Status</label>
                    <select  name="Status" class="form-control" id="Status">
                        <option value="Не запущена">Не запущена</option>
                        <option value="Отложено">Отложено</option>
                        <option value="Выполняется">Выполняется</option>
                        <option value="Завершено">Завершено</option>
                        <option value="Ожидает ввода">Ожидает ввода</option>
                    </select>
                </div> 
                    
                <div class="form-group">
                    <label for="Priority">Priority</label>
                    <select  name="Priority" class="form-control" id="Priority">
                        <option value="Очень высокий">Очень высокий</option>
                        <option value="Высокий">Высокий</option>
                        <option value="Нормальный">Нормальный</option>
                        <option value="Низкий">Низкий</option>
                        <option value="Самый низкий">Самый низкий</option>
                    </select>
                </div>          
                    
                              
                
                <div class="form-group">
                    <label for="Due_Date">Due Date</label>
                    <input type="date" name="Due_Date" class="form-control" id="Due_Date" >        
                </div>
                
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="Description" class="form-control" id="Description" placeholder="Description">        
                </div>
                    
                    <button type="submit" class="btn btn-lg btn-outline-primary">Создать задачу</button> 
                </form>

              
            
        </div>
    </body>
</html>
