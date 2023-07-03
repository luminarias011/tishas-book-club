const searchBar = document.getElementById('searchBar');
searchBar.addEventListener('keyup', e => {
    let currentChar = e.target.value.toLowerCase();
    // console.log(currentChar);
    let booktitle = document.querySelectorAll('h3.choose');
    let bookauthor = document.querySelectorAll('p.choosAuthor');
    // let booktitle = document.querySelectorAll('h3.choose');
    booktitle.forEach(nd => {
        if (nd.textContent.toLowerCase().includes(currentChar)) {
            nd.parentNode.parentNode.parentNode.parentNode.style.display = 'flex';
        } else {
            nd.parentNode.parentNode.parentNode.parentNode.style.display = 'none';
        }
    });
    // bookauthor.forEach(nd => {
    //     if (nd.textContent.toLowerCase().includes(currentChar)) {
    //         nd.parentNode.parentNode.parentNode.parentNode.style.display = 'flex';
    //     } else {
    //         nd.parentNode.parentNode.parentNode.parentNode.style.display = 'none';
    //     }
    // });
    // booktitle.forEach(title => {
    //     if (title.textContent.toLowerCase().includes(currentChar)) {
    //         title.parentNode.parentNode.parentNode.parentNode.style.display = 'flex';
    //     } else {
    //         title.parentNode.parentNode.parentNode.parentNode.style.display = 'none';
    //     }
    // });
});