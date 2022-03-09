<div >
    <div>
        <form class="d-flex" action="" method="get">
            <input name="search_field" @if(isset($_GET['search_field'])) value="{{$_GET['search_field']}}" @endif type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поиск...">
          <button class="btn btn-dark" type="submit">Поиск</button>
        </form>
        <form action="" method="get" class="d-flex"  >
                    <div class="mb-3 mt-2 d-flex">
                        <select name="search_hashtag">
                            <option value="" disabled selected>ХЭШТЕГ</option>
                            @foreach($hashtags as $hashtag)
                            <option value="{{$hashtag->name}}" @if(isset($_GET['search_hashtag'])) @if($_GET['search_hashtag'] == $hashtag->name) selected @endif @endif placeholder="сортировка по ХЭШТЕГУ">{{$hashtag->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-dark ms-2">Выбрать</button>
                    </div>
                </form>
      </div>
</div>
@if (empty($posts))
Статьи отсуствуют
@else
    <div>
        @foreach ($posts as $post )
    <div >
           <div>
            <a href="{{route('user.posts.show',$post->id)}}">{{$post->title}}</a>
            <p>{{$post->content}}</p>
           </div>
   
        <div>
            Автор: {{ $post->author->name}} 
        </div>
        <div>
        @forelse($post -> hashtags as $hashtags)
            <tr>
                <td><a href="">{{$hashtags->name}}</a></td>
            </tr>
            @empty
            <h5> У поста нет хэштега </h5>
            @endforelse
        </div> 
        <div>
          Дата создания: {{$post->created_at}}
        </div> 
    </div>
    @endforeach    
    </div>
  
@endif
