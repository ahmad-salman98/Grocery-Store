

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
      rel="stylesheet"
    />
  </head>
  <header>
    <nav>
      <div>
      </div>
    </nav>

  </header>
  <body class="w-100" style="background-color:#eee; background: url('https://images.pexels.com/photos/1274614/pexels-photo-1274614.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); background-size: cover;">
<section class="vh-100" style="z-index: -1;">
  <div class="container h-100 w-50">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-3">
            <div class="row justify-content-center">
              <!-- <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1"> -->
              <div style="display: block; align-items: center; color: white" class="container mt-5 w-75 align-middle">
                  <!-- Pills navs -->
                  <ul class="nav nav-pills nav-justified mb-3 " id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">
                        Login
                      </a>
                    </li>
                    <li class="nav-item " role="presentation">
                      <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register"aria-selected="false">
                        Register
                      </a>
                    </li>
                  </ul>
                  <!-- Pills navs -->

                  <!-- Pills content -->
                  <h3 style="color:#7FAD39; text-align:center;">Welcome To Dokkaneh</h3>
                  <div class="tab-content">
                    <div
                      class="tab-pane fade show active"
                      id="pills-login"
                      role="tabpanel"
                      aria-labelledby="tab-login"
                    >
                    
                    
                <!--------------- Log in --------------->
                      <form id="loginForm" method="post">
                        <div class="text-center">
                          <p style="color: gray">Log in</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-5">
                          <input type="email" name="email_login" id="emailLogin" class="form-control" />
                          <label class="form-label" for="email-login">
                            Email <small></small></label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          <input type="password" id="password-login" name="passwordLogin" class="form-control" />
                          <label class="form-label" for="password-login">Password <small></small></label>
                        </div>
                        <small id="err"></small>
                          
                        <!-- Submit button -->
                        <button type="submit" id="loginBtn" class="btn btn-block mb-4 mt-5" style="background-color: #7FAD39 !important; color: white;">
                          Login
                        </button>
                        
                      </form>
                   
                    </div>
                
                    
                    
                    
                    
                    
                    
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <!--------------- Register --------------->
                      <form id="registrationForm">
                        <div class="text-center mb-3">
                          <p>Sign up:</p>
                        </div>

                        <!-- Name input -->
                        <div class="form-outline mb-4">
                          <input type="text" id="name-registration" name="name"class="form-control" />
                          <label class="form-label" for="name-registration">Name <small id="name-small"></small></label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4" style="color: #23ff16;">
                          <input type="text" name="email" id="email-registration" class="form-control" />
                          <label class="form-label" for="email-registration">Email <small id="esmall"></small></label>
                        </div>
                        <small id="taken"></small>


                        <!-- phone input -->
                        <div class="form-outline mb-4">
                          <input type="tel" name="phone"id="phone-registration" class="form-control" />
                          <label class="form-label" for="phone-registration">Phone <small></small></label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          <input
                            type="password"
                            id="password-registration"
                            class="form-control"
                            name="password"
                          />
                          <label class="form-label" for="password-registration">Password <small></small></label>
                        </div>

                        <!-- Repeat Password input -->
                        <div class="form-outline mb-4">
                          <input
                            type="password"
                            id="password-confirm-registration"
                            class="form-control"
                            name="passwordConfirm"
                          />
                          <label class="form-label" for="password-confirm-registration"
                            >Repeat password <small></small></label
                          >
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check d-flex justify-content-center mb-4">
                          <input
                            class="form-check-input me-2"
                            type="checkbox"
                            value=""
                            id="registerCheck"
                            checked
                            aria-describedby="registerCheckHelpText"
                          />
                          <label class="form-check-label text-dark" for="registerCheck">
                            I have read and agree to the terms
                          </label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-block mb-3" style="background-color: #7FAD39; color: white;">
                          Sign Up
                        </button>
                      </form>  
                      
                    </div>
                  <!-- </div> -->
                  <!-- Pills content -->
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  

    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"
    ></script>
    <script src="./signup/js/app.login.js"></script>
    <script src="./signup/js/app.register.js"></script>
  </body>
</html>