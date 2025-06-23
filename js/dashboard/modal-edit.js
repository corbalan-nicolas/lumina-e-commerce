'use strict'

const $modalEdit = $('#modalEdit')
const $inputId = $('#inputId')
const $inputName = $('#inputName')
const $closeModal = $('#closeModal')

$$('.btn--edit').forEach($btn => $btn.addEventListener('click', () => {
  const $tr = $btn.closest('.tr--parent')
  const id = $tr.querySelector('.td--id')?.innerText
  const name = $tr.querySelector('.td--name')?.innerText

  $inputId.value = id
  $inputName.value = name
  
  $modalEdit.showModal()
}))

$closeModal.addEventListener('click', () => {
  $modalEdit.close()
})