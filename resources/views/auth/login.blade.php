<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Elo Softwares | </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
    </head>

    <body class="login">
        <div class="row" style="margin: 0;">
            <div class="col-xs-12 col-md-3">

                <div class="login_wrapper">
                    <div class="animate form login_form">
                    <section class="login_content">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <img src="images/logo-elo.jpg" style="height: 200px; width: 200px;">
                            <h1>Efetue seu Login!</h1>
                            {{session('loginError')}}
                            <div>
                                <input type="text" class="form-control" placeholder="E-mail" style="width: 70%; margin: 20px auto;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Senha" style="width: 70%; margin: 20px auto;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <a class="reset_pass" href="#">Esqueceu sua senha?</a>
                            <button class="btn btn-default" href="/" type="submit"">Entrar
                            </button>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Ainda não tem uma conta?
                                <a href="#signup" class="to_register"> Crie uma! </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                            </div>
                        </form>
                    </section>
                    </div>

                    <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                            <a href="layouts/master" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />
                        </div>
                        </form>
                    </section>
                    </div>
                </div>
            </div>

            <div class="col-md-9" style="padding: 0;">
            <div class=" img-login"></div>
                
        </div>

    </div>
  </body>
</html>