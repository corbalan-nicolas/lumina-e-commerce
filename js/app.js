// UTILITIES
const $ = selector => document.querySelector(selector)
const $$ = selector => document.querySelectorAll(selector)





// VARIABLES
// let animationsAreDisabled = localStorage.getItem('animationsEnabled') ?? true
let animationsEnabled = JSON.parse(localStorage.getItem('animationsEnabled'))
if (animationsEnabled === null) animationsEnabled = true
const $btnAnimations = $('#btnAnimations')
const $btnMenu = $('#btnMenu')
const $menuContainer = $('.menu__container')

let smokeEffectIsOn = JSON.parse(localStorage.getItem('smokeEffectIsOn')) ?? true
let particleColor = localStorage.getItem('particleColor') ?? 'rgb(200 200 200)'

const $smokeArea = $('#smokeArea')
const $btnSmoke = $('#btnSmoke')





// EVENTS
$btnAnimations.addEventListener('click', toggleAnimations)
;[$btnMenu, $menuContainer].forEach(e => e.addEventListener('click', () => {
  toggleOverlapElement({
    toActive: [$btnMenu, $menuContainer],
    overlapCssSelector: '.menu__container',
    maxBreakpoint: 640
  })
  $btnMenu.removeAttribute('tabindex')
}))
$$('.menu > div').forEach(e => e.addEventListener('click', event => event.stopPropagation()))
$btnSmoke.addEventListener('click', toggleSmokeEffect)
document.addEventListener('mousemove', createParticle)
$$('[data-cpc]').forEach(e => e.addEventListener('mouseenter', event => {
  console.log('HIAFASHFI')
  particleColor = event.currentTarget.dataset.cpc
  localStorage.setItem('particleColor', particleColor)
}))





// METHODS
/**
 * Este método recibe un objeto de configuración
 * @param {Array} toActive Array of DOM elements to toggle the .active class
 * @param {String} overlapCssSelector The css selector for the overlap container (to) 
 */
function toggleOverlapElement({toActive, overlapCssSelector, maxBreakpoint = Infinity, minBreakpoint = 0}) {
  const currentBreakpoint = window.innerWidth
  const tags = 'a, button, input, select'

  window.addEventListener('resize', disableOnBreakpoint)

  if(currentBreakpoint >= minBreakpoint && currentBreakpoint <= maxBreakpoint) {
    let isActive = false
    const toggleTabindex = $$(`:not(${overlapCssSelector} :is(${tags})):is(${tags})`)

    toActive.forEach(element => isActive = element.classList.toggle('active'))

    toggleTabindex.forEach(element => {
      element.setAttribute('tabindex', '-1')
      if(!isActive) {
        element.removeAttribute('tabindex')
      }
    })

    if(!isActive) {
      console.log('remover evento')
      window.removeEventListener('resize', disableOnBreakpoint)
    }
  }

  function disableOnBreakpoint() {
    // Se asume que si el link de "Saltar al contenido" tiene el atributo "tabindex"
    // es porque el menú estába activo antes de que pase el breakpoint, por ende hay
    // que desactivarlo
    if((window.innerWidth < minBreakpoint || window.innerWidth > maxBreakpoint) && $('[tabindex="-1"]')) {
      console.log('Borrar to\'')
      $$('[tabindex="-1"]').forEach(e => e.removeAttribute('tabindex'))
      toActive.forEach(e => e.classList.remove('active'))
      window.removeEventListener('resize', disableOnBreakpoint)
    }
  }
}

function toggleSmokeEffect() {
  smokeEffectIsOn = !smokeEffectIsOn
  localStorage.setItem('smokeEffectIsOn', smokeEffectIsOn)

  $btnSmoke.classList.toggle('active')
}

function toggleAnimations() {
  const result = document.body.classList.toggle('animations-none')
  let newText = 'Desactivar animaciones'
  if(result) {
    newText = 'Activar animaciones'
  }
  
  $('#textAnimation').innerText = newText
  localStorage.setItem('animationsEnabled', !result)
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
let btnAnimationsText = 'Activar animaciones'
if(animationsEnabled) {
  btnAnimationsText = 'Desactivar animaciones'
}else {
  document.body.classList.add('animations-none')
}

;$('#textAnimation').innerText = btnAnimationsText
if(smokeEffectIsOn) $btnSmoke.classList.add('active')