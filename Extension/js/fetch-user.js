// on load to check user is already logged in
$( document ).ready(function() {
  chrome.storage.sync.get(['userId'], function(result) {
    if (result.userId != undefined) {
      window.location.replace('popup.html');
    }
  });
});

// function to redirect Login page after Registration
function redirectloginpage() {
  $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
  var titleName = document.querySelector('.sign-title');
  titleName.style.opacity = '1';
  titleName.innerText = 'Login to Loom!';
  const form1=document.querySelector('.register-form');
  form1.style.display = 'none';
  const form2=document.querySelector('.login-form');
  form2.style.display = 'block';
}



// Ajax using Jquery to insert data into Database
$(document).ready(function(){
$("#savedata").on("click",function(){
    
    var username = $("#username").val();
    var useremail = $("#useremail").val();
    var userpass = $("#userpass").val();
    if(username == "" || useremail == "" || userpass == ""){
     $(".error-message").html("Please Fill All the Fields").slideDown();
     $(".success-message").slideUp();
    }else{
      
      $.ajax({
        url: "http://localhost/Loom/api/register.php",
        type : "POST",
        data : {user_name:username, user_email: useremail, user_pass: userpass},
        success : function(data){
          if(data == 1){
            $(".success-message").html("Account Created Successfully.").slideDown();
            $(".error-message").slideUp();
            setTimeout(() => {
                $(".success-message").html("");
                $(".error-message").html(""); 
                redirectloginpage();           
                $(".success-message").html("Now Login With Your Account");
            }, 2000)
          }
            else{
             if (data == 0) {
               
               $(".error-message").html("Email ALready Exist.").slideDown();
              }
              else{
              $(".error-message").html("Cant Record Data.").slideDown();
            $(".success-message").slideUp();
            }
          }

        }
      });
     
    }

  });
// Login System

$("#checkrecords").on("click",function(event){
  
  event.preventDefault();
  var loginemail = $("#loginemail").val();
  var  loginpass = $("#loginpass").val();
  
    if(loginemail == "" || loginpass == ""){
     $(".error-message").html("Please Fill All the Fields").slideDown();
      $(".success-message").slideUp();
    }else{
  $.ajax({
    url : "http://localhost/Loom/api/login.php",
    type : "POST",
    data : {login_email:loginemail, login_pass: loginpass},
    success : function(sth){
      var userObj = JSON.parse(sth)

      if(sth != 0){
        $(".success-message").html("Login Successfull.").slideDown();
        $(".error-message").slideUp();

        chrome.storage.sync.set({userId: userObj.user_id}, function() {
          setTimeout(() => {
            chrome.tabs.create({ url: `http://localhost/loom/Dashboard/login.php?token=${userObj.token}` });
          }, 2000)
        });
      } else{
        $(".error-message").html("Email or Password are Incorrect!").slideDown();
        $(".success-message").slideUp();
      }

    }
  });
  
}
});
});
























