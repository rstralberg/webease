
// Yes! I know.. but its very handy :)

function pageid() {
    return parseInt(document.getElementById('_pageid').value);
}

function show_title() {
    return document.getElementById('_showtitle').value === '1';
}

function author() {
    return document.getElementById('_author').value;
}

function username() {
    return document.getElementById('_username').value;
}

function set_username(username) {
    return document.getElementById('_username').value = username;
}

function is_adm() {
    return document.getElementById('_adm').value === '1';
}

function set_adm(adm) {
    document.getElementById('_adm').value = parseInt(adm) === 1 ? '1' : '0';
}

function key() {
    return document.getElementById('_key').value;
}

function selected_section() {
    if (document.getElementById('_section').value.length === 0) return false;
    let id = document.getElementById('_section').value;
    let active = document.getElementById(id);
    return is_valid(active) ? active : false;
}

function select_section(element) {
    
    document.getElementById('_section').value = is_valid(element) ? element.id : '';
}

function unselect_section() {
    document.getElementById('_section').value = '';
}

function selected_article() {
    if (document.getElementById('_article').value.length === 0) return false;
    let id = document.getElementById('_article').value;
    let active = document.getElementById(id);
    return is_valid(active) ? active : false;
}

function select_article(element) {
    
    document.getElementById('_article').value = is_valid(element) ? element.id : '';
}

function unselect_article() {
    
    document.getElementById('_article').value = '';
    
}

