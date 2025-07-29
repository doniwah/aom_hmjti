<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>New Password</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                   
                   <header>Welcome Back to <span class="text-danger">AOM</span></header>
                   <p class="text-center">Please fill in the form data below to create a new password</p>
                    
                   <div class="input-field">
                        <input type="email" class="input" id="email" required="" autocomplete="off">
                        <label for="email">Email</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass" required="">
                        <label for="pass">New Password</label>
                    </div>
                    <div class="input-field">
                        <input type="password" class="input" id="pass" required="">
                        <label for="pass">Confirm Password</label>
                    </div> 
                    
                   <div class="input-field">
                        
                        <input type="submit" class="submit" value="Submit" onclick="location.href='login.html';">
                   </div> 
                   <div class="signin pb-lg-5">
                    <span>Back to<a href="index.html"> Home</a></span>
                   </div>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>