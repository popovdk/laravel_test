@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Форма ID: {{$formID}} - Ответы
                    </div>
                    @forelse($formAnswers as $formAnswer)
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <a href="{{ route('form.answer', $formAnswer->id) }}"> {{$formAnswer->created_at}} </a>
                            </li>
                        </ul>
                    @empty
                        <div class="card-body">
                            Ответов еще нету
                        </div>

                    @endforelse


                </div>
            </div>
        </div>
    </div>
@endsection
