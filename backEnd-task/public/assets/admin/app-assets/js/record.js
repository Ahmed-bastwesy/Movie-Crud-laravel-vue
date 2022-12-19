var record = document.querySelector(".record-btn")
var stop = document.querySelector(".stop-btn")
var soundClips = document.querySelector(".soundClips")
var send = document.querySelector(".send-btn")
var delete_btn = document.querySelector(".delete-btn")

document.addEventListener("DOMContentLoaded", function(event) { 
    if (navigator.mediaDevices) {
        var constraints = { audio: true };
        var chunks = [];
        navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
            var mediaRecorder = new MediaRecorder(stream);
            record.onclick = function() {
                document.getElementById("stop_btn").classList.remove("d-none");
                document.getElementById("record_btn").classList.add("d-none");
                mediaRecorder.start();
            }
            stop.onclick = function() {
                mediaRecorder.stop();
                document.getElementById("send_btn").classList.remove("d-none");
                document.getElementById("delete_btn").classList.remove("d-none");
                document.getElementById("stop_btn").classList.add("d-none");
            }
            mediaRecorder.onstop = function(e) {
                var clipName = 'record_' + Math.floor(Math.random() * 100) + 1;
                var clipContainer = document.createElement('article');
                var clipLabel = document.createElement('p');
                clipLabel.classList.add("p_style");
                var audio = document.createElement('audio');
                clipContainer.classList.add('clip');
                clipContainer.style.clear = "both";
                audio.setAttribute('controls', '');
                clipLabel.innerHTML = clipName+'.mp3';
                send.title = clipName+'.mp3';
                clipContainer.appendChild(audio);
                clipContainer.appendChild(clipLabel);
                soundClips.appendChild(clipContainer);
                audio.controls = true;
                var blob = new Blob(chunks, { 'type' : 'audio/mp3; codecs=opus' });
                chunks = [];
                var audioURL = URL.createObjectURL(blob);
                send.onclick = function(audioURL) {
                    $(this).parent().parent().parent().children(".soundClips").children("article").remove();
                    document.getElementById("record_btn").classList.remove("d-none");
                    document.getElementById("stop_btn").classList.add("d-none");
                    document.getElementById("delete_btn").classList.add("d-none");
                    document.getElementById("send_btn").classList.add("d-none");
                    var adv = send.dataset.adv;
                    var reader = new FileReader();
                    reader.readAsDataURL(blob); 
                    reader.onloadend = function() {
                        //ajax
                        var bas64_value = reader.result;
                        var url = _url_ + 'app/upload_record';
                        data = {
                            '_token' : _token_,
                            rec : bas64_value,
                            adv : adv
                        }
                        $.post(url,data,function(data){
                            if (data == true) {
                                alert(_success_);
                                // window.location.reload();
                            }
                        });
                    }
                }
                audio.src = audioURL;
                delete_btn.onclick = function(e) {
                    $(this).parent().parent().parent().children(".soundClips").children("article").remove();
                    document.getElementById("record_btn").classList.remove("d-none");
                    document.getElementById("stop_btn").classList.add("d-none");
                    document.getElementById("delete_btn").classList.add("d-none");
                    document.getElementById("send_btn").classList.add("d-none");
                }
            }
            mediaRecorder.ondataavailable = function(e) {
                chunks.push(e.data);
            }
        })
        .catch(function(err) {
            console.log('The following error occurred: ' + err);
        })
    }else{
        $(".rec_button").hide();
    }
});