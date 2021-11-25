function checkImg() {
    let replaceThumbnails = [];
    let thumbnails = document.querySelectorAll('.youtube-thumbnail');
    thumbnails.forEach(function (thumbnail) {
        //横幅が120pxだったらエラー用の画像返されていると判断。0の場合もある
        if (thumbnail.naturalWidth == 120 || thumbnail.naturalWidth == 0) {
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
window.onload = checkImg();

