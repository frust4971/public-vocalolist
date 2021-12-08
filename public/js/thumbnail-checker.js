function checkImg() {
    let replaceThumbnails = [];
    let thumbnails = document.querySelectorAll('.youtube-thumbnail');
    thumbnails.forEach(function (thumbnail) {
        //1280px�œǂ݂��߂ĂȂ�������G���[�p�̉摜�Ԃ���Ă���Ɣ��f
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

