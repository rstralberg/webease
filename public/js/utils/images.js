
function resize_img_by_wheel(e) {
    // e.preventDefault();
    if (is_valid(e)) {
        let w = e.target.clientWidth;
        w += e.deltaY > 0 ? 10 : -10;
        e.target.style.width = w + 'px';
    }
}


function image_path(folder, imagefile) {
    return  'sites/' + key() + '/' + folder + '/' + imagefile;
}

function image_user_path(imagefile) {
    return  'sites/' + key() + '/users/' + imagefile;
}

function image_page_path(imagefile) {
    return image_path( pageid() , imagefile);
}