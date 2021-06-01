@extends('auth.templateLogin')

@section('content')
    <img id="fondLogin" src="/assets/img/fond-paysage.jpg" alt="paysage plaine">
    <div class="wrapperCenter">
        <div class="wrapperCenter">
            <header>
                <div id="logo">
                    <h1>Mon Bouc</h1>
                    <img src="/assets/img/logoMonBouc.png" alt="logo bouc qui lie">
                </div>
            </header>

            <main>
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

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="rowForm">
                        <label>{{ __('Prénom') }}</label>
                        <input type="text" name="firstname" value="{{ old('firstname') }}" required autofocus autocomplete="firstname" >
                    </div>

                    <div class="rowForm">
                        <label>{{ __('Nom') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" required  autocomplete="name" >
                    </div>

                    <div class="rowForm">
                        <label>{{ __('Pseudo') }}</label>
                        <input type="text" name="pseudo" value="{{ old('pseudo') }}" required  autocomplete="pseudo">
                    </div>

                    <div class="rowForm">
                        <label>{{ __('Date naissance') }}</label>
                        <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required  autocomplete="date_naissance">
                    </div>

                    <div class="rowForm">
                        <label>{{ __('Code postal') }}</label>
                        <input type="text" name="code_postal" id="code_postal" value="{{ old('code_postal') }}" required  autocomplete="code_postal" onchange="gouvCommune()">
                    </div>

                    <div class="rowForm">
                        <label>{{ __('ville') }}</label>
                        <select id="ville" name="ville"></select>
                    </div>


                    <div class="rowForm">
                        <label>{{ __('Email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}" required >
                    </div>

                    <div class="rowForm">
                        <label>{{ __('Mot de passe') }}</label>
                        <input type="password" name="password" required autocomplete="new-password" >
                    </div>

                    <div class="rowForm">
                        <label>{{ __('Confirmer le mot de passe') }}</label>
                        <input type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="boutonRegister">
                        <button type="submit">
                            {{ __('Enregistrer') }}
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
@endsection