
$('document').ready(function()  {
	let numberOfImages = 8;
	for (let i = 1;i <= numberOfImages;i++) {
		$("#slider .buttons ul").append(`
			<li ${(i == 1) ? 'class="active"' : ''} data-img="${i}"></li>
		`);
	}
	$("#slider .buttons ul li").click(function() {
		let id = $(this).attr('data-img');
		$("#slider .image").attr('src', `../srcs/images/${id}.jpg`);
		$("#slider .active").removeClass('active');
		$(this).addClass('active');
	});
});



// var i = 0;
// var list_src = ['../srcs/images/1.jpg', '../srcs/images/2.jpg', '../srcs/images/3.jpg', '../srcs/images/4.jpg', '../srcs/images/5.jpg', '../srcs/images/6.jpg', '../srcs/images/7.jpg', '../srcs/images/8.jpg'];
// var src = '';
// function change_src_img() {
// 	src = list_src[i];
// 	$('#slider').attr('src', list_src[i]);
// 	i = i + 1;
// 	if (i >= 2) {
// 		i = 0;
// 	}
// }

// setInterval(change_src_img, 3000);