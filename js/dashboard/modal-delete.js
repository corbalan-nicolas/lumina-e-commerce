'use strict'

const $modalDelete = $('#modalDelete')
const $modalDeleteId = $('#modalDeleteId')
const $modalDeleteName = $('#modalDeleteName')
const $modalDeleteClose = $('#modalDeleteClose')

$$('button[data-function="open-modal-delete"]').forEach($btn => $btn.addEventListener('click', () => {
  $modalDeleteId.value = $btn.dataset.id
  $modalDeleteName.innerText = $btn.dataset.name

  $modalDelete.showModal()
}))

$modalDeleteClose.addEventListener('click', () => {
  $modalDelete.close()
})