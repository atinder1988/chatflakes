
numOfUsers = 0;

function Chat (filetxt, domainname) {
	
	file = filetxt;
	domain = domainname;

	this.getUsers = getuserlist;

}

function getuserlist(room, username) {
	roomid = room;
	usernameid = username;
	console.log('Hwllo qorlf');
	//alert(username);
	 $.ajax({
	 	type: "GET",
        url: "xusers.php",
        data: {  
        		'room' : room,
        		'username': username,
        		'current' : numOfUsers,
        		'domain' : domain
        		},
        dataType: "json",
        cache: false,
        success: function(data) {
        	console.log('Hi....');
        	console.log(data);
        	$('#userlist').html($("<p>" + data.userlist[0] + "</p>"));
        	if (numOfUsers != data.numOfUsers) {
        		numOfUsers = data.numOfUsers;
        		var list = "<li class='head'>Current Chatters</li>";
        		for (var i = 0; i < data.userlist.length; i++) {  
                   list += "<li>"+ data.userlist[i] +"</li>";
                }
        		$('#userlist').html($("<ul>"+ list +"</ul>"));
        	}
        	
            setTimeout('getuserlist(roomid, usernameid)', 1);
           
        },
    });

}