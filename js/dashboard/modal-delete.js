'use strict'

const $modalDelete = $('#modalDelete')
const $inputId = $('#inputId')
const $identifier = $('#identifier')
const $closeModal = $('#closeModal')

$$('.btn--delete').forEach($btn => $btn.addEventListener('click', () => {
  const $tr = $btn.closest('.tr--parent')
  const id = $tr.querySelector('.td--id')?.innerText
  const identifier = $tr.querySelector('.td--identifier')?.innerText

  console.log({id})
  console.log({identifier})

  $inputId.value = id
  $identifier.innerText = identifier
  
  $modalDelete.showModal()
}))

$closeModal.addEventListener('click', () => {
  $modalDelete.close()
})