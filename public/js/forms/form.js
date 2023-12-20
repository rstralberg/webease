
let offsetX = 0;
let offsetY = 0 ;
let isDragging = false;

function add_form(form_id, html, width = 0) {

    if( is_valid( document.getElementById(form_id) ) ) return;

    let body = document.querySelector('body');

    let container = document.createElement('form');

    container.id = form_id;

    container.style.position = 'fixed';
    container.style.top = '10vh';
    container.style.zIndex = 2000;
    if( width > 0 ) {
        container.style.width = width + 'vw';
    }
    
    container.innerHTML = '<h1 class="form-banner"></h1>'  + html;

    offsetX = 0;
    offsetY = 0;
    isDragging = false;

    container.addEventListener('mousedown', (e) => {
        isDragging = true;
        offsetX = e.clientX - e.target.getBoundingClientRect().left;
        offsetY = e.clientY - e.target.getBoundingClientRect().top;
    });
    
    container.addEventListener('mousemove', (e) => {
        if ( isDragging ) {
            let x = e.clientX - offsetX;
            let y = e.clientY - offsetY;

            e.target.style.left = x + 'px';
            e.target.style.top = y + 'px';
        }
    });
    
    container.addEventListener('mouseup', (e) => {
        isDragging = false;
    });

    container.addEventListener('mouseleave', (e) => {
        isDragging = false;
    });

    body.appendChild(container);
    return container;
}


function remove_form(form_id) {
    let container = document.getElementById(form_id);
    if (is_valid(container)) {
        container.removeEventListener('mousedown', (e) => { });
        container.removeEventListener('mousemove', (e) => { });
        container.removeEventListener('mouseup', (e) => { });
        container.removeEventListener('click', (e) => { });
        container.removeEventListener('dblclick', (e) => { });
        container.remove();
        container = null;
    }
}