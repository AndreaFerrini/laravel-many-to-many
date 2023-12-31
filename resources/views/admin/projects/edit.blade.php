@extends("layouts.dashboard")

@section("title")
    Laravel Auth | Project Edit
@endsection

@section("content")

    <h1>Edit Project: {{$project->title}}</h1>

    @if ($errors->any() )
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $elem)
            <li>{{$elem}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="mb-3">
          <label for="project-title" class="form-label">Title</label>
          <input type="text"
            class="form-control" name="title" id="project-title" aria-describedby="helpId" value="{{ old('title') ?? $project->title}}">
        </div>

        <div class="mb-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="content" id="project-content" rows="3">{{ old('content') ?? $project->content}}</textarea>
        </div>

        <div class="mb-3">
          <label for="project_cover_image" class="form-label">Cover Image</label>
          <input type="file" class="form-control" name="cover_image" id="project_cover_image" placeholder="" aria-describedby="fileHelpId">
        </div>

        {{-- Types --}}
        <div class="mb-3">
          <label for="project-types" class="form-label">Types</label>
          <select class="form-select form-select-lg" name="type_id" id="project-types">
            <option value=""> Seleziona type </option>
            @foreach ($types as $elem)
              <option value="{{$elem->id}}" {{ old("type_id", $project->type_id) == $elem->id ? "selected" : "" }} >{{ $elem->name }}</option>  
            @endforeach
          </select>
          <div>
            @error ("type_id")
              <div class="alert alert-danger">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>

        {{-- Technologies --}}
        <div class="form-group mb-3 mt-4 d-flex justify-content-start">
          @foreach ($technologies as $elem)
            <div class="form-check @error('technologies') is-invalid @enderror">
              @if ( $errors->any()  )
                <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $elem->id }}" id="post-checkbox-{{$elem->id}}"
                {{ in_array( $elem->id, old( "technologies", [] )) ? "checked" : "" }}>
              @else
                <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $elem->id }}" id="post-checkbox-{{$elem->id}}"
                {{ ($project->technologies->contains($elem) ) ? "checked" : "" }}>
              @endif
              <label class="form-check-label pe-5" for="post-checkbox-{{$elem->id}}">
                {{$elem->name}}
              </label>
            </div>
          @endforeach
        </div>

        <button class="btn btn-success">Create project</button>

    </form>


@endsection