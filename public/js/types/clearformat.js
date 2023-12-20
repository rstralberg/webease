function normal_text() {
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

    if (is_valid(node.parentNode) && node.parentNode.nodeName !== 'SECTION') {
        let tagElement = node.parentElement;
        let textNode = tagElement.firstChild;
        tagElement.parentNode.replaceChild(textNode, tagElement);
    }
}
