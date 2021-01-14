function flip(buttonid) {
  var card = document.querySelector(".flip-card-inner");
      button = document.querySelector(buttonid);

  button.style.pointerEvents = 'none';
  setTimeout(function (){button.style.pointerEvents = 'auto'}, 700);
    
  card.classList.add('reverse');
  if(card.classList.contains("noreverse")){
    card.classList.remove('noreverse'); 
  }

  if(buttonid = 'flipandslide') {
    slide_text_client();
    slide_text_supplies();
  }
}

function backflip(backbuttonid) {
  var card = document.querySelector(".flip-card-inner");
      backbutton = document.querySelector(backbuttonid);

  backbutton.style.pointerEvents = 'none';
  setTimeout(function (){backbutton.style.pointerEvents = 'auto'}, 700);
  
  card.classList.add('noreverse');
  if(card.classList.contains("reverse")){
    card.classList.remove('reverse'); 
  }

  if(backbuttonid = 'backflipandslide') {
    slide_text_supplies();
    slide_text_client();
  }
}
   
function slide_text_client() {
  var text = document.querySelector(".reg-text-client");

  text.classList.toggle('slide-text-client');

}

function slide_text_supplies() {
  var text = document.querySelector(".reg-text-supplies");
  
  text.classList.toggle('slide-text-supplies');

}