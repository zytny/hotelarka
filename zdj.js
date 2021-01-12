function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#av').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
}
  
$("#av_upl").change(function() {
    readURL(this);
})

function readURLs(input) {
    var f = $("#zdjecia_pok")[0].files;
    var l = f.length;
    var pic = document.getElementById("pic");
	pic.innerHTML = "";
	
    var readery = [];
    
    for(var i = 0; i < l; i++){
        readery[i] = new FileReader();
        readery[i].onload = function(e) {
            var img = new Image();
            img.src = e.target.result;
			img.width = 200;
            img.height = 150;
			img.class = 'zdj';
            pic.appendChild(img);
        };
        readery[i].readAsDataURL(f[i]);
    }
}
  
$("#zdjecia_pok").change(function() {
    readURLs(this);
})

