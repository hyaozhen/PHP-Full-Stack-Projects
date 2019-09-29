document.getElementById("num1").addEventListener("keyup", calculator, false);
document.getElementById("num2").addEventListener("keyup", calculator, false);
//Referenced from: http://www.dynamicdrive.com/forums/showthread.php?74477-How-do-you-attach-an-event-listener-to-radio-button-using-javascript
var ops = document.getElementsByName("operation");
    	for (var i = 0; i < ops.length; i++) { 
    		ops[i].addEventListener("change", calculator, false);
		}
function calculator(){
	var num1 = document.getElementById('num1').value;
	var num2 = document.getElementById('num2').value;
	//Referenced from: http://www.dynamicdrive.com/forums/showthread.php?74477-How-do-you-attach-an-event-listener-to-radio-button-using-javascript
    for (var i = 0; i < ops.length; i++) { 
        if (ops[i].checked) { 
			var opr  =  ops[i].value;
		}

	}
	//Referenced from: https://www.w3schools.com/jsref/prop_node_textcontent.asp
	var result = document.getElementById("result");
	if (opr == "+"){
		result.textContent = Number(num1) + Number(num2);
	} else if (opr == "-"){
		result.textContent = (num1 - num2);
	} else if (opr == "*"){
		result.textContent = (num1 * num2);
	} else if (opr == "/" && num2 != 0){
		result.textContent = (num1 / num2);
	} else if (opr == "/" && num2 == 0){
		result.textContent = "denominator can not be zero";
	}
}