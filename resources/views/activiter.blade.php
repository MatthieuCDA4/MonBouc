@extends('layouts.app')

@section('content')
    
    <div id="mainActivite">
        <div id="wrapperMainActivite">
            <div class="detailActivite">
                
                @if ($livre != null)    
                    
                    @foreach ( $livre as $item)
                        <div class= "box">
                            <img src="{{$item->image }}" alt=" {{ $item->titre_livre }} ">
            
                            <p>{{ $item->titre_livre }}
                                <br>
                                Nombre pages :<br>
                                {{ $item->nombre_page }}<br>
                                <br>
                                Catégorie :<br>
                                {{ $item->nom_genre }}<br>
                                <br> 
                            </p>
                            <form action="{{route('depotLivre')}}" method="POST">
                                @csrf
                                <input type="hidden"  name="id_exemplaire" value="{{ $item->id_exemplaire }}">
                                <input class="voirDetail" type="submit" value="Déposer livre">
                            </form>
    
                        </div> 
                    @endforeach

                @else

                    <p>Vous n'avez pas emprunter de livre</p>

                @endif
                
                <fieldset>

                    <legend>Détail Activité</legend>
                    @if ($depot == null && $emprunt == null)

                        <p>Vous n'avez pas emprunter ou déposer de livre</p>    

                    @else

                        @if ($depot == null)

                        <p>Vous n'avez pas déposé de livre</p>

                        @else
                            <br>
                            <p>--Déposer--</p> 
                            @foreach ($depot as $item)

                                <p>{{{ $item->date_retour}}} - Déposer "{{$item->titre_livre}}"</p>
                                
                            @endforeach   

                        @endif

                        @if ($emprunt == null)

                            <p>Vous n'avez pas emprunté de livre</p>

                        @else
                        
                            <br>
                            <p>--Emprunter---</p>
                            @foreach ($emprunt as $item)

                                <p>{{{ $item->date_emprunt}}} - emprunter "{{$item->titre_livre}}"</p>

                            @endforeach  

                        @endif

                    @endif

                </fieldset>
            </div>
        </div>
    </div>

    
@endsection
