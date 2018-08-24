@extends('layouts.app')

@section('content')

<div class="container-fluid header-welcome">
    <div class="col-12 text-center">
        <a href="{{url('/')}}"><img class="img-fluid" src="{{asset('img/logo.png')}}" alt=""></a>
    </div>
</div>

<div class="bg-img">

    <div class="container login">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div class="container-form">

                    <div class="text-center"><img class="img-fluid" src="{{asset('img/title_connection.png')}}"></div>

                    <div class="row">

                        <div class="col-12 text-center">
                            <a href="{{url('/redirect')}}" class="btn btn-primary btn-fb"><i class="fab fa-facebook-f"></i> Connexion avec Facebook</a>
                        </div>

                        <div class="col-12 text-center">ou</div>

                        <div class="col-12">
                            <div class="panel-body lato">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-sm-12 col-md-4 control-label">Adresse mail :</label>

                                        <div class="col-sm-12 col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-sm-12 col-md-4 control-label">Mot de passe :</label>

                                        <div class="col-sm-12 col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-4 text-right">
                                            <button type="submit" class="cta bg-orange">
                                                Je me connecte <div><i class="fas fa-long-arrow-alt-right"></i></div>
                                            </button>
                                        </div>
                                        <div class="col-md-6 offset-md-4 text-right">
                                            
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                J'ai oublié mon mot de passe
                                            </a>
                                            <a class="btn btn-link" href="{{ route('register') }}">
                                                Pas encore de compte ?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
