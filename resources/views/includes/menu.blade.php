    <div id="menuSpacer"></div>
    <div class="container-fluid no-padding" id="navbar">

        <nav class="navbar navbar-expand-md navbar-light" id="navbar">
            
            <div class="logo text-center d-block d-md-none">
                <a class="nav-link" href="{{url('/resultats/1')}}"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
            </div>
    
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 col-12">
                          <li class="nav-item col-12 col-md-3">
                            <div class="reglement">
                                <a class="nav-link" href="" data-toggle="modal" data-target="#reglementModal">Reglement</a>
                            </div>
                            <div class="pronostics">
                                <a class="nav-link" href="{{url('/resultats/1')}}">Pronostics</a>
                            </div>
                          </li>
                          <li class="nav-item col-md-6 d-none d-md-block">
                            <div class="logo text-center">
                                <a class="nav-link" href="{{url('/resultats/1')}}"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
                            </div>
                          </li>
                          <li class="nav-item col-12 col-md-3 text-right">
                            <div class="classement"><a href="{{url('/classement')}}">Classement</a></div>
                            <div class="vestiaire"><a href="{{url('/vestiaire')}}">Vestiaire</a></div>
                          </li>
                        </ul>
                    </div>
                </div>
              </div>
        </nav>
    </div>