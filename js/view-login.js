'use strict'

const $showPassword = $('#showPassword')
const $inputPassword = $('#password')

$showPassword.addEventListener('change', () => {
  if($showPassword.checked) {
    $inputPassword.type = 'text'
  } else {
    $inputPassword.type = 'password'
  }
})