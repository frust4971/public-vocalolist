function checkImg() {
    let replaceThumbnails = [];
    let thumbnails = document.querySelectorAll('.youtube-thumbnail');
    thumbnails.forEach(function (thumbnail) {
        //‰¡•‚ª120px‚¾‚Á‚½‚çƒGƒ‰[—p‚Ì‰æ‘œ•Ô‚³‚ê‚Ä‚¢‚é‚Æ”»’f
        if (thumbnail.naturalWidth == 120) {
            replaceThumbnails.push(thumbnail);
        }
    })
    if (replaceThumbnails.length != 0) {
        for (const thumbnail of replaceThumbnails) {
            replaceImg(thumbnail);
        }
    }
}
function replaceImg(thumbnail) {
    thumbnail.src = thumbnail.src.replace('maxresdefault','mqdefault');
}
checkImg();

