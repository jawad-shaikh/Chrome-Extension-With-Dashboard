$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");

    const titleName = document.querySelector('.sign-title');

    titleName.classList.toggle('active');

    if(titleName.classList.contains('active')){
        titleName.style.opacity = '0';

        setTimeout(() => {
            titleName.innerText = 'Sign Up!';
            titleName.style.opacity = '1';
        }, 300)
    }
    else{
        
        titleName.style.opacity = '0';
        setTimeout(() => {
            titleName.style.opacity = '1';
            titleName.innerText = 'Login to Loom!';
        }, 300)
    }

 });


 const loginBtn = document.querySelector('.loginBtn');
 loginBtn.addEventListener('click', () => {
    location.replace('popup.html');
 })