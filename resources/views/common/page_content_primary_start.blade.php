<div class="aione-page-content-primary">
@if(!empty(Session::get('success')))
    <div class="aione-message success">
        {{Session::get('success')}}
    </div>
@endif
@if(!empty(Session::get('error')))
    <div class="aione-message error">
        {{Session::get('error')}}
    </div>
@endif
@if(!empty(Session::get('warning')))
    <div class="aione-message warning">
        {{Session::get('warning')}}
    </div>
@endif