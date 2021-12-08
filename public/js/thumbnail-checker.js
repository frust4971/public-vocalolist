function checkImg() {
    let replaceThumbnails = [];
    let thumbnails = document.querySelectorAll('.youtube-thumbnail');
    thumbnails.forEach(function (thumbnail) {
        //������120px��������G���[�p�̉摜�Ԃ���Ă���Ɣ��f�B0�̏ꍇ������
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

