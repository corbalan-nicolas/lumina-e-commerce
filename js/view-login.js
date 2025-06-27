'use strict'

const $showPassword = $('#showPassword')
const $showPasswordIcon = $('#showPasswordIcon')
const $inputPassword = $('#password')

$showPassword.addEventListener('change', () => {
  if($showPassword.checked) {
    $inputPassword.type = 'text'
    $showPasswordIcon.classList.replace('icon--eye-closed', 'icon--eye')
  } else {
    $inputPassword.type = 'password'
    $showPasswordIcon.classList.replace('icon--eye', 'icon--eye-closed')
  }
})