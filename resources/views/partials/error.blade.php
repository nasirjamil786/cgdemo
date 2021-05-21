
    <div class="alert-danger">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div><ul> <li>{{ $error }} </li></ul></div>
            @endforeach
        @endif
    </div>
