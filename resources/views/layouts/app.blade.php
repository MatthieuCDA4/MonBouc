<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
        <script language="javascript" src=" {{ asset('assets/js/javascript.js')}} " defer></script>
        <link rel="stylesheet" href="{{asset('/assets/css/normalize.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/app.min.css')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/img/logoMonBouc.png')}}" />
        <!-- CSRF Token -->
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <title>Mon Bouc - {{ $title ?? '' }}</title>
    </head>
    <body>
        <div class="wrapper">
            <header>
                <div class="wrapperHeader">
                    <div class="one">
                        <img src="{{asset('/assets/img/logoMonBouc.png')}} " alt="">
                        <h1>Mon Bouc</h1>
                    </div>
                    <div class="two">
                        
                        <h5>Bonjour " {{ auth()->user()->firstname }} " </h5>
                        <div class="href">
                            <a href="{{route('home')}}">| Accueil</a>
                            <a href="{{route('activite')}}">| Actvité</a>
                            <a href="{{route('pageDeRecherche')}}">| Rechercher un livre</a>
                            <a href="{{route('ficheLivre')}}">| Ajouter un livre</a> 
                            <div >                      
                                    <form action=" {{ route('logout')}} " method="POST" class="deco"  onclick="return ConfirmDelete();">
                                        @csrf
                                        <input type="submit" value="| Déconnexion" class="deconnexion">
                                    </form>
                            </div>
                        </div>
                    </div>
                    <div class="tree">
                        <div class="soldeJeton"><p id="jeton"> Jeton : {{ auth()->user()->nombre_jeton }} x </p><img src="{{asset('/assets/img/jetonBouc.png')}}" alt=""></div>
                    </div>
                    <div class="four">
                        <div id="fond">
                            <img src="{{asset('/assets/img/fond-paysage.jpg')}}" alt="">
                        </div>
                        <div id="fondGoat">
                            <img src="{{asset('/assets/img/bouc-en-coin.png')}}" alt="">
                        </div>
                        <div id="description">
                            <h4>Mon Bouc, lisez à volonté</h4>
                            <p>Echangez vos livres avec d’autres lecteurs via un système de troc ; <br> gagnez des jetons en
                                mettant à disposition vos livres, puis empruntez des livres avec vos jetons. Et ainsi de
                                suite!
                            </p>
        
                        </div>
        
                    </div>
                </div>
            </header>
            <main>
                @yield('content')
            </main>
            <footer>
                <div class="wrapperFooter">
                    <div class="lien">
                        <p><b>A propos de Mon Bouc</b></p>
                        <a href="{{route('partiePasFini')}}">Qui sommes-nous?</a>
                        <a href="{{route('partiePasFini')}}">Règlement du site</a>
                        <a href="{{route('partiePasFini')}}">Avertissement</a>
                        <a href="{{route('partiePasFini')}}">CGU</a>
                    </div>
                    <div class="lien">
                        <p><b>Nos services</b></p>
                        <a href="{{route('pageDeRecherche')}}">Rechercher des livres</a>
                        <a href="{{route('ajouterLivre')}}">Ajouter ses livres</a>
                        <a href="{{route('partiePasFini')}}">F.A.Q</a>
                    </div>
                    <div class="lien">
                        <p><b>Service client</b></p>
                        <a href="{{route('partiePasFini')}}">Contactez-nous</a>
                        <a href="{{route('partiePasFini')}}">Dans la presse</a>
                    </div>
                    <div id="createur">
                        <p>©MonBouc.com - Tous droits réservés. Un site réalisé par Matthieu Riou </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
