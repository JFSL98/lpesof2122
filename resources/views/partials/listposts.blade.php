@forelse ($posts as $post)
<div class="card">
    <div class="card-body">
        @php
            $user=$post->user;
        @endphp
        @if ($user->profile_pic==NULL)
        <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/default.jpg')}}" alt="Avatar" >
        @else
        <img class="rounded-circle profile-pic profile-pic-listposts" src="{{asset('storage/images/profile_pic/'.$user->profile_pic->path)}}" alt="Avatar" >
        @endif 
        <h5 class="card-title">{{ $post->user->name }}</h5>
        <p>
            <small>
                posted at {{ $post->created_at }}
                @if ($post->created_at != $post->updated_at)
                    , edited at {{ $post->updated_at }}
                @endif
            </small>
        </p>
        <p class="card-text">{{ $post->content }}</p>
        @if ($post->user_id === Auth()->user()->id)
        <form method="POST" action="{{ route('post.remove', ['id' => $post->id]) }}">
            @csrf
            <button type="submit" class="btn btn-danger">Remover</button>
        </form>
        @endif
    </div>
</div>
@empty
<h5 class="text-center">Nothing to see here!</h3>
@endforelse
