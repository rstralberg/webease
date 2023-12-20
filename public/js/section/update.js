function update_selected(selected) {
    if (is_valid(selected)) {
        let type = selected.getAttribute('type');
        if (type === 'article') {
            update_article(selected);
        }
        else {
            update_section(selected);
        }
    }
}


function update_section(section) {

    section.style.backgroundColor = 'red';
    server('section/update', {
        id: parseInt(section.id.substring(1)),
        pos: get_child_pos(section),
        align: section.style.justifyContent,
        content: encodeURIComponent(section.innerHTML)
    }).then(
        () => {
            section.style.backgroundColor = get_style('sectionHoverBg');
            // get_content();
        }
    );
}

function update_article(article) {

    article.style.backgroundColor = 'red';
    server('article/update', {
        id: parseInt(article.id.substring(1)),
        pos: get_child_pos(article)
    }.then(
        () => {
            article.style.backgroundColor = get_style('articleBg');
            get_content();
        }
    ));
}


function update_section_positions(article) {

    let items = new Array();
    let pos = 0;
    for( ; pos < article.childElementCount; pos++ ) {
        let section = article.children[pos];
        items.push( { 
            id: parseInt(section.id.substring(1)),
            pos: pos
        });
    }
    server('section/positions', {
        items: JSON.stringify(items)
    });
}

