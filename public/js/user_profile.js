function handleUserProfile(options) {
    handleApiMethodGet(options)
}

function handleImageUser(options) {
    const btn = document.querySelector(options.btnChange)
    const selectorImage = document.querySelector(options.selectorImage)

    if (btn) {
        btn.addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                selectorImage.style.backgroundImage = `url(${URL.createObjectURL(e.target.files[0])})`;
            }
        })
    }
}

// function handleAlterInformationUser(options, data) {
//     const btn = document.querySelector(options.btn)
//     btn.addEventListener('click', function (e) {
//         const newData = {}
//         options.rules.forEach(function (rule) {
//             const selectorElement = document.querySelector(rule.selector)
//             let errorMessage;
//             if (selectorElement && selectorElement.tagName.toLowerCase() === 'input') {
//                 errorMessage = rule.test(selectorElement.value)
//                 if (!errorMessage) {
//                     newData[rule.selector] = selectorElement.value
//                 }
//             } else {
//                 errorMessage = rule.test(selectorElement.style.backgroundImage)
//                 if (!errorMessage) {
//                     const urlStartIndex = "url(".length;
//                     const urlEndIndex = selectorElement.style.backgroundImage.indexOf(")");
//                     let img = selectorElement.style.backgroundImage
//                         .slice(urlStartIndex, urlEndIndex).replace(/['"]/g, "").trim();
//                     function getBase64FromBlobURL(img, callback) {
//                         const xhr = new XMLHttpRequest();
//                         xhr.onload = function () {
//                             const reader = new FileReader();
//                             reader.onloadend = function () {
//                                 callback(reader.result);
//                             };
//                             reader.readAsDataURL(xhr.response);
//                         };
//                         xhr.open('GET', img);
//                         xhr.responseType = 'blob';
//                         xhr.send();
//                     }
//                     newData[rule.selector] = getBase64FromBlobURL(img, function (newImage) {
//                         return newImage
//                     });
//                 }
//             }
//         })
//         console.log(newData);
//         options.handle(newData, options)
//     })
// }

function handleAlterInformationUser(options, data) {
    const btn = document.querySelector(options.btn);
    btn.addEventListener('click', async function (e) {
        const newData = {};
        for (const rule of options.rules) {
            const selectorElement = document.querySelector(rule.selector);
            let errorMessage;

            if (selectorElement && selectorElement.tagName.toLowerCase() === 'input') {
                errorMessage = rule.test(selectorElement.value);
                if (!errorMessage) {
                    newData[rule.selector] = selectorElement.value;
                }
            } else {
                errorMessage = rule.test(selectorElement.style.backgroundImage);
                if (!errorMessage) {
                    const urlStartIndex = "url(".length;
                    const urlEndIndex = selectorElement.style.backgroundImage.indexOf(")");
                    let img = selectorElement.style.backgroundImage
                        .slice(urlStartIndex, urlEndIndex).replace(/['"]/g, "").trim();

                    try {
                        // Sử dụng Promise để đợi cho đến khi dữ liệu base64 được trả về
                        const base64Data = await getBase64FromBlobURL(img);
                        newData[rule.selector] = base64Data;
                    } catch (error) {
                        console.error("Error fetching base64 data:", error);
                    }
                }
            }
        }

        console.log(newData);
        options.handle(newData, options);
    });
}

// Hàm để chuyển đổi blobURL thành base64 bằng Promise
function getBase64FromBlobURL(img) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.onload = function () {
            const reader = new FileReader();
            reader.onloadend = function () {
                resolve(reader.result);
            };
            reader.onerror = reject;
            reader.readAsDataURL(xhr.response);
        };
        xhr.onerror = reject;
        xhr.open('GET', img);
        xhr.responseType = 'blob';
        xhr.send();
    });
}



handleAlterInformationUser.isSelector = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value !== '' ? undefined : message
        }
    }
}

handleAlterInformationUser.isChangeImage = function (selector, message, currentUrlImage) {
    return {
        selector: selector,
        test: function (value) {    
            return value !== currentUrlImage ? undefined : message
        }
    }
}

