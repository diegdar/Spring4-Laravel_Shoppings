import './bootstrap';

// Muestra o oculta el menu hamburguesa en vista movil
    const botonesMenu = document.querySelector('#botonesMenu');
    const burguerMenu = document.querySelector('#burguerMenu');

    burguerMenu.addEventListener('click', ()=>{
        
        botonesMenu.classList.toggle('hidden');//muestra o oculta el menu hamburgesa

    })
    
