
function resize_img_by_wheel(e) {
    // e.preventDefault();
    if (is_valid(e)) {
        let w = e.target.clientWidth;
        w += e.deltaY > 0 ? 10 : -10;
        e.target.style.width = w + 'px';
    }
}


function image_path(folder, imagefile) {
    return 'sites/' + key() + '/' + folder + '/' + imagefile;
}

function image_user_path(imagefile) {
    return 'sites/' + key() + '/users/' + imagefile;
}

function image_page_path(imagefile) {
    return image_path(pageid(), imagefile);
}


function load_scale_image(image_path, maxWidth, maxHeight) {

    return new Promise( (resolve, _reject) => {

        let img = document.createElement('img');
        img.addEventListener( 'load', (e) => {
        
            let canvas = document.createElement('canvas');
            let ctx = canvas.getContext('2d');
    
            // Calculate new dimensions while maintaining aspect ratio
            let width = e.target.width;
            let height = e.target.height;
    
            if (width > maxWidth) {
                height *= maxWidth / width;
                width = maxWidth;
            }
    
            if (height > maxHeight) {
                width *= maxHeight / height;
                height = maxHeight;
            }
    
            canvas.width = width;
            canvas.height = height;
    
            // Draw the image onto the canvas
            ctx.drawImage(img, 0, 0, width, height);
    
            let ext = img.src.split('.').pop();
    
            e.target.src = canvas.toDataURL('image/' + ext);
            resolve(e.target);
        });
        img.src = image_path;
    });
}

function calc_image_scale(img, maxWidth, maxHeight) {

    let canvas = document.createElement('canvas');
    let ctx = canvas.getContext('2d');

    // Calculate new dimensions while maintaining aspect ratio
    let width = img.width;
    let height = img.height;

    if (width > maxWidth) {
        height *= maxWidth / width;
        width = maxWidth;
    }

    if (height > maxHeight) {
        width *= maxHeight / height;
        height = maxHeight;
    }

    ctx.drawImage(img, 0, 0, width, height);

    return {
        w: Math.floor(width),
        h: Math.floor(height)
    };
}

var zoomedImage = null;

function zoom_image(img, scale) {
    if (!is_valid(img) ) return; 

    if (img.style.transform == "scale(1)" || img.style.transform == "") {
        img.style.transform = "scale(" + scale + ")";
        img.style.zIndex = (parseInt(img.style.zIndex, 10) + 1).toString();
        img.alt = img.style.zIndex;
        if (zoomedImage) {
            zoomedImage.style.zIndex = zoomedImage.style.zIndex - 1;
        }
        zoomedImage = img;
        zoomedImage.alt = zoomedImage.style.zIndex;
    } else {
        img.style.transform = "scale(1)";
        img.style.zIndex = img.style.zIndex - 1;
        zoomedImage = null;
    }
    img.style.transition = "transform 0.25s ease";
    if (img.style.zIndex < 1)
        img.style.zIndex = 1;
}
