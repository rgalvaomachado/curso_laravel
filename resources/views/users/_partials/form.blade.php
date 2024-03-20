@csrf
{{-- {{ csrf_token() }} --}}
<input type="text" name="name" placeholder="name" value="{{$user->name ?? old('name')}}">
<input type="text" name="email" placeholder="email" value="{{$user->email ?? old('email')}}">
<input type="text" name="password" placeholder="password">
<input type="file" name="image">
<button type="submit">Salvar</button>