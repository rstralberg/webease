
function get_style(name) {
    return getComputedStyle(document.querySelector('html')).getPropertyValue('--' + name);
}

function set_style(name, value) {
    document.documentElement.style.setProperty('--' + name, value);
}

function split_border(border) {

    let parts = border.split(' ');
    return {
        width: parseInt(parts[0]),
        style: parts[1],
        color: parts[2]
    };
}


function build_border(border) {
    return border.width + 'px ' + border.style + ' ' + border.color;
}
