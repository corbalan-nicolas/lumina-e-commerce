// VARIABLES
const $selectCategory = $('#selectCategory')
const $inputCategory = $('#inputCategory')

const $colorInput = $('#colorInput')
const $colorPicker = $('#colorPicker')
const $colorDiv = $('#colorDiv')





// EVENTS
$selectCategory.addEventListener('change', toggleInput)
$colorInput.addEventListener('input', () => {
  $colorDiv.style.backgroundColor = $colorInput.value

  particleColor = $colorInput.value
}) 
$colorPicker.addEventListener('input', () => {
  $colorInput.value = $colorPicker.value

  $colorDiv.style.backgroundColor = $colorPicker.value

  particleColor = $colorPicker.value
})




// METHODS
function toggleInput() {
  if($selectCategory.value === 'newCategory') {
    $inputCategory.type = 'text'  
  }else {
    $inputCategory.type = 'hidden'
  }
}





// INIT
toggleInput()
$colorDiv.style.backgroundColor = $colorInput.value