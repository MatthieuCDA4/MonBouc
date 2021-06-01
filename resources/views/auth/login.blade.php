@extends('auth.templateLogin')

@section('content')
    <div id="corp">
        <img id="fondLogin" src="/assets/img/fond-paysage.jpg" alt="paysage plaine">
            <div class="wrapperCenter">
                <header>
                    <div id="logo">
                        <h1>Mon Bouc</h1>
                        <img src="/assets/img/logoMonBouc.png" alt="logo bouc qui lie">
                    </div>
                </header>
                <main>
                    @if (session('status'))
                        <div>
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div>
                            <div>{{ __('Quelque chose s\'est mal passé') }}</div>

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="rowForm">
                            <label>{{ __('Email') }}</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus />
                        </div>

                        <div class="rowForm">
                            <label>{{ __('Mot de passe') }}</label>
                            <input type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <div class="boutonConnexionLogin">
                            <button type="submit">
                            {{ __('Se connecter') }}
                            </button>
                        </div>
                    </form>

                    <form action=" {{ route('register') }} " method="GET" id="inscription">
                        @csrf
                        <div  class="boutonInscriptionLogin" class="rowFormLogin">
                            <input class="bouton" type="submit" value="S'inscrire">
                        </div>
                    </form>
                </main>
            </div>
    <footer>
        <div class="fondBoxLivre">
            <div class="piedPage">
                <div class="wrapperFooterLogin">
                    <form action=" {{ route('loginRechercheLivre') }} " method="POST">
                        @csrf
                        <label for="ville">Nom de la ville </label> 
                        <input id="ville" type="text" name="rechercheVille" value="{{env('APP_VILLE')}}">
                        <input type="submit" value="Valider">
                        
                    </form>
                </div>
                
                <ul>
                    <li>
                        @foreach ($rechercheLivre as $item)  
                            <img class="picture" src="{{$item->image}} " alt=""> 
                        @endforeach
                    </li>
                </ul>
            </div>   
        </div>
    </footer>
@endsection