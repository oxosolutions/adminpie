<div class="list-container">
    <nav id="aione_nav" class="aione-nav aione-nav-vertical">
        <div class="aione-nav-background"></div>
        <ul id="aione_menu" class="aione-menu sortable">
            <li class="aione-nav-item level0 unsortable">
                <a href="{{ route('list.module') }}">
                    <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-list"></i></span>
                    <span class="nav-item-text">
                        All Modules
                    </span>                      
                </a>
            </li>
            @foreach($listModule as $k => $v)
                <li class="aione-nav-item level0 {{($v->subModule->isNotEmpty())?'has-children':''}} {{(@$v->id == @request()->route()->parameters()['id'])?'nav-item-current' :''}}">
                    <input type="hidden" value="{{$v->id}}" class="module_id" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}" class="shift_token" >
                    <a href="{{route('list.module',['id'=>$v->id])}}" >
                        @if(!empty($v->icon))
                        <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa {{$v->icon}}">
                            </i></span>
                        @endif
                        <span class="nav-item-text">
                            {{$v->name}}
                        </span>
                        @if($v->subModule->isNotEmpty())
                            <span class="nav-item-arrow"></span>
                        @endif
                    </a>
                    @if($v->subModule->isNotEmpty())
                        <ul class="side-bar-submenu">
                            @foreach($v->subModule as $key => $subModule)
                                <li class="aione-nav-item level1 {{($subModule->id == @request()->route()->parameters()['subModule'])?'nav-item-current' :''}}    ">
                                {{-- <input type="hidden" name="module_id"> --}}
                                    <a href="{{route('list.module',['id'=> @$v->id, 'subModule' => $subModule->id])}}">
                                        <span class="nav-item-icon">{{$subModule->id}}</span>
                                        <span class="nav-item-text">{{$subModule->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif   
                </li>
             @endforeach
        </ul>
    </nav>
</div>