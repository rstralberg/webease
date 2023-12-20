
function update_list(section) {
    /*
        <ul style="list-style:disc">
            <li>....</li>
            <li>....</li>
        </ul>
    */

    let element = section.querySelector('ul');
    if( !is_valid(element)) return;
    let style = element.style.listStyle;

    let items = new Array();
    for(let i=0; i < element.childElementCount; i++) {
        let li = element.children[i];
        items.push(li.innerText);
    }


    server('update/section', {
        id: section.id,
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: JSON.stringify( {
            style: style,
            items: items
        })
    });
    
}