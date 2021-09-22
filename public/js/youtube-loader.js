function loadYouTube() {
    var youtubeIframes = document.querySelectorAll('.youtube');
    youtubeIframes.forEach(function (youtubeIframe) {
        if (youtubeIframe.getAttribute('data-src')) {
            youtubeIframe.setAttribute('src', youtubeIframe.getAttribute('data-src'));
        }
    })
}
window.addEventListener('load', loadYouTube);
