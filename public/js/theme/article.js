function theme_article() {

    server('theme/article', {
        theme: get_style('theme')
    }).then(
        (resolve) => {
            add_form('article-form', resolve);
        }
    )
}

function close_theme_article() {
    remove_form('article-form');
    server('theme/update', {
        theme: get_style('theme'),
        cols: [
            'articleW',
            'articleMargin',
            'articleBg', 
            'articleBorder', 
            'articleBorderColor', 
            'articleShadow'
        ],
        values: [
            get_style('articleW'),
            get_style('articleMargin'),
            get_style('articleBg'), 
            get_style('articleBorder'),
            get_style('articleBorderColor'),
            get_style('articleShadow')
        ]});
}

function update_articleW(element) {
    set_style('articleW', element.value + '%');
}

function update_articleMargin(element) {
    set_style('articleMargin', element.value + 'vh');
}

function update_articleBg(element) {
    set_style('articleBg', element.value);
}

function update_articleBorder(element) {
    set_style('articleBorder', element.checked ? '1' : '0');
}

function update_articleBorderColor(element) {
    set_style('articleBorderColor', element.value );
}

function update_articleShadow(element) {
    set_style('articleShadow', element.checked ? '1' : '0');
}

