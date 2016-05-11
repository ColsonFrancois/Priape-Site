@extends('../template')
@section('contenu')
    <section class="module">
        <div class="container">
        @foreach($works as $work)
            <p>{{$work['name']}}</p>
            @endforeach


    </div>
    </section>
    @endsection