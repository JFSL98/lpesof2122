@if($friends != null)
<h4>Friends</h4>
    <table style="width:100%">
  <tr>
    <th>Nome</th>
    <th>Email</th>
  </tr>
  @foreach($friends as $friend)
  <tr>
   <td>{{ $friend->name }}</td> 
   <td>{{ $friend->email }}</td> 
  </tr>
    @endforeach
</table>
@else
<h4>No friends</h4>
@endif
@if($followers != null)
<h4>Followers</h4>
    <table style="width:100%">
  <tr>
    <th>Nome</th>
    <th>Email</th>
  </tr>
  @foreach($followers as $follower)
  <tr>
   <td>{{ $follower->name }}</td> 
   <td>{{ $follower->email }}</td> 
  </tr>
    @endforeach
</table>
@else
<h4>No followings</h4>
@endif