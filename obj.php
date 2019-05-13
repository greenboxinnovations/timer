<!DOCTYPE html>
<html>
<head>
	<title>Title</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			function resetKartBool(id){
				// console.log(id);
				for (var i=0; i<kartArray.length; i++) {
					if(kartArray[i].id == id){
						kartArray[i].active = false;						
						break;
					}
				}
			}

			function addKart(id){
				var myObj = {};
				myObj.id = i;				
				myObj.active = false;
				kartArray.push(myObj);
			}
			function isKartInArray(id){
				var returnVal = false;
				for (var i=0; i<kartArray.length; i++) {
					if(kartArray[i].id == id){
						returnVal = true;
						break;
					}
				}
				return returnVal;
			}
			function updateKart(id){
				for (var i=0; i<kartArray.length; i++) {
					if(kartArray[i].id == id){
						kartArray[i].active = true;
						break;
					}
				}
			}




			// globals
			var kartArray = [];
			// for (var i = 1; i <= 5; i++) {
			// 	var myObj = {};
			// 	myObj.id = i;
			// 	if(i==4){
			// 		myObj.active = false;
			// 		console.log('reseting in 2sec');
			// 		setTimeout(function(){
			// 			resetBool(4);
			// 		}, 2000);
			// 	}
			// 	else{
			// 		myObj.busy = true;	
			// 	}				
			// 	myArr.push(myObj);
			// }

			

			console.log(myArr);			
		});
	</script>
	<style type="text/css">
		*{padding: 0;margin: 0;}
		body{background-color: black;color: white;font-family: helvetica;font-weight: bold;}		
		
	</style>
</head>
<body>


</body>
</html>