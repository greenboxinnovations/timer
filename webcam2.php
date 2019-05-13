<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	
	<style type="text/css">
		*{padding: 0;margin: 0;}
		/*#videoElement {
			width: 500px;
			height: 375px;
			background-color: #666;
		}*/
	</style>
</head>
<body>


<video autoplay="true" id="video" width="640" height="480"></video>

<!--   <div class="select">
    <label for="audioSource">Audio source: </label><select id="audioSource"></select>
  </div> -->

  <div class="select">
    <label for="videoSource">Video source: </label><select id="videoSource"></select>
  </div>

<button id="click_photo">Click Photo</button>
<canvas id="canvas" width="640" height="480"></canvas>



<script type="text/javascript">

'use strict';

var videoElement = document.querySelector('video');
// var audioSelect = document.querySelector('select#audioSource');
var videoSelect = document.querySelector('select#videoSource');

navigator.mediaDevices.enumerateDevices()
    .then(gotDevices).then(getStream).catch(handleError);

// audioSelect.onchange = getStream;
videoSelect.onchange = getStream;

function gotDevices(deviceInfos) {
  for (var i = 0; i !== deviceInfos.length; ++i) {



    var deviceInfo = deviceInfos[i];

    console.log(deviceInfo);


    if(deviceInfo.label != "UNICAM Rear"){
    	var option = document.createElement('option');
	    option.value = deviceInfo.deviceId;
	    // if (deviceInfo.kind === 'audioinput') {
	    //   option.text = deviceInfo.label ||
	    //     'microphone ' + (audioSelect.length + 1);
	    //   audioSelect.appendChild(option);
	    // } else 
	    if (deviceInfo.kind === 'videoinput') {
	      option.text = deviceInfo.label || 'camera ' +
	        (videoSelect.length + 1);
	      videoSelect.appendChild(option);
	    } else {
	      console.log('Found ome other kind of source/device: ', deviceInfo);
	    }
    }

	
  }
}

function getStream() {
  if (window.stream) {
    window.stream.getTracks().forEach(function(track) {
      track.stop();
    });
  }

  var constraints = {
    
    video: {
      optional: [{
        sourceId: videoSelect.value
      }]
    }
  };

  navigator.mediaDevices.getUserMedia(constraints).
      then(gotStream).catch(handleError);
}

function gotStream(stream) {
  window.stream = stream; // make stream available to console
  videoElement.srcObject = stream;
}

function handleError(error) {
  console.log('Error: ', error);
}
	</script>


</body>
</html>
