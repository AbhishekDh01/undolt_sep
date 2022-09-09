<!DOCTYPE html>
<html lang="en">
 <head>
   <title>International telephone input</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="styles.css" />
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 </head>
 <body>
			 	<div class="container">
			 <form id="login" onsubmit="process(event)">
			   <p>Enter your phone number:</p>
			   <input id="phone" type="tel" name="phone" />
			   <input type="submit" class="btn" value="Verify" />
			 </form>
			</div>

			 </form>



 </body>

 <script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
       initialCountry : "in",
   });

   const info = document.querySelector(".alert-info");

function process(event) {
 event.preventDefault();

 const phoneNumber = phoneInput.getNumber();
 createCookie("num", phoneNumber,"10");
 if (phoneInput.isValidNumber()) {
   alert(phoneNumber);
 } else {
   alert('invalid');
 }

 
}


 </script>


</html>

<script>
   

function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}
  
</script>

