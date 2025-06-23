const email = 'contacto@lumina.com'
const number = '+54 9 11 3143-6286'

const $btnCopyEmail = $('#btnCopyEmail')
const $spanCopyEmail = $('#spanCopyEmail')
const $btnCopyNumber = $('#btnCopyNumber')
const $spanCopyNumber = $('#spanCopyNumber')





$btnCopyEmail.addEventListener('click', () => {
  copyToClipboard(email, $spanCopyEmail)
})

$btnCopyNumber.addEventListener('click', () => {
  copyToClipboard(number, $spanCopyNumber)
})





function copyToClipboard(value, DOMspan) {
  navigator.clipboard.writeText(value)
    .then(() => {
      DOMspan.classList.add('active')
    })
}