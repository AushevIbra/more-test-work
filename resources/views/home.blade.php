@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Доска</span>
                    <div id="example"></div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>RUB</th>
                                <th>USD</th>
                                <th>EURO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$rub}}</td>
                                <td>{{round($usd)}}</td>
                                <td>{{round($euro)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
