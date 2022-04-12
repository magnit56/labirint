@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row weather">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">{{ $weather['name'] }} {{ $weather['date'] }}</p>
                    <h5 class="card-title">Температура: {{ $weather['temperature'] }}</h5>
                    <h5 class="card-title">Ощущается как: {{ $weather['feels'] }}</h5>
                    <p class="card-text">{{ $weather['description'] }}</p>
                </div>
            </div>
        </div>

        <div class="row currencies">
            @foreach($currencies as $currency)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">1 {{ $currency->CharCode }} = {{ $currency->Value }} RUB</p>
                        <p class="card-text">{{ $currency->Name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="update btn btn-primary">Обновить</button>
    </div>
@endsection
