function Validator(options) {

    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    let selectorRules = {};

    function validate(inputElement, rule) {
        let errorMessage;
        let errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);

        let rules = selectorRules[rule.selector]
        for (let i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    )
                    break;
                default:
                    errorMessage = rules[i](inputElement.value)
            }
            if (errorMessage) break;
        }
        if (errorMessage) {
            errorElement.innerHTML = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerHTML = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    let formElement = document.querySelector(options.form)
    if (formElement) {

        formElement.onsubmit = function (e) {
            e.preventDefault();

            let isFormValid = true;
            options.rules.forEach(function (rule) {
                let inputElement = formElement.querySelector(rule.selector);
                let isValid = validate(inputElement, rule)
                if (!isValid) {
                    isFormValid = false;
                }
            })

            if (isFormValid) {
                if (typeof options.onSubmit === "function") {
                    let enableInputs = formElement.querySelectorAll('[name]:not([disabled])')
                    let formValues = Array.from(enableInputs).reduce(function (values, input) {
                        values[input.name] = input.value
                        switch (input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name"'+input.name+'"]:checked').value;
                                break;
                            case 'checkbox':
                                if(!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])){
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value
                        }

                        return values;
                    }, {})
                    options.onSubmit(formValues)
                } else {
                    // formElement.submit();
                }
            }
        }

        options.rules.forEach(function (rule) {
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test]
            }

            let inputElements = formElement.querySelectorAll(rule.selector);
            Array.from(inputElements).forEach(function (inputElement) {
                inputElement.onblur = function () {
                    validate(inputElement, rule)
                }
                inputElement.oninput = function () {
                    let errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerHTML = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }
            })
        });
    }
}

Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : message || 'Vui l??ng nh???p tr?????ng n??y';
        }
    }
}

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message || 'Tr?????ng n??y ph???i l?? email';
        }
    }
}

Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : message || `Nh???p t???i thi???u ${min} k?? t???`;
        }
    }
}

Validator.maxLength = function (selector, max, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length <= max ? undefined : message || `Nh???p t???i ??a ${max} k?? t???`;
        }
    }
}

Validator.isConfirm = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message || 'Gi?? tr??? nh???p v??o kh??ng ch??nh x??c';
        }
    }
}

Validator({
    form:'#form-changePassword',
    formGroupSelector:'.text-change-password-default',
    errorSelector:'.message-error',
    rules:[
        Validator.isRequired('.password-old'),
        Validator.isRequired('.password-new'),
        Validator.isRequired('.password-confirm'),
        Validator.minLength('.password-new',6),
        Validator.isConfirm('.password-confirm',function () {
            return document.querySelector('#form-changePassword .password-new').value
        },'M???t kh???u nh???p l???i kh??ng ch??nh x??c'),
    ],
    onSubmit:function (data) {
        var formSubmit = $('#form-changePassword');
        var url = formSubmit.attr('action');
        var btnSubmit = formSubmit.find(':submit');
        $.ajax({
            type: "POST",
            url: url,
            cache:false,
            data: formSubmit.serialize(), // serializes the form's elements.
            beforeSend: function (xhr) {
            },
            success: function (res) {
                if (res.status == 'LOGIN'){
                    openLoginModal();
                }

                if (res.status == 1){

                    $('.modal_message').text(res.message)
                    $('#successModal').modal('show');
                    $('.password-error').html('')
                }else {
                    $('.password-error').html(res.message)

                }
            },
            error: function (data) {
                alert('K???t n???i v???i h??? th???ng th???t b???i.Xin vui l??ng th??? l???i');
                btnSubmit.text('????ng nh???p');
            },
            complete: function (data) {


                formSubmit.trigger("reset");
            }
        });
    }
})


// change password
