
var paginationDiv = document.querySelector(".latest-news__pagination");
paginationDiv.innerHTML = '<a href="#" class="btn load-more">Load more</a>';
var newsDiv = document.querySelector(".latest-blocks__container");
newsDiv.innerHTML = "";
var pageNumber = 1,
    fetchNews = function (e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "";
        fetch(newsglobal.news_api + "?page=" + e + "&cat=" + t)
            .then(function (e) {
                return e.json();
            })
            .then(function (e) {
                var t = [];
                e.forEach(function (e) {
                    t.push(
                        '<div class="flex items-stretch w-full md:w-[49%] lg:w-[32%]">' + 
                            '<a href="' + e.link + '" class="relative flex flex-wrap justify-start bg-white  border-b-4 group border-b-primary-dark hover:bg-gray-200 focus:bg-gray-200">' +
                                '<div class="relative w-full overflow-hidden grow-0">' +
                                    e.img +
                                '</div>' +
                                '<div class="p-6 grow-1">' +
                                    '<span class="block mb-2 leading-tight text-black uppercase text-md md:text-md">' + e.cat + '</span>' +
                                    '<span class="block mb-4 text-lg font-bold leading-tight text-black md:text-xl">'+ e.title + '</span>' +
                                    '<span class="text-sm">' + e.excerpt + '</span>' +
                                '</div>' +
                                '<div class="card-arrow"></div>' +
                                "<svg class='absolute bottom-2 right-2 text-white text-xl icon icon-angle-up'><use xlink:href='" +
                                themeURL.themeURL +
                                "/_assets/images/icons-sprite.svg#icon-arrow-right'></use></svg>" +
                            '</a>' +
                        '</div>\n\t\t\t'
                    );
                }),
                    6 <= t.length ? (paginationDiv.hidden = !1) : (paginationDiv.hidden = !0);
                var n = document.createElement("div");
                (n.className = "flex flex-wrap w-full gap-6 latest-blocks__container"), (n.innerHTML = t.join(" ")), newsDiv.appendChild(n);
            })
            .catch(function (e) {
                paginationDiv.innerHTML = '<a href="#" class="load-more">No more posts</a>';
            }),
            pageNumber++;
    };
fetchNews(pageNumber);
var loadMore = document.querySelector(".load-more");
loadMore.addEventListener("click", function (e) {
    e.preventDefault(), fetchNext();
});
var newsFilter = document.querySelector(".news-filter");
newsFilter.addEventListener("change", function () {
    (pageNumber = 1), (newsDiv.innerHTML = ""), fetchNext();
    fetchNews(pageNumber, stringMatch[0])
});


var fetchNext = function () {
    newsFilter.value.length <= 3 ? fetchNews(pageNumber, newsFilter.value) : fetchNews(pageNumber);
};

//if query string has cat in it do this else do this

if (window.location.search) {
    //possible more modern ways of doing this but this method works without a polyfill
    var stringSearch = window.location.search
    var stringMatch = stringSearch.match(/(\d+)/)

    //change the select
    newsFilter.value = stringMatch[0]

    //trigger it
    fetchNews(pageNumber, stringMatch[0])
} else {
    fetchNews(pageNumber);
}
