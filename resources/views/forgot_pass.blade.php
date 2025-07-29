<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Forgot Password</title>
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
                   <p class="pb-lg-5 text-center">We will send a link to your email,use that link to reset password</p>
                   <div class="input-field">
                        <input type="text" class="input" id="username" required="" autocomplete="off">
                        <label for="username">Email</label> 
                    </div> 
                  
                   <div class="input-field">
                        <input type="submit"class="submit" value="Submit" onclick="location.href='new_pass.html';">
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