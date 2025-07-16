
@extends('layouts.master')
@section('title', 'Multiplication Table')
@section('content')
    <div class="card">
        <div class="card-header">
            Multiplication Table
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            @for ($col = 1; $col <= 10; $col++)
                                <th>{{ $col }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @for ($row = 1; $row <= 10; $row++)
                            <tr>
                                <th class="table-light">{{ $row }}</th>
                                @for ($col = 1; $col <= 10; $col++)
                                    <td>
                                        <span class="badge bg-primary fs-6">{{ $row * $col }}</span>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
