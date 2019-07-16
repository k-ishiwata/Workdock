@if (Session::has('alert'))
    <div class="alert alert-success">{{ Session::get('alert') }}</div>
@elseif ($errors->any())
    <div class="alert is-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
