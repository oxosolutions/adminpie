<div class="aione-widget-wrapper no-padding">
	<div class="analog-clock">
<svg width="200" height="200">

    <filter id="innerShadow" x="-20%" y="-20%" width="140%" height="140%">
        <feGaussianBlur in="SourceGraphic" stdDeviation="3" result="blur"/>
        <feOffset in="blur" dx="2.5" dy="2.5"/>
    </filter>

    <g>
        <circle id="shadow" style="fill:rgba(0,0,0,0.1)" cx="97" cy="100" r="87" filter="url(#innerShadow)"></circle>
        <circle id="circle" style="stroke: #FFF; stroke-width: 12px; fill:#20B7AF" cx="100" cy="100" r="80"></circle>
    </g>
    <g>
        <line x1="100" y1="100" x2="100" y2="55" transform="rotate(80 100 100)" style="stroke-width: 3px; stroke: #fffbf9;" id="hourhand">
            <animatetransform attributeName="transform"
                              attributeType="XML"
                              type="rotate"
                              dur="43200s"
                              repeatCount="indefinite"/>
        </line>
        <line x1="100" y1="100" x2="100" y2="40" style="stroke-width: 4px; stroke: #fdfdfd;" id="minutehand">
            <animatetransform attributeName="transform"
                              attributeType="XML"
                              type="rotate"
                              dur="3600s"
                              repeatCount="indefinite"/>
        </line>
        <line x1="100" y1="100" x2="100" y2="30" style="stroke-width: 2px; stroke: #C1EFED;" id="secondhand">
            <animatetransform attributeName="transform"
                              attributeType="XML"
                              type="rotate"
                              dur="60s"
                              repeatCount="indefinite"/>
        </line>
    </g>
    <circle id="center" style="fill:#128A86; stroke: #C1EFED; stroke-width: 2px;" cx="100" cy="100" r="3"></circle>
</svg>
	  
	</div>
</div>


<script>
var hands = [];
hands.push(document.querySelector('#secondhand > *'));
hands.push(document.querySelector('#minutehand > *'));
hands.push(document.querySelector('#hourhand > *'));

var cx = 100;
var cy = 100;

function shifter(val) {
  return [val, cx, cy].join(' ');
}

var date = new Date();
var hoursAngle = 360 * date.getHours() / 12 + date.getMinutes() / 2;
var minuteAngle = 360 * date.getMinutes() / 60;
var secAngle = 360 * date.getSeconds() / 60;

hands[0].setAttribute('from', shifter(secAngle));
hands[0].setAttribute('to', shifter(secAngle + 360));
hands[1].setAttribute('from', shifter(minuteAngle));
hands[1].setAttribute('to', shifter(minuteAngle + 360));
hands[2].setAttribute('from', shifter(hoursAngle));
hands[2].setAttribute('to', shifter(hoursAngle + 360));

for(var i = 1; i <= 12; i++) {
  var el = document.createElementNS('http://www.w3.org/2000/svg', 'line');
  el.setAttribute('x1', '100');
  el.setAttribute('y1', '30');
  el.setAttribute('x2', '100');
  el.setAttribute('y2', '40');
  el.setAttribute('transform', 'rotate(' + (i*360/12) + ' 100 100)');
  el.setAttribute('style', 'stroke: #ffffff;');
  document.querySelector('svg').appendChild(el);
}
</script>
<style>
#aione_widget_analog-clock{
  background-color: rgba(212, 251, 173, 0.8);
  background-image: linear-gradient(to right bottom, rgba(212, 251, 173, 0.8) 0%, rgba(0, 188, 212, 0.5) 100%);
  background-image: linear-gradient(to right bottom, rgba(212, 251, 173, 0.8) 0%, rgba(0, 188, 212, 0.5) 100%);
  background-image: linear-gradient(to right bottom, rgba(212, 251, 173, 0.8) 0%, rgba(0, 188, 212, 0.5) 100%);
  background-image: linear-gradient(to right bottom, rgba(212, 251, 173, 0.8) 0%, rgba(0, 188, 212, 0.5) 100%);
  background-image: linear-gradient(to right bottom, rgba(212, 251, 173, 0.8) 0%, rgba(0, 188, 212, 0.5) 100%);
}
svg {
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -100px;
  transform: scale(0.8,0.8);
}

.filler {
  background: #20B7AF;
  position: absolute;
  bottom: 50%;
  top: 0;
  left: 0;
  right: 0;
}
</style>