
		{{-- <div class="abc">test</div> --}}
		{{-- {!!Form::time(str_replace(' ','_',strtolower($collection->field_title)), null,['id'=>'input_'.$collection->field_slug,'class'=>'timepicker '.$collection->field_slug])!!} --}}
		
{{-- <button onclick="getLocation()">Try It</button> --}}

<p id="demo"></p>
<script type="text/javascript"
     src="http://maps.google.com/maps/api/js?sensor=true">
</script> 
<script>
var geocoder = new google.maps.Geocoder();
var address = document.getElementById("address").value;
geocoder.geocode( { 'address': address}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK)
  {
      // do something with the geocoded result
      //
      // results[0].geometry.location.latitude
      // results[0].geometry.location.longitude
  }
});
</script>