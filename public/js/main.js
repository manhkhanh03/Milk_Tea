// const $ = document.querySelector.bind(document);
// const $$ = document.querySelectorAll.bind(document);

let user = {}
let token;
const URLWeb = window.location.protocol + "//" + window.location.hostname + ':' + window.location.port
const optionsApi = {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    }
}
handleInfomartionUser('.login__user')

function handleScroll(options) {
    window.onscroll = () => {
        if (Math.floor(window.scrollY) >= 300) {
            options.menu.classList.add('active');
        }
        if (window.scrollY === 0) {
            options.menu.classList.remove('active');
        }

        if (options.background) {
            if (options.background.getBoundingClientRect().top <= 200 && options.background.getBoundingClientRect().top >= 100) {
                options.background.style.backgroundPosition = '50% ' + (options.background.getBoundingClientRect().top) * -1 + 'px';
            }
        }
    }
}

function handleNumbers(number, nameAttribute) {
    const item = number.getAttribute(nameAttribute);
    let currentValue = 1;
    let interval = 5;

    const timer = setInterval(function () {
        if (currentValue > item) {
            clearInterval(timer);
            return;
        }
        number.innerText = currentValue;
        currentValue++;
    }, interval);
}

function isActive(options, element, currentIndex) {
    if (typeof (options.handleMovePage) == 'function') {
        console.log(currentIndex)
        options.handleMovePage({
            nextPage: currentIndex,
            perPage: options.quantity,
        })
    }
    const listImg = document.querySelectorAll(options.card_type_img);
    const startPagination = options.quantity * currentIndex
    const endPagination = options.quantity + startPagination;

    document.querySelector(options.card_type + '.active').classList.remove('active');
    element.classList.add('active');

    const listActiveRemove = document.querySelectorAll(options.card_type_img + '.active')
    listActiveRemove.forEach((img) => {
        img.classList.remove('active');
    })


    Array.from(listImg).filter((img, key) => {
        return endPagination > key && startPagination <= key
    }).forEach((img, i) =>
        img.classList.add('active')
    );
}

const eventMove = function (options, listType) {

    const next = document.querySelector(options.event.next).parentElement
    const prev = document.querySelector(options.event.prev).parentElement
    let element
    let moveElement

    element = document.querySelector(options.card_type + '.active')
    let currentIndex = element.getAttribute(options.attributes);

    next.onclick = () => {
        currentIndex++
        if (currentIndex < listType.length && currentIndex >= 0) {
            console.log(currentIndex)
            if (!(currentIndex === listType.length)) {
                moveElement = document.querySelector(options.cardTypeParent).querySelector(`:nth-child(${currentIndex + 1})`)
                isActive(options, moveElement, currentIndex)
            }
        }
    }

    prev.onclick = () => {
        currentIndex--
        if (currentIndex > 0) {
            moveElement = document.querySelector(options.cardTypeParent).querySelector(`:nth-child(${currentIndex + 1})`)
            isActive(options, moveElement, currentIndex)
        }
    }
}

function handlePagination(options) {
    const listType = document.querySelectorAll(options.card_type);
    console.log(listType)
    listType.forEach((element, index) => {
        element.onclick = () => {
            if (options.event) {
                isActive(options, element, element.getAttribute(options.attributes));
            } else
                isActive(options, element, index)
        }
    });

    if (options.event) {
        eventMove(options, listType)
    }
}

function handleApiMethodPost(options) {
    optionsApi.method = 'POST'
    optionsApi.body = JSON.stringify(options.data)
    fetch(URLWeb + options.urlApi, optionsApi)
        .then((response) => {
            return Promise.all([response, response.json()]);
        })
        .then(currentData => {
            const data = currentData[1]
            const currentResponse = currentData[0]
            options.handle(data, options, currentResponse)
        })
}

handleApiMethodPost.isSelectorFail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            const thisSelector = document.querySelector(selector)
            return thisSelector.getAttribute('id') === value ? message : undefined
        }
    }
}

function handleApiMethodGet(options) {
    fetch(URLWeb + options.urlApi)
        .then((response) => response.json())
        .then(data => {
            options.handleDataGet(data, options)
        })
}

// ??????????????????????????????

function handleInfomartionUser(selector = '') {
    handleApiMethodGet({
        urlApi: `/api/user/token`,
        handleDataGet: function (data, options) {
            user = {
                userId: data.user.id,
                userName: data.user.user_name,
                address: data.user.address,
                phone: data.user.phone,
                email: data.user.email,
                img_user: data.user.img_user,
                is_seller_restricted: data.user.is_seller_restricted,
            }

            if (Object.keys(user).length != 0 && selector) {
                handleUser({
                    selector: selector,
                    user: user,
                })
            }
        }
    })
}

function handleUser(options) {
    const parentElement = document.querySelector(options.selector)
    console.log(parentElement)
    parentElement.innerHTML = `
        <img style="margin-right: 6px" src="${options.user.img_user}" alt="${options.user.userName}" class="icon">
        <span>${options.user.userName}</span>
    `
}