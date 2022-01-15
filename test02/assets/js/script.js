let images = ['img1.png', 'img2.png', 'img3.png', 'img4.png', 'img5.png'];

let slider = document.getElementById("slider");

for (let i = 0; i < images.length; i++) {
  newBlock = document.createElement('div');
  newBlock.classList.add('sliderblock')
  singleImg = document.createElement("img")
  singleImg.src = '/assets/img/' + images[i];
  newBlock.appendChild(singleImg);
  slider.appendChild(newBlock);
}


