
function toggle_tag(tagName) {

    let selection = window.getSelection();
    if (selection.rangeCount === 0) return;

    let range = selection.getRangeAt(0);
    if (!is_valid(range)) return;

    let node = null;
    if (range.startContainer === range.endContainer) {
        node = range.startContainer;
    }
    else {
        node = range.startContainer.nextSibling;
    }

    tagName = tagName.toUpperCase();
    if (is_valid(node.parentNode) && node.parentNode.nodeName === tagName) {
        let tagElement = node.parentElement;
        let textNode = tagElement.firstChild;
        tagElement.parentNode.replaceChild(textNode, tagElement);
    }
    else {
        let tagElement = document.createElement(tagName);
        range.surroundContents(tagElement);
    }
}

function add_tag(tagName) {

    let selection = window.getSelection();
    if (selection.rangeCount === 0) return;

    let range = selection.getRangeAt(0);
    if (!is_valid(range)) return;

    let node = null;
    if (range.startContainer === range.endContainer) {
        node = range.startContainer;
    }
    else {
        node = range.startContainer.nextSibling;
    }

    tagName = tagName.toUpperCase();
    if (is_valid(node.parentNode) && node.parentNode.nodeName === tagName) {
        return;
    }
    let tagElement = document.createElement(tagName);
    range.surroundContents(tagElement);
    return tagElement;
}

// returns true if tag was removed
function remove_tag(tagName) {

    let selection = window.getSelection();
    if (selection.rangeCount === 0) return false;

    let range = selection.getRangeAt(0);
    if (!is_valid(range)) return false;

    let node = null;
    if (range.startContainer === range.endContainer) {
        node = range.startContainer;
    }
    else {
        node = range.startContainer.nextSibling;
    }

    tagName = tagName.toUpperCase();
    if (is_valid(node.parentNode) && node.parentNode.nodeName === tagName) {
        let tagElement = node.parentElement;
        let textNode = tagElement.firstChild;
        tagElement.parentNode.replaceChild(textNode, tagElement);
        return true;
    }
    return false;
}

function get_selected_text() {
    let selected = '';
    if (window.getSelection) {
        selected = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        selected = document.selection.createRange().text;
    }
    return selected;
}
