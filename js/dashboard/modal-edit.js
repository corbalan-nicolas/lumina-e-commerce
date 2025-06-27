'use strict'

const $modalEdit = $('#modalEdit')
const $modalEditId = $('#modalEditId')
const $modalEditName = $('#modalEditName')
const $modalEditClose = $('#modalEditClose')

$$('button[data-function="open-modal-edit"]').forEach($btn => $btn.addEventListener('click', () => {
  $modalEditId.value = $btn.dataset.id
  $modalEditName.value = $btn.dataset.name

  $modalEdit.showModal()
}))

$modalEditClose.addEventListener('click', () => {
  $modalEdit.close()
})