// ==========================================================================================
// =================================== MENU MOBILE ==========================================
// ==========================================================================================

let menuIcon = document.querySelector('.menu-mobile')
let onglet = document.querySelector('.displayMenu')
let icon = document.querySelector('nav i')
let showMenu = false

const hide = () => onglet.classList.toggle('hide')
const transformation = () => onglet.style.transform = 'translateX(0%)'

menuIcon.onclick = () => {
icon.classList.toggle('fa-bars')
icon.classList.toggle('fa-times')
showMenu
? (onglet.style.transform = 'translateX(100%)', setTimeout(hide, 200), showMenu = false )
: (setTimeout(transformation, 100), hide(), showMenu = true)
}


// --------------------- DÉCOMPTE DE REDIRECTION -------------------------

let countdown = document.getElementById('countdown')

let count = 5

const countD = () => count > 0 && countdown 
? (--count, countdown.textContent = count+'') 
: stopInt()

let decompte = setInterval(countD, 1000)

const stopInt = () => { let clearInt = window.clearInterval(decompte) }

// ----------------------- ANIMATIONS ARTICLE --------------------------
	
let navItem = document.querySelectorAll(".menu li .link")

for(let i= 0; i < navItem.length; i++) {
navItem[i].onmouseenter = () => navItem[i].classList.add("hover")

navItem[i].onmouseleave = () => navItem[i].classList.remove("hover")
}