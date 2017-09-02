
		<div class="abc">test</div>
		{{-- {!!Form::time(str_replace(' ','_',strtolower($collection->field_title)), null,['id'=>'input_'.$collection->field_slug,'class'=>'timepicker '.$collection->field_slug])!!} --}}
		
{{-- <button onclick="getLocation()">Try It</button> --}}

<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}
</script>