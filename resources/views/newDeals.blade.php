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
                   СОЗДАТЬ СДЕЛКУ
                </div>
            <form action="/potential/store" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                  
            
                <div class="form-group">
                    <label for="Owner">Owner</label>
                    
                    <select name="Owner" class="form-control" id="Owner">
                        <option value="{{ $userId }}">{{ $fullName }}</option> 
                    </select>    
                </div>
                <div class="form-group">
                    <label for="Account_Name">Account Name</label>
                    <input type="text" name="Account_Name" class="form-control" id="Account_Name" placeholder="Account_Name">        
                </div>
                <div class="form-group">
                    <label for="Deal_Name">Deal_Name</label>
                    <input type="text" name="Deal_Name" class="form-control" id="Deal_Name" placeholder="Deal_Name">        
                </div>
                
                <div class="form-group">
                    <label for="Type">Type</label>
                    <input type="text" name="Type" class="form-control" id="Type" placeholder="Type">        
                </div>
                <div class="form-group">
                    <label for="Stage">Stage</label>
                    <input type="text" name="Stage" class="form-control" id="Stage" placeholder="Stage">        
                </div>
                <div class="form-group">
                    <label for="Probability">Probability</label>
                    <input type="text" name="Probability" class="form-control" id="Probability" placeholder="Probability">        
                </div>
                <div class="form-group">
                    <label for="Amount">Amount</label>
                    <input type="text" name="Amount" class="form-control" id="Amount" placeholder="Amount">        
                </div>
                <div class="form-group">
                    <label for="Closing_Date">Closing_Date</label>
                    <input type="date" name="Closing_Date" class="form-control" id="Closing_Date" >        
                </div>
                
                    
                    <button type="submit" class="btn btn-lg btn-outline-primary">Создать сделку</button> 
                </form>

              
            
        </div>
    </body>
</html>
