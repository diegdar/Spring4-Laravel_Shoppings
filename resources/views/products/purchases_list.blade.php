@extends('layouts.plantilla')

@section('title', 'Compras')

@section('content')
    <h1>Lista de Compras</h1>
    <a href="{{route('purchases.create')}}">crear compra</a>
    <ul>
        @foreach ($purchases as $purchase)
            <li>                         
                                              {{-- pasamos el 'id' como parametro al metodo show del controlador --}}
                <a href="{{route('purchases.show', $purchase->id)}}">{{$purchase->purchase_date}}</a>                                          
            </li>
        @endforeach
    </ul>

    {{$purchases->links()}}
@endsection

