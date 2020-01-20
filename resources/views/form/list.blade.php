@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('form.my')  }}"> Формы </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('form.create')  }}"> Создать новую </a>
                        </li>
                    </ul>

                </div>
                    @forelse($forms as $form)
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <a href="{{ route('form.show', $form->id)  }}"> {{ $form->title }} </a>

                                <span class="float-right">
                                    <span> <a href="{{ route('form.answers', $form->id)  }}"> [Ответы] </a></span>
                                    <span> <a href="{{ route('form.delete', $form->id)  }}"> [Удалить] </a></span>
                                </span>
                            </li>
                        </ul>
                    @empty
                        <div class="card-body">
                            Созданных форм нету
                        </div>

                    @endforelse


            </div>
        </div>
    </div>
</div>
@endsection
