
jQuery(document).ready(function () {
getRelatedRoom()
   jQuery(document).on('click', '#find-btn', function () {
        jQuery('html, body').animate({
            scrollTop: jQuery(".feautured-condo").offset().top
        }, 2000)
    })
})

var room_posts = [];
var url_website_shop = 'http://dss.local/wp-json/wp/v2/condominium';
const allshop_url = 'http://dss.local/wp-json/wp/v2/condominium';


// // get its slug
// function getSlugPosts(){
//     var href = window.location.href;
// 	var splited_href = href.split('/');
//     let child_slug = splited_href[splited_href.length - 2];
//  	var slug = { child_slug }
//     return slug;
// }

// // get their own id after slug split
// function getIDPosts(post){
//     return jQuery.ajax({
//         url: allshop_url + '?slug=' + post,
//     })
// }

// Exclude itself
function getRelatedRoom(){     
    var results = jQuery.ajax(allshop_url)
    results.done(function(data) {
        room_posts = data;
        renderRoom();
    })
}

function renderRoom(){
    let room_html = '';
    // Multi-Lange string
    // if ($('html').is(':lang(th)')) {
    //     langString = 'รายละเอียดเพิ่มเติม';
    // } else {
    //     langString = 'More Detail';
    // }
    room_html += '<div class = "container" style="max-width: 1220px; width: 100%;">'
    room_html += '<div class = "row pr9-cards--groups">'
    room_posts.forEach(function (element) {
        room_html += '<div class = "col-lg-4 col-md-4">'
		room_html += '<div class = "pr9-cards">'
        var room_img = element.featured_image_src;
        room_html += '<div class = "pr9-cards--img pr9-supergraphicimg">'
        room_html += '<img src="' + room_img + '" />';
        room_html += '</div>'
        room_html += '<div class = "pr9-cards--content">'
        room_html += '<div class="pr9-cards--title" value="' + element.id + '">' + element.title.rendered + '</div>';
		room_html += '<div class="pr9-cards--detail">' + element.content.rendered + '</div>';
        room_html += '<div class="pr9-cards--priceperdaily" value="' + element.id + '">' + (parseInt(element.acf.price)).toLocaleString() + ' ฿' + '</div>'
        room_html += '<div class="pr9-cards--priceperdaily" value="' + element.id + '">' + element.acf.bedroom + ' Bedroom' + '</div>'
        room_html += '<div class="pr9-cards--priceperdaily" value="' + element.id + '">' + element.acf.size + ' Sq.M' + '</div>'
        room_html += '<div class="pr9-cards--priceperdaily" value="' + element.id + '">' + element.acf.resident_number + ' People' + '</div>'
        room_html += '<div class="pr9-cards--priceperdaily" value="' + element.id + '">' + element.acf.nearby_btsmrt + ' Station' + '</div>'
        room_html += '<div class = "pr9-cards--footer"><a href="' + element.link + '" class="pr9-btn--moredetail">' + ' More Detail' + '</a></div>'
        room_html += '</div>'
		room_html += '</div>'
        room_html += '</div>'
    })
    	room_html += '</div>'
	    room_html += '</div>'
    jQuery('.related_room').html(room_html);
}


