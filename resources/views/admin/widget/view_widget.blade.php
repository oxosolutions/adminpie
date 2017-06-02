            <div class="col l3 pr-7">
                <div class="card shadow" style="margin-top: 0px;">
                    <div class="row center-align aione-widget-header" ><h5 style="margin: 0px"><a href="" style="display: block">{{$data['title']}}</a></h5></div>
                    <div class="row center-align aione-widget-content" >{{$data['count']}}</div>
                    @if(!empty($data['list']))
                    @foreach($data['list'] as $keyss => $val)
                        <div class="row center-align aione-widget-content" > <h6>{{$loop->iteration }} - {{$val['name']}}</h6></div>
                    @endforeach
                @endif
                    <div class="row center-align aione-widget-footer" >
                        <a href="{{route('list.'.$data['title'])}}" class="btn" style="background-color: #005A8B">All {{$data['title']}} </a>
                    </div>
                </div>
            </div>
      