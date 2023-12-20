
// function attach_editor(article) {

//     // just for users logged in
//     if (!is_logged_in()) return;

//     // if user clicked on a child section 
//     if (!is_valid(article)) return;
//     if (article.tagName !== 'ARTICLE') {
//         if (article.tagName === 'SECTION' &&
//             is_valid(article.parentElement) &&
//             article.parentElement.tagName === 'ARTICLE') {
//             article = article.parentElement;
//         }
//         else {
//             // Some strangeness ... were leaving
//             return;
//         }
//     }

//     // avoid attaching twice
//     let active = get_active_article();
//     if (active && active.id === article.id) {
//         return;
//     }

//     // detach old selection
//     if( active.id !== article.id) {
//         // detach_editor(active);
//     }
//     set_active_article(article);

//     // let images = section.querySelectorAll('img');
//     // for (let i = 0; i < images.length; i++) {
//     //     let child = images[i];
//     //     child.addEventListener('wheel', (e) => { resize_img_by_wheel(e); });
//     // }
// }

