$$('button[data-function="add-item"]').forEach($btn => $btn.addEventListener('click', () => {
  fetch(`actions/cart-add-item-acc.php?id=${$btn.dataset.id}`).then(() => {
    $(`#quantityProd${$btn.dataset.id}`).innerText = parseInt($(`#quantityProd${$btn.dataset.id}`).innerText) + 1
  })
}))

$$('button[data-function="subtract-item"]').forEach($btn => $btn.addEventListener('click', () => {
  fetch(`actions/cart-subtract-item-acc.php?id=${$btn.dataset.id}`).then(() => {
    const newValue = parseInt($(`#quantityProd${$btn.dataset.id}`).innerText) - 1
    
    if(newValue <= 0) {
      location.reload()
    } else {
      $(`#quantityProd${$btn.dataset.id}`).innerText = newValue
    }
  })
}))