@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-group gap-1">
            @foreach ($collection as $item)
                <div class="card" style="min-width: 235px;width: 235px;">
                    <img class="card-img-top" src="{{ $item['avatarLink'] }}" alt="Avatar">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <span class="text-secondary">( {{ $item['subscribers'] }} )</span>
                        <div class="progress">
                            {!! $item['progressbar'] !!}
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