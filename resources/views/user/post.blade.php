@extends('user/app')

@section('bg-img',asset('user/img/post-bg.jpg'))

@section('title', $postslug->title)

@section('subheading',$postslug->subtitle)

@section('main-content')
<!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              <small>Created at {{ $postslug->created_at }}</small>
              @foreach ($postslug->categories as $category)
                <small class="pull-right" style="margin-right: 20px">  
                    {{ $category->name }}
                </small>
              @endforeach

            <p>{!! htmlspecialchars_decode($postslug -> body) !!} </p>

             {{-- Tag clouds --}}
             <h3>Tag Clouds</h3>
             @foreach ($postslug->tags as $tag)
             <small class="pull-left" style="margin-right: 20px;border-radius: 5px;border: 1px solid gray;padding: 5px;">  
                                 {{ $tag->name }}
                             </small>
             @endforeach
          </div>
        </div>
      </div>
    </article>

    <hr>
@endsection