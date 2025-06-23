const maxBreakpoint = 768

const $btnFiltersOpen = $('#btnFilters')
const $btnFiltersClose = $('#btnFiltersClose')
const $btnResetFilters = $('#btnResetFilters')
const $filtersContainer = $('.filters__container')
const $inputScrollY = $('#inputScrollY')
const $form = $('#filtersForm')





;[$btnFiltersOpen, $btnFiltersClose].forEach(element => {
  element.addEventListener('click', () => {
    toggleOverlapElement({
      toActive: [$filtersContainer],
      overlapCssSelector: '.filters__container',
      maxBreakpoint
    })
  })
})

$btnResetFilters.addEventListener('click', resetFilters)

window.addEventListener('scroll', () => {
  $inputScrollY.value = window.scrollY
})

if(window.innerWidth > maxBreakpoint) {
  window.scrollTo(0, $inputScrollY.value)
  $inputScrollY.value = 0
}

let formTimer;
$form.addEventListener('change', () => {
  if(window.innerWidth <= maxBreakpoint) return

  clearTimeout(formTimer)

  formTimer = setTimeout(() => {
    $form.submit() // Funciona rarete, no me convence del todo pero bueno
  }, 1000)
})




function resetFilters(event) {
  event.preventDefault()
  
  $$('#filtersForm input:checked').forEach(e => {
    console.log(e.checked)
    e.checked = false
  })

  $('input[name="scrollY"]').value = 0

  $('form').submit()
}