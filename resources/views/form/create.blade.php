@extends('layouts.app')

@section('content')
    <div class="container" xmlns:width="http://www.w3.org/1999/xhtml" id="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('form.my') }}"> Формы </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('form.create') }}"> Создать новую </a>
                            </li>
                        </ul>

                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <create-form-component
                            :csrf_token="'{{ csrf_token() }}'"
                            :action="'{{ route('form.saveCreate') }}'"
                            :old_values="'{{ json_encode(old()) }}'" >
                        </create-form-component>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
