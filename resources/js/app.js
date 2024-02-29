import './bootstrap';

const botonesMenu = document.querySelector('#botonesMenu');
const burguerMenu = document.querySelector('#burguerMenu');

burguerMenu.addEventListener('click', ()=>{
    
    botonesMenu.classList.toggle('hidden');//muestra o oculta el menu hamburgesa

})
