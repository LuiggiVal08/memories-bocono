import { regExp } from "./helpers/Format";
import { Format } from "./helpers/Format";
import httpRequest from './helpers/httpRequest';
import showToast from './helpers/Toast';
const validForm = (elements) => {
    const formData = {};
    let isValid = true;

    Array.from(elements).forEach(element => {
        if (element.type === 'submit' || element.type === 'button') {
            return;
        }

        const name = element.name;
        const valid = element.getAttribute('data-valid');
        const regex = element.getAttribute('data-regex') ? new RegExp(element.getAttribute('data-regex')) : regExp[ valid ];

        element.classList.remove('errorInput');
        if (regex) {
            if (!regex.test(element.value)) {
                isValid = false;
                element.classList.add('errorInput');
                console.error(`El campo ${name} no es válido.`);
            }
        } else {
            if (!element.value) {
                isValid = false;
                element.classList.add('errorInput');
                console.error(`El campo ${name} no debe estar vacío.`);
            }
        }

        formData[ name ] = element.value;
    });

    return { isValid, formData };
};
export const submitForm = async (e, url) => {
    // console.log(url);
    e.preventDefault();
    const form = e.target;
    const { isValid, formData } = validForm(form.elements);
    const response = await httpRequest(url, 'POST', formData);
    if (isValid) {

        if (response.error) {
            showToast({ title: 'Error', message: response.message, type: 'error', duration: 20000 });
            return;
        }

        showToast({ title: 'Registro exitoso', message: 'Bienvenido a Memorias de Boconó', type: 'success', duration: 20000 });
        window.location.href = '/auth';
    }
};

const formLogin = document.getElementById('formLogin');
const formRegister = document.getElementById('formRegister');


formLogin.addEventListener('submit', (e) => submitForm(e, '/api/login'));
formRegister.addEventListener('submit', (e) => submitForm(e, '/api/register'));

formLogin.querySelector('input[name="username"]').addEventListener('input', Format.formatInput);
formLogin.querySelector('input[name="password"]').addEventListener('input', Format.formatInput);

formRegister.querySelector('input[name="name"]').addEventListener('input', Format.formatInput);
formRegister.querySelector('input[name="lastname"]').addEventListener('input', Format.formatInput);
formRegister.querySelector('input[name="username"]').addEventListener('input', Format.formatInput);
formRegister.querySelector('input[name="email"]').addEventListener('input', Format.formatInput);
formRegister.querySelector('input[name="password"]').addEventListener('input', Format.formatInput);
// window.submitLogin = submitLogin;
// document.getElementById('user').addEventListener('input', (e) => Format.formatInput(e, 'username'));

// document.getElementById('pass').addEventListener('input', (e) => Format.formatInput(e, 'password'));
