
/* search bar */

const search = () => {
    const searchbox = document.getElementById("search-item").value.toUpperCase();

    const storeitems = document.getElementById("breed-list")

    const breed = document.querySelectorAll(".breed")

    const bname = storeitems.getElementsByTagName("h1")

    for(var i=0; i < bname.length; i++){
        let match = breed[i].getElementsByTagName('h1')[0];

        if(match){
            let textvalue = match.textContent || match.innerHTML

            if(textvalue.toUpperCase().indexOf(searchbox) > -1){

                breed[i].style.display = "";
            }else{
                breed[i].style.display = "none";
            }
        }
    }

}



/* accordion */

const accordion = document.getElementsByClassName('content-box');

for(i = 0; i < accordion.length; i++){
    accordion[i].addEventListener('click',function(){
        this.classList.toggle('active')
    })
}

/* Toggle Password */

function togglePassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  function toggleCurrentPassword() {
    var x = document.getElementById("currentPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }


  function toggleConfirmPassword() {
    var x = document.getElementById("confirmPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

/* To top button */
//Get the button
var mybutton = document.getElementById("top-btn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}