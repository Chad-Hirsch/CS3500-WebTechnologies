// JavaScript Document





function isBlank(inputField){
    if(inputField.type=="radio"){
	if(inputField.selected)
	    return false;
	return true;
    }
    if (inputField.value==""){
	return true;
    }
    return false;
}

function makeRed(inputDiv){
   	inputDiv.style.backgroundColor="#AA0000";
	inputDiv.parentNode.style.backgroundColor="#AA0000";
	inputDiv.parentNode.style.color="#FFFFFF";		
}
function makeClean(inputDiv){
	inputDiv.parentNode.style.backgroundColor="#FFFFFF";
	inputDiv.parentNode.style.color="#000000";		
}




window.onload = function(){
    var mainForm = document.getElementById("mainForm");
    var requiredInputs = document.querySelectorAll(".required");
    for (var i=0; i < requiredInputs.length; i++){
	requiredInputs[i].onfocus = function(){
	    this.style.backgroundColor = "#EEEE00";
	}
    }
    mainForm.onsubmit = function(e){
	var requiredInputs = document.querySelectorAll(".required");
	//phonenumber(document.myForm.phone);
		
		
	for (var i=0; i < requiredInputs.length; i++){
	    if( isBlank(requiredInputs[i]) ){
		e.preventDefault();
		makeRed(requiredInputs[i]);
	    }
	    else{
		makeClean(requiredInputs[i]);
	    }
	}
    }
}








function validateform () {   
       return !!(validate() & phonenumber(document.myForm.phone));
   }

function validate()
      {
      
         if( document.myForm.first.value == "" )
         {
            alert( "Please provide your first name!" );
            document.myForm.first.focus() ;
            return false;
         }
		  
		 if( document.myForm.last.value == "" )
         {
            alert( "Please provide your last name!" );
            document.myForm.last.focus() ;
            return false;
         }
         
         if( document.myForm.email.value == "" )
         {
            alert( "Please provide your Email!" );
            document.myForm.email.focus() ;
            return false;
         }
		  
		 if( document.myForm.pass1.value == "" )
         {
            alert( "Please provide a password!" );
            document.myForm.pass1.focus() ;
            return false;
         }
		  
		 if( document.myForm.pass2.value == "" )
         {
            alert( "Please provide a password!" );
            document.myForm.pass2.focus() ;
            return false;
         }
         
		  if( document.myForm.address.value == "" )
         {
            alert( "Please provide a address!" );
            document.myForm.address.focus() ;
            return false;
         }
		  
		 if( document.myForm.city.value == "" )
         {
            alert( "Please provide a city!" );
            document.myForm.city.focus() ;
            return false;
         }
		  
		  if( document.myForm.birthday.value == "" )
         {
            alert( "Please provide a birthday!" );
            document.myForm.city.focus() ;
            return false;
         }
		 
		  /*if( document.myForm.phone.value == "" )
         {
            alert( "Please provide a phone number!" );
            document.myForm.phone.focus() ;
            return false;
         }*/
		  
         if( document.myForm.zip.value == "" ||
         document.myForm.zip.value.length != 5 )
         {
            alert( "Please provide a zip in the format #####." );
           document.myForm.zip.focus();
            return false;
         }
		  
		 
		
         
	  }
		  


	