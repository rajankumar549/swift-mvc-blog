// $(document).ready(function(){
// 	$("#post_submit").on("click",function(){
// 		debugger
// 	var post_title = $("#post_title").val().trim();
// 	var post_name = $("#post_name").val().trim();
// 	var post_email = $("#post_email").val().trim();
// 	var post_desc = $("#post_desc").val().trim();
// 	var email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

// 	var is_valid_email = email_regex.test(post_email);
// 	var is_valid_name = post_name.length>0?true:false;
// 	var is_valid_title = post_title.length>0?true:false;
// 	var is_valid_desc = post_desc.length>0?true:false;
// 	if(is_valid_email && is_valid_name && is_valid_title && is_valid_desc){
// 		$.ajax({
// 			url: '/feed/createPost',
// 			type: 'POST',
// 			dataType: 'default',
// 			data: {post_email:post_email,post_title:post_title,post_name:post_name,post_desc:post_desc}
// 		}).then((data)=>{

// 		});
		

// 	}
// 	else{
// 		alert('Enter Valid Details');
// 	}
// 	});
	
	
// });