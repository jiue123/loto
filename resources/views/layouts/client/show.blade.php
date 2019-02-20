@extends('layouts.app')

@section('content')
    <div class="container guest-container">
        <h5>{{$client->name}} : {{$client->phone}}</h5>
        <table class="table table-bordered table-dark">
            <tbody>
                @foreach($matrix as $key => $value)
                <tr>
                    @foreach($value as $k => $v)
                    <td>{{ $v }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
