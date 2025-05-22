// UTILITIES
const $ = selector => document.querySelector(selector)
const $$ = selector => document.querySelectorAll(selector)

const $btnMenu = $('#btnMenu')
const $menuContainer = $('.menu__container')

let smokeEffectIsOn = JSON.parse(localStorage.getItem('smokeEffectIsOn')) ?? true
let particleColor = localStorage.getItem('particleColor') ?? 'rgb(200 200 200)'

const $smokeArea = $('#smokeArea')
const $btnSmoke = $('#btnSmoke')

// EVENTS
$btnMenu.addEventListener('click', () => {
  toggleOverlapElement({
    toActive: [$btnMenu, $menuContainer],
    overlapCssSelector: '.menu__container'
  })
  $btnMenu.removeAttribute('tabindex')
})
$btnSmoke.addEventListener('click', toggleSmokeEffect)
document.addEventListener('mousemove', createParticle)
// window.addEventListener('resize', () => {
  // const innerWidth = window.innerWidth

  // if(innerWidth < 600) {
  //   elem.setAttribute('tabindex', '-1')
  //   $btnMenu.removeAttribute('active')
  //   $menuContainer.removeAttribute('active')
  // }else {
  //   elem.removeAttribute('tabindex')
  // }
// })

// METHODS
function toggleMenu() {
  $btnMenu.classList.toggle('active')
  const isActive = $menuContainer.classList.toggle('active')
  const tags = 'a, button, input'
  const elements = $$(`:not(.menu__container :is(${tags})):is(${tags}):not(.tab-ignore)`)
  // Ignora los elementos dentro del .menu__container, y selecciona todas las
  // etiquetas de la variable tags que no tengan la clase .tab-ignore para
  // aplicarles luego un tabindex -1, para que no sean focuseables
  
  // elements.forEach(elem => {
  //   if(isActive) {
  //     elem.setAttribute('tabindex', '-1')
  //   }else {
  //     elem.removeAttribute('tabindex')
  //   }
  // })
}

/**
 * 
 * @param {Array} toActive Array of DOM elements to toggle the .active class
 * @param {String} overlapCssSelector The css selector for the overlap container (to) 
 */
function toggleOverlapElement({toActive, overlapCssSelector}) {
  let isActive = false
  const tags = 'a, button, input, select'
  const toggleTabindex = $$(`:not(${overlapCssSelector} :is(${tags})):is(${tags})`)

  toActive.forEach(element => isActive = element.classList.toggle('active'))

  toggleTabindex.forEach(element => {
    element.setAttribute('tabindex', '-1')
    if(!isActive) {
      element.removeAttribute('tabindex')
    }
  })
}

function toggleSmokeEffect() {
  smokeEffectIsOn = !smokeEffectIsOn
  localStorage.setItem('smokeEffectIsOn', smokeEffectIsOn)

  $btnSmoke.classList.toggle('active')
}

function createParticle(event) {
  if(!smokeEffectIsOn) return

  const $particle = document.createElement('div')
  const {clientX, clientY} = event

  $particle.className = 'particle'
  $particle.style.left = clientX + 'px'
  $particle.style.top = clientY + 'px'
  $particle.style.background = `radial-gradient(circle, ${particleColor} 0%, rgba(0 0 0 / 0) 80%)`

  $smokeArea.append($particle)

  $particle.addEventListener('animationend', () => $particle.remove())
}

// INIT
if(smokeEffectIsOn) $btnSmoke.classList.add('active')