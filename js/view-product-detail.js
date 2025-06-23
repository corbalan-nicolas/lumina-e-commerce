'use strict'

const $bigImg = $('#bigImg')
const $smallImg = $$('#carouselButtons img')

$smallImg.forEach($img => {
  $img.addEventListener('mouseover', changeBigImg)
  $img.addEventListener('click', changeBigImg)
})

function changeBigImg(event) {
  $bigImg.src = event.currentTarget.src
  $bigImg.alt = event.currentTarget.alt
}

console.log('Hi :)')