@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ответ ID: {{$formAnswerID}} - {{$title}}
                    </div>
                    <div class="card-body">
                    @foreach($answers as $answer)
                            <b class="list-group-item"> {{ $questions[$loop->index]->text }}</b>
                            <span class="list-group-item"> {{$answer->text}}</span>
                    @endforeach
                    <br>
                        <form action="{{ route('form.savePDF', $formAnswerID) }}" method="get">
                            <button type="submit" class="btn btn-success"> Скачать PDF </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
