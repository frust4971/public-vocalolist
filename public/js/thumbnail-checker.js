function checkImg() {
    let replaceThumbnails = [];
    let thumbnails = document.querySelectorAll('.youtube-thumbnail');
    thumbnails.forEach(function (thumbnail) {
        //1280pxで読みこめてなかったらエラー用の画像返されていると判断
        if (thumbnail.naturalWidth != 1280) {
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

