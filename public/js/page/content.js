
function get_content() {

    server('page/content', {
        pageid: pageid()
    }).then(
        (resolve) => {
            unselect_section();
            unselect_article();

            let container = document.querySelector('.articles');
            container.innerHTML = resolve;

            if (username() !== '') {

                for (let i = 0; i < container.childElementCount; i++) {
                    let article = container.children[i];
                    article.addEventListener('mousedown', (e) => {
                        if (e.target.tagName === 'ARTICLE') {
                            entering_article(e.target);
                            let section = selected_section();
                            if( section ) {
                                remove_class(section,'active-section');
                                unselect_section();
                            }
                        }
                    });
                    for (let j = 0; j < article.childElementCount; j++) {
                        let section = article.children[j];
                        if (section.type === 'image') {
                            let img = section.querySelector('img');
                            if (is_valid(img)) {
                                img.addEventListener('mousewheel', resize_img_by_wheel);
                            }
                        }
                        section.addEventListener('mousedown', (e) => {
                            if (e.target.tagName === 'SECTION') {
                                entering_section(e.target);
                                let article = selected_article();
                                if( article ) {
                                    remove_class(article, 'active-article');
                                    unselect_article();
                                }
                                
                            }
                        });
                    }
                }
            }
        }
    )
}



