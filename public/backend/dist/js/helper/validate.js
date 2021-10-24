//function validator
function Validator(options){

  function validate(inputElement, rule){
    var errorMessage = rule.test(inputElement.value)
    var errorElement = inputElement.parentElement.querySelector(options.errorSelector);         
    if(errorMessage){
        errorElement.innerText = errorMessage;
        inputElement.parentElement.classList.add('invalid');
    }else{
        errorElement.innerText = '';
        inputElement.parentElement.classList.remove('invalid');
    }
  }

  var formElement = document.querySelector(options.form);

  if(formElement){
      options.rules.forEach(rule => {

        var inputElement = formElement.querySelector(rule.selector)

        if(inputElement) {
            inputElement.onblur = function() {
                 validate(inputElement, rule);
            }
            inputElement.oninput = function() {
                var errorElement = inputElement.parentElement.querySelector(options.errorSelector)  
                errorElement.innerText = '';
                inputElement.parentElement.classList.remove('invalid');   
           }
        }
      });
  }
 console.log(options.rules);
}


//dinh nghia rules
Validator.isRequired = function(selector) {
   return {
       selector: selector,
       test: function(value) {
           return value.trim() ? undefined : 'Vui long nhap truong nay';
       }
   };
}

Validator.isMin = function(selector, number) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= number ? undefined :`Nhap toi thieu ${number} ki tu`;
        }
    };
 }

Validator.isEmail = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regex.test(String(value).toLowerCase()) ? undefined : message || "input is required";
        }
    };
}

Validator.isConfirm= function(selector, getValueConfirm) {
    return {
        selector: selector,
        test: function(value) {
            return value === getValueConfirm() ? undefined : 'Gia tri nhap vao khong chinh xac';
        }
    };
}