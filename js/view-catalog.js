const btnFiltersOpen = $('#btnFilters')
const btnFiltersClose = $('#btnFiltersClose')
const filtersContainer = $('.filters__container')
const inputScrollY = $('#inputScrollY');

btnFiltersOpen.addEventListener('click', () => {
  toggleOverlapElement({
    toActive: [filtersContainer],
    overlapCssSelector: '.filters__container'
  })
})

btnFiltersClose.addEventListener('click', () => {
  toggleOverlapElement({
    toActive: [filtersContainer],
    overlapCssSelector: '.filters__container'
  })
})

window.addEventListener('scroll', () => {
  inputScrollY.value = window.scrollY
})

window.scrollTo(0, inputScrollY.value)