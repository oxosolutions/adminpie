@php
    $skip = ['device_detail','mac_address','imei','created_by','created_at','deleted_at'];
    $index = 0;
@endphp

<table style="border: 1px solid #e8e8e8; width: 100%; border-collapse: collapse;border-spacing: 0;font-family: Helvetica,Arial,sans-serif;" width="100%">
    <thead style="padding: 0; margin: 0; border: none;">
        <tr style="border-bottom: 1px solid #e8e8e8;">
            <th style="font-weight: 700; border-right: 1px solid #e8e8e8; padding: 5px;">Field</th>
            <th style="font-weight: 700; border-right: none; padding: 5px;">Value</th>
        </tr>
    </thead>
    <tbody>
      @foreach($model as $key => $value)
        @if(!in_array($key,$skip))
          @php 
          $bg_color = '#ffffff';
          if($index % 2 == 0){
            $bg_color = '#f8f8f8';
          }
          $index++;

          @endphp
          <tr style="border-bottom: 1px solid #e8e8e8; background-color: {{$bg_color}};" bgcolor="{{$bg_color}}">
            <td style="border-right: 1px solid #e8e8e8; padding: 5px;">{{ str_replace('_', ' ', ucwords(@$key)) }}</td>
            <td style="border-right: none; padding: 5px;">{{ @$value }}</td>
          </tr>
        @endif
      @endforeach
    </tbody>
</table>