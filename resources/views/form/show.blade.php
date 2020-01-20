@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{$form->title}} </div>
                    <div class="card-body">
                        <form action="{{ route('form.saveAnswers', $form->id) }}" method="post">
                            @csrf
                            @foreach($questions as $question)
                                    <div class="form-group">
                                        <label> {{$question->text}} </label>
                                        <textarea type="text" name="answers[]" class="form-control"></textarea>

                                    </div>
                            @endforeach
                            <button type="submit" class="btn btn-success"> Сохранить </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
