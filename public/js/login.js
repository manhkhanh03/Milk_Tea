function handleInput(options) {
    const inputs = document.querySelectorAll(options.form + " " + options.inputs)
    const labels = document.querySelectorAll(options.form + " " + options.labels)

    inputs.forEach((input, index) => {
        input.addEventListener("focus", () => {
            for (let key in options.css) {
                labels[index].style[key] = options.css[key]
            }
            input.setAttribute('placeholder', '')
        })
    })
}

function handleImport(options) {
    const formElement = document.querySelector(options.form)
    let selectorRules = {}

    function validate(rule, ruleElement) {
        const formMessage = ruleElement.parentElement.querySelector(options.formMessage)
        let errorMessage

        let rules = selectorRules[rule.selector]
        for (let i in rules) {
            errorMessage = rules[i](ruleElement.value)
            if (errorMessage) break
        }

        if (errorMessage) {
            formMessage.innerText = errorMessage
        } else formMessage.innerText = ''

        return !errorMessage
    }

    // btn mặc định của form
    formElement.onsubmit = (e) => {
        e.preventDefault();
        
        let isCheckInput = true;

        const inputElement = formElement.querySelectorAll('input:not([disabled])' + options.formInput)
        options.rules.forEach((rule, index) => { 
            const ruleElement = formElement.querySelector(rule.selector)
            let isValidate = validate(rule, ruleElement)
            if (!isValidate) {
                isCheckInput = false;
            }
        })

        if (isCheckInput) {
            const data = {}
            Array.from(inputElement).forEach(ele => {
                data[ele.getAttribute('id')] = ele.value
            })

            options.isSuccess(data)
        }
    }

    // btn ở bên ngoài
    const otherBtn = document.querySelector(options.btnOther)
    if (otherBtn) { 
        otherBtn.addEventListener('click', (e) => {
            e.preventDefault();

            let isCheckInput = true;

            const inputElement = formElement.querySelectorAll('input:not([disabled])' + options.formInput)
            options.rules.forEach((rule, index) => {
                const ruleElement = formElement.querySelector(rule.selector)
                let isValidate = validate(rule, ruleElement)
                if (!isValidate) {
                    isCheckInput = false;
                }
            })

            if (isCheckInput) {
                const data = {}
                Array.from(inputElement).forEach(ele => {
                    data[ele.getAttribute('id')] = ele.value
                })

                options.isSuccess(data)
            }
        })
    }

    options.rules.forEach((rule, index) => {
        const ruleElement = formElement.querySelector(rule.selector) 

        if (Array.isArray(selectorRules[rule.selector])) { 
            selectorRules[rule.selector].push(rule.test)
        } else 
            selectorRules[rule.selector] = [rule.test]

        ruleElement.addEventListener('input', () => { 
            validate(rule, ruleElement)
        })

        ruleElement.addEventListener('blur', () => { 
            validate(rule, ruleElement)
        })
    })
}

handleImport.isFocus = function (selector, message) {
    return {
        selector: selector,
        test: function (value) { 
            return value.trim() ? undefined : message
        }
    };
}

handleImport.isPassword = function (selector, message) { 
    return {
        selector: selector,
        test: function (value) { 
            return value.length > 8 ? undefined : message
        }
    }
}

handleImport.isEmail = function (selector, message) { 
    return {
        selector: selector,
        test: function (value) { 
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(value) ? undefined : message
        }
    }
}

handleImport.isConfirmPassword = function (selector, message) { 
    return {
        selector: selector,
        test: function (value) { 
            const valuePassword = document.getElementById('password').value
            return valuePassword === value ? undefined : message
        }
    }
}