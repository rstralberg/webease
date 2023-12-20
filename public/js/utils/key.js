
function get_key() {
    let e = document.querySelector('#_key');
    if( !is_valid(e)) return false;
    return e.value;
}
