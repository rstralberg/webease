
function upload_image(fileFromInput, folder) {

    return new Promise((resolve, reject) => {

        let item = fileFromInput;
        let reader = new FileReader();
        reader.readAsDataURL(item);


        reader.onload = (event) => {

            var _a;
            var img = new Image();

            img.setAttribute('size', '' + item.size);
            img.onload = function (el) {
                if (el === null) return;
                if (el.target === null) return;

                let elem = document.createElement('canvas');

                //scale the image  and keep aspect ratio
                let maxsize = 2048;
                let eventTarget = el.target;
                let scaleFactor = maxsize / eventTarget.width;
                elem.width = maxsize;
                elem.height = eventTarget.height * scaleFactor;

                //draw in canvas
                let ctx = elem.getContext('2d');
                if (ctx === null) return;
                ctx.drawImage(eventTarget, 0, 0, elem.width, elem.height);

                //get the base64-encoded Data URI from the resize image
                let srcEncoded = ctx.canvas.toDataURL(item.type, 1);

                //note: remember that the image is now base64-encoded Data URI
                //sendind the image to the server (php)

                var fd = new FormData();
                fd.append("image", srcEncoded);
                fd.append('key', key());
                fd.append('folder', folder);
                fd.append('name', fileFromInput.name);

                let types = item.type.split('/');
                fd.append('type', types[1]);

                //sending data to the server
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = () => {
                    //everything is ok
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        resolve(response);
                    }
                };
                xhr.open("POST", "php/image.php");
                xhr.send(fd);
            };
            img.src = (_a = event.target) === null || _a === void 0 ? void 0 : _a.result;
        };
    });
}

function audio_path(audiofile) {
    return 'sites/' + key() + '/' + pageid() + '/' + audiofile;
}

function upload_mp3(fileFromInput) {

    return new Promise((resolve, reject) => {

        let fd = new FormData();
        fd.append('folder', pageid());
        fd.append('key', key());
        fd.append('mp3', fileFromInput);

        fetch('php/mp3.php', {
            method: 'POST',
            headers: new Headers({ 'content-type': 'audio/mp3' }),
            mode: 'no-cors',
            body: fd
        })
            .then(response => {
                let r = response.json();
                resolve(r);
            })
            .catch(err => {
                error(err);
                reject(err);
            });
    });
}

function upload_movie(fileFromInput) {

    return new Promise((resolve, reject) => {

        let fd = new FormData();
        fd.append('folder', pageid());
        fd.append('key', key());
        fd.append('mov', fileFromInput);

        fetch('php/video.php', {
            method: 'POST',
            headers: new Headers({ 'content-type': 'video/quicktime' }),
            mode: 'no-cors',
            body: fd
        })
            .then(response => {
                let r = response.json();
                resolve(r);
            })
            .catch(err => {
                error(err);
                reject(err);
            });
    });
}
