@extends('layouts.main')

@section('content')
    <div class="container">
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button type="submit">Выйти</button>
        </form>
        <h1>Чат</h1>
        <div class="row">
            <div class="col-8">
                <textarea name="text" id="" rows="10" class="form-control" disabled>@{{messages.join('\n')}}</textarea>
                <hr>
                <input type="text" class="form-control" v-model="text" @keyup.enter="send" @keydown="actionUser">
                <span v-if="isActive">@{{isActive.name}} набирает ...</span>
            </div>
            <div class="col-4">
                <ul>
                    <li  v-for="user in activeUsers">@{{user}}</li>
                </ul>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Выберите чат</label>
                    <select v-model="user" class="form-control" id="exampleFormControlSelect2">
                        @foreach($users as $user)
                        <option :value="{{$user}}">{{$user->name}}</option>
                         @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let data = @json(auth()->user())
    </script>
@endpush