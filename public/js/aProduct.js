function handleEventQuantityProduct(options) {
    function handleNext(selector, input, isActive) {
        selector.onclick = function () {
            let value = input.value;
            if (isActive && value <= 70) {
                input.value = Number(value) + 1
            } else if (!isActive && value > 0) { 
                input.value = Number(value) - 1
            }
        }
    }

    const input = document.querySelector(options.input)
    const next = document.querySelector(options.selector.next)
    const prev = document.querySelector(options.selector.prev)

    handleNext(next, input, true)
    handleNext(prev, input, false)
}

function handleEventSelectedProduct(options) { 
    const parentElement = document.querySelector(options.selector)
    const listItem = parentElement.querySelectorAll(options.item)
    
    listItem.forEach(item => {
        item.onclick = function () {
            const thisElement = parentElement.querySelector(options.input)
            thisElement.innerText = item.innerText
        }
    });
}

function handleEventChangeImageMain(options) { 
    const parentElement = document.querySelector(options.parent)
    const imgMain = parentElement.querySelector(options.imageMain)
    const listImg = parentElement.querySelectorAll(options.imageList)
    
    listImg.forEach(item => { 
        item.onclick = function () { 
            imgMain.style.backgroundImage = this.style.backgroundImage
            imgMain.style.transition = 'all .25s ease'
        }
    })
}