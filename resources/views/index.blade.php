@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-group gap-1">
            @foreach ($collection as $item)
                <div class="card" style="min-width: 235px;width: 235px;">
                    <img class="card-img-top" src="{{ $item['avatarLink'] }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <span class="text-secondary">( {{ $item['subscribers'] }} )</span>
                        {{-- <p class="card-text" style="height: 5px">{!! $item['progressbar'] !!}</p> --}}
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{ $item['progressbarPecent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ $item['time'] }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection