const navbar = document.querySelector('.header .flex .navbar');
const profile = document.querySelector('.header .flex .profile');

function menuBtnClickHandler(){
    navbar.classList.toggle('active');
    profile.classList.remove('active');
    
}
function userBtnClickHandler(){
    profile.classList.toggle('active');
    navbar.classList.remove('active');
}

window.onscroll = () => {
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

function loadingHandler(){
    const loader = document.querySelector('.loader');
    loader.style.display = 'none';
}

function fadeOut(){
    setTimeout(loadingHandler, 2000);
}

window.onload = fadeOut();