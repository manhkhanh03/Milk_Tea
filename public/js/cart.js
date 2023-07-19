function handleCheckout(options, data) {
    const checkboxElement = document.querySelectorAll(options.input)

    function totalCart(options, isChecked, checkboxElement, index) {
        const parentElement = checkboxElement.parentElement.parentElement
        const quantity = parentElement.querySelector(options.quantity)
        const totalCart = document.querySelector(options.total)
        const subtotal = document.querySelector(options.subtotal)
        const delivery = document.querySelector(options.delivery)
        const discount = document.querySelector(options.discount)
        console.log(data[index])
        let sub = data[index].price
        let shipping = 0.50
        let discount_code = 0
        let discount_web = 0
        let totalDiscount = parseFloat(discount.innerText)

        data[index].web_discount_code.forEach(function (value) {
            discount_web += handleData(value, discount_code, sub);
        })
        data[index].discount_code.forEach(function (value) {
            discount_code += handleData(value, discount_code, sub);
        })

        // handle data
        let price = data[index].price
        function handleData(value, discount_code, sub) {
            if (value.type_discount_amount == '%') {
                discount_code = sub * (parseFloat(value.discount_amount) / 100)
            } else {
                discount_code = parseFloat(value.discount_amount)
            }
            console.log(discount_code)
            return discount_code;
        }
        if (isChecked) {
            sub = parseFloat(subtotal.innerText) + (parseFloat(price) * parseFloat(quantity.value))
            discount_code = totalDiscount + discount_code + discount_web;
        } else {
            sub = parseFloat(subtotal.innerText) - (parseFloat(price) * parseFloat(quantity.value))
            discount_code = totalDiscount - discount_code - discount_web;
        }

        subtotal.innerText = sub.toFixed(2);
        delivery.innerText = shipping.toFixed(2);
        discount.innerText = discount_code.toFixed(2);
        totalCart.innerText = (sub + shipping - discount_code).toFixed(2);
    }

    checkboxElement.forEach(function (element, index) {
        element.onclick = function () {
            if (this.checked)
                totalCart(options, true, this, index)
            else totalCart(options, false, this, index)
        }
    })
}
