
function show_user_tools(user) {
    if (user !== '') {
        let tools = document.getElementById('user-tools');
        if (is_valid(tools)) {
            tools.style.display = user.username !== '' ? 'flex' : 'none';
        }
    }
    enable_add_tool(false);
    enable_article_tools(false);
    enable_delete_tool(false);
    enable_link_tool(false);
    enable_move_tools(false);
    enable_section_tools(false);
    enable_text_tools(false);
    enable_shadow_tool(false);
}

function enable_text_tools(enable) {
    enable_tool('t-hr', enable, 'hr');
    enable_tool('t-clear_format', enable, 'clear_format');
    enable_tool('t-pages', enable, 'pages');
    enable_tool('t-italic', enable, 'italic');
    enable_tool('t-bold', enable, 'bold');
}

function enable_section_tools(enable) {
    enable_tool('t-left', enable, 'left');
    enable_tool('t-center', enable, 'center');
    enable_tool('t-right', enable, 'right');
}

function enable_shadow_tool(enable) {
    enable_tool('t-shadow', enable, 'shadow');
}

function enable_link_tool(enable) {
    enable_tool('t-link', enable, 'link');
}

function enable_move_tools(enable) {
    enable_tool('t-up', enable, 'up');
    enable_tool('t-down', enable, 'down');
}

function enable_article_tools(enable) {
    enable_tool('t-audio', enable, 'audio');
    enable_tool('t-youtube', enable, 'youtube');
    enable_tool('t-spotify', enable, 'spotify');
    enable_tool('t-soundcloud', enable, 'soundcloud');
    enable_tool('t-image', enable, 'image');
    enable_tool('t-title', enable, 'title');
    enable_tool('t-text', enable, 'text');
    enable_tool('t-theme', enable, 'palette');
    enable_tool('t-list', enable, 'list');
}

function enable_delete_tool(enable) {
    enable_tool('t-delete', enable, 'delete');
}

function enable_add_tool(enable) {
    enable_tool('t-add', enable, 'add');
}