function toggle(source) {
    let checkboxes = document.getElementsByClassName('checkbox');
    let i = 0, n = checkboxes.length;
    for(; i<n; i++) {
        checkboxes[i].checked = source.checked;
    }
}