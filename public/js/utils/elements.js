

function enable_element(id, enable) {
    if (enable) document.getElementById(id).removeAttribute('disabled');
    else document.getElementById(id).setAttribute('disabled', '');
}

function enable_tool(id, enable, icon) {
    let tool = document.getElementById(id);
    if( !is_valid(tool)) return;

    if( enable )  {
        tool.src = 'icons/white/' + icon + '.svg';
        tool.removeAttribute('disabled');
    }
    else {
        tool.src = 'icons/gray/' + icon + '.svg';
        tool.setAttribute('disabled', '');
    }
}

function toggle_display(element, expr = 'block') {
    if (element.style.display === 'none' || element.style.display === '')
        element.style.display = expr;
    else
        element.style.display = 'none';
}

function is_valid(v) {
    if (v === null) return false;
    if (typeof v === 'undefined') return false;
    if (typeof v === 'number' && isNaN(v)) return false;
    if (typeof v === 'array' && v.length === 0) return false;
    return true;
}

function add_class(element, class_name) {
    if (!is_valid(element) || !is_valid(element.classList)) {
        console.error('add_class ' + class_name);
        return;
    }
    if (element.classList.contains(class_name)) return;
    element.classList.add(class_name);
}

function remove_class(element, class_name) {
    if (!is_valid(element) || !is_valid(element.classList)) {
        console.error('remove_class ' + class_name );
        return;
    }
    if (!element.classList.contains(class_name)) return;
    element.classList.remove(class_name);
}

function replace_class(element, old_class, new_class) {
    if (!is_valid(element) || !is_valid(element.classList)) {
        console.error('replace_class ' + old_class + ' to ' + new_class);
        return;
    }
    if (element.classList.contains(old_class)) element.classList.remove(old_class);
    if (element.classList.contains(new_class)) return;
    element.classList.add(new_class);
}

function toggle_class(element, class_name) {
    if (!is_valid(element) || !is_valid(element.classList)) {
        console.error('toggle_class ' + class_name);
        return;
    }
    if (element.classList.contains(class_name)) element.classList.remove(class_name);
    else element.classList.add(class_name);
}

function get_child_pos(section) {
    let container = section.parentElement;
    let pos = 0;
    if( container.childElementCount === 0) return pos;
    for (; pos < container.childElementCount; pos++) {
        if (container.children[pos].id === section.id) {
            break;
        }
    }
    return pos;
}

