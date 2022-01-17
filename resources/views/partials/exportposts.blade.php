@if($posts != null)
<h4>User Posts</h4>
    <table style="width:100%">
  <tr>
    <th>Nome</th>
    <th>Content</th>
    <th>Created at</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>N Comentarios</th>
  </tr>
  @foreach($posts as $post)
  <tr>
   <td>{{ $post->user->name }}</td> 
   <td>{{ $post->content }}</td> 
   <td>{{ $post->created_at }}</td> 
   <td>{{ $post->getLikeCount() }}</td> 
   <td>{{ $post->getDislikeCount() }}</td> 
   <td>{{ $post->getCommentCount() }}</td>
  </tr>
    @endforeach
</table>
@else
<h4>No Posts</h4>
@endif