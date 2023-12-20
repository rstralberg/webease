function add_article() {

    let container = document.querySelector('.articles');
    server('article/add', {
        pageId: pageid(),
        pos: container.childElementCount
    }).then(
        () => {
            get_content();
        });
}
