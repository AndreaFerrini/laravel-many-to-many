@extends("layouts.dashboard")

@section("title")
    Laravel Auth | Project Show
@endsection

@section("content")

    <h1>Singolo project: {{ $project->title}}</h1>

    <img class="img-fluid" src="{{ asset('storage/' . $project->cover_image)}}" alt="">

    <p class="mt-3">
        {{ $project->content}}
    </p>

    <h2 class="mt-3">Types</h2>
    @if( $project->types )
        <div>Name: {{ $project->type->name }}</div>
        <div>Slug: {{ $project->type->slug }}</div>
    @endif


    <h2 class="mt-3">Technologies</h2>
    @if( $project->technologies )
    	@foreach ( $project->technologies as $elem )
    		<div>Technology Name: {{ $elem->name }} </div>
    	@endforeach
    @endif



@endsection