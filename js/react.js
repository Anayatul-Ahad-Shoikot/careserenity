function storeScrollPosition(formId) {
    const form = document.getElementById(formId);
    const scrollPosition = window.scrollY || window.pageYOffset;
    sessionStorage.setItem(formId, scrollPosition);
}
document.addEventListener("DOMContentLoaded", function () {
    const likeFormScroll = sessionStorage.getItem("LIKE");
    const commentFormScroll = sessionStorage.getItem("COMMENT");
    if (likeFormScroll !== null) {
        window.scrollTo(0, likeFormScroll);
        sessionStorage.removeItem("LIKE");
    } else if (commentFormScroll !== null) {
        window.scrollTo(0, commentFormScroll);
        sessionStorage.removeItem("COMMENT");
    }
});
